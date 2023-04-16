<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (!$request->user()){
            return redirect('login');
        }
        $permissions = explode('|', $permission);
        $roles = explode(',',Auth::user()->type);
        $check = false;

        foreach ($permissions as $key => $value) {
            if (in_array($value, $roles)){
                $check = true;
            }
        }

        if($check){
            return $next($request);
        }else{
            return new Response(view('usertype::unauthorized')->with('role', $roles[0]));
        }
    }
        //return $next($request);
    }
}
