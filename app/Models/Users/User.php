<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    //投稿やコメントの投稿者が、投稿者もしくは管理者かどうかを調べる（投稿、コメント編集できる者）、投稿者のidがとんでくる
    public static function contributorAndAdmin($id)
    {
        //ログインユーザーが、投稿者か、管理者の役職であるかどうか
        return Auth::id() == $id || Auth::user()->admin_role == 1;
    }
}
