<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);

            if(Auth::check()){
                //ログイン中にログアウト中に閲覧できるURLni変更すると/indexにリダイレクトされる。
                return redirect()->route('post.index');

            }else{
                //ログアウト中にログイン中に閲覧できるURLに変更すると/loginにリダイレクトされる。
                return redirect()->route('login.form');
            }
        }

        return $next($request);
    }
}
