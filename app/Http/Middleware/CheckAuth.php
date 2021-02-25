<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = new User();

        if ($user->is_authorized($request))
        {
            return $next($request);
        }

        //var_dump('no tienes permisos'); exit;
		return response()->json(['error'=>['code' => 401, 'message' => 'you are not allowed' ]], 401);
    }
}
