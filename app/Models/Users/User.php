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

    //投稿者か管理者かを調べる（投稿編集できる者）、投稿者のidがとんでくる
    public static function contributorAndAdmin($id)
    {
        //ログインユーザーが、投稿者か、管理者の役職であるかどうか
        return Auth::id() == $id || Auth::user()->admin_role == 1;
    }
}
