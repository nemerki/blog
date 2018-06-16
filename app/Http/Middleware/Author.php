<?php

namespace App\Http\Middleware;

use Closure;

class Author
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
        if (Auth::check()){
            if (Auth::user()->yetkisi_varmi("author")){
                return $next($request);
            }
        }
        return redirect("/");
    }
}
