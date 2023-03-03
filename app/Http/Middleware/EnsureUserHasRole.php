<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// class EnsureUserHasRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next,  string $role): Response
//     {
//         if (Auth::user()->$role) {
//             return $next($request);
//         }

//         //     echo (Auth::user()->role);
//         return response('You do not have permission to access this page', 404);
//     }
// }


class EnsureUserHasRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $roleIds = ['admin' => 'admin', 'student' => 'student', 'teacher' => 'teacher'];
        $allowedRoleIds = [];
        foreach ($roles as $role) {
            if (isset($roleIds[$role])) {
                $allowedRoleIds[] = $roleIds[$role];
            }
        }
        $allowedRoleIds = array_unique($allowedRoleIds);

        if (Auth::check()) {
            if (in_array(Auth::user()->role, $allowedRoleIds)) {
                return $next($request);
            }
        }
        return response('You do not have permission to access this page', 404);
        //     return redirect('/');
    }
}
