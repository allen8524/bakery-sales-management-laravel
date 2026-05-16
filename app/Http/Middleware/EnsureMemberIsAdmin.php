<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMemberIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('uid')) {
            return redirect()
                ->route('home')
                ->with('login_error', '로그인이 필요한 기능입니다.');
        }

        if ((int) $request->session()->get('rank') !== 1) {
            return redirect()
                ->route('home')
                ->with('login_error', '관리자만 접근할 수 있습니다.');
        }

        return $next($request);
    }
}
