<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        $roles = explode(' ', $role);
        foreach($roles as $item){
            if(auth()->user()->role == $item)
            return $next($request);
        }
        return redirect('home')->with('error', 'You can not access this page!');
    }
}
