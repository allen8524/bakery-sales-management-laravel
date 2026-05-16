<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsLoggedIn
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('uid')) {
            return redirect()
                ->route('home')
                ->with('login_error', '로그인이 필요한 기능입니다.');
        }

        return $next($request);
    }
}
