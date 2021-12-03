<?php

namespace TNM\Permissions\Tests;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use TNM\Permissions\Middleware\HasRoutePermissions;
use TNM\Permissions\Models\Permission;
use TNM\Permissions\Models\Role;
use TNM\Permissions\Models\User;

class HasRoutePermissionsMiddlewareTest extends TestCase
{
    public function test_route_permission()
    {
        $request = new Request();

        $handle = (new HasRoutePermissions())->handle($request, function ($request) {
        });

        $this->assertEquals(Response::HTTP_FORBIDDEN, $handle->status());
    }


    public function test_request_with_route_permissions()
    {
        /** @var Role $role */
        $role = Role::factory()->create();
        $permission = Permission::factory()->create([
            'endpoint' => 'api/search',
            'method' => 'GET'
        ]);
        $role->permissions()->attach($permission);

        /** @var User $user */
        $user = User::factory()->create(['role_id' => $role]);
        $token = $user->createToken('access')->plainTextToken;

        $request = Request::create('api/search');
        $request->headers->set('Authorization', "Bearer $token");


        $authMiddleware = app(Authenticate::class);
        $authRequest = $authMiddleware->handle($request, function ($request) {
            (new HasRoutePermissions())->handle($request, function (){});
        }, ['token']);

        $response = (new HasRoutePermissions())->handle($request, function (){});

    }
}