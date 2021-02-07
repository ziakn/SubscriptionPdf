<?php

namespace App\Http\Middleware;

use Closure;

class StorageAccess
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
        // dd($request->path());
        $check = substr($request->path() , 0, 7);
        // dd($check);
        if($check == "storage")
        {
             abort(403, 'Access denied');
        }
        return $next($request);
    }
}
