<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Treat null/empty/"none"/"no active subscriptions" as inactive
        $status = strtolower(trim((string)($user->subscription ?? '')));
        $inactive = ($status === '' || $status === 'none' || str_contains($status, 'no active'));

        if ($user && $inactive) {
            // Allow admin area through
            if ($request->is('admin/*')) {
                return $next($request);
            }

            // Block everything else
            return redirect()
                ->route('account.index')
                ->with('error', 'Access restricted — your subscription is not active. Please contact admin@mtm-connect.com.');
        }

        return $next($request);
    }
}
