<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $permisionAction = getPermisionAction();
        $permissions = getUserPermisstionAcction(auth()->user()->user_id);
        
        if (in_array($request->route()->getName(), $permisionAction) &&
            !in_array($request->route()->getName(), $permissions)) {

                return response()->json([
                'status' => false,
                'message' => __('messages.permission_action_access_denide'),
                'code' => \Illuminate\Http\Response::HTTP_UNAUTHORIZED,
                'httpCode' => \Illuminate\Http\Response::HTTP_UNAUTHORIZED,
            ]);
        }

        return $next($request);
    }
}
