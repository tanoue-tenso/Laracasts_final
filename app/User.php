<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // memo: get〇〇Attributeで呼び出す時は $user->〇〇 でいける！
    public function getAvatarAttribute($value)
    {
        $value = $value !== null ? $value : 'avatars/default.png';
        return asset("/storage/".$value);
    }

    // memo: 更新時にパスワードが平文化してしまうので、それを修正するミューテタ
    // みゅーてたはカラムの保存時に自動で読み込まれるので、特に呼び出す必要はなし
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value); // bcryptを通す
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }


    // 自分と自分がフォローしているユーザーの投稿のみ表示
    public function timeline()
    {
        // return Tweet::where('user_id', $this->id)->latest()->get();
        $ids = $this->follows()->pluck('id');
        $ids->push($this->id);

        return Tweet::whereIn('user_id', $ids)->latest()->get();
    }

    // memo: ルートのパラメーターでレコードを識別するパラメーターのカラムを設定
    // 追記: web.phpに {user:name} とすればいらない(62より)
    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }
}
