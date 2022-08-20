<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::wherebadge(auth()->id())->wherehas('building')->first();
        if($user){
             return $next($request);
        }
        Alert::error('Error', 'You are not allowed to access this page');
        return redirect(route('home'));
    }
}
