<?php

namespace App;

// Userクラスにて利用
trait Followable
{
    // フォローする(クリックしたユーザーのidをuser_idに、クイックされたユーザーのidをfollowing_user_idに保存)
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    // フォローを外す
    public function unFollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    // ↓↓上２つをまとめた
    public function toggleFollow(User $user)
    {
        if ($this->isFollow($user)) {
            return $this->unFollow($user);
        } else {
            return  $this->follow($user);
        }
    }

    // 引数のユーザーをフォローしてる？メソッド
    public function isFollow(User $user)
    {
        return $this->follows->contains($user);
    }

    // フォローしているユーザー一覧表示
    public function follows()
    {
        return $this->belongsToMany(
            User::class,
            'follows',  // 中間テーブル名
            'user_id',  // 自分のカラム名
            'following_user_id' // 相手のカラム名
        ); // memo: belongsToManyの定義に飛ぶとわかりやすい！
    }
}
