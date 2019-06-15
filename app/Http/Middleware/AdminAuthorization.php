<?php

namespace App\Http\Middleware;

use App\Helper\ObjectHelper;
use Closure;

class AdminAuthorization
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

        if (strpos($request->path(), 'User') !== false && !ObjectHelper::currentUserIsAdmin()){
           return redirect('home');
        }

        return $next($request);
    }
}
