<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()//ここを書き換える（ログイン時の処理）権限の定義
    {
        $this->registerPolicies();

        //管理者
        Gate::define('admin', function ($user){
            return ($user->admin_role === 1 );
        });

        //ユーザーと管理者
        Gate::define('user',function($user){
            return in_array($user->admin_role,[1,10],true);
        });
    }
}
