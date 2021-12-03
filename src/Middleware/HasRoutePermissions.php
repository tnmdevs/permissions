<?php

namespace TNM\Permissions\Middleware;

use Bluecloud\ResponseBuilder\ResponseBuilder;
use Closure;
use Illuminate\Http\Request;
use TNM\Permissions\Models\Permission;

class HasRoutePermissions
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->hasPermission()) return $next($request);

        return (new ResponseBuilder())->unauthorized('You are not allowed to access this resource')->json();
    }

    private function hasPermission(): bool
    {
        if (!isset(request()->user()->{'role'})) return false;

        return request()->user()->{'role'}->permissions->contains(function (Permission $permission) {
            return $permission->{'endpoint'} == request()->route()->uri && $permission->{'method'} == request()->method();
        });
    }
}
