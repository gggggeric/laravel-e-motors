<?php 
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class EnsureEmailIsVerified 
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && ! $request->user()->hasVerifiedEmail() && ! $request->is('email/verify', 'email/verify/*', 'logout')) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : redirect()->route('custom.verification-notice');
        }

        return $next($request);
    }
}

