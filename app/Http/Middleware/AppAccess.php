<?php

namespace App\Http\Middleware;

use RealRashid\SweetAlert\Facades\Alert;
use Closure;

class AppAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(auth()->user()->role != 'staff') {

        return $next($request);
    }

    Alert::info('Info', 'You are not allowed to access this page');

    return redirect()->route('home');

    }

}
