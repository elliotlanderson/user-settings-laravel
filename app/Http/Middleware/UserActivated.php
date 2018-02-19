<?php

namespace App\Http\Middleware;

use Closure;

class UserActivated
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
        $user = auth()->user();

        if ($user->isConfirmed()) {
            return $next($request);
        }

        return redirect()->route('user.activate');
    }
}
