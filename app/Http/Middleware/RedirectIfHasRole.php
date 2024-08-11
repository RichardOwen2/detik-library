<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $redirectTo): Response
    {
        /** @var App\Models\User */
        $user = auth()->user();

        if ($user->getRoleNames()[0] === $role) {
            return redirect(route($redirectTo));
        }

        return $next($request);
    }
}
