<?php

namespace App;

trait Likeable
{
    // リレーション
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // 「いいね」もしくは「ダメね」の計算
    public function countLikesOrDislikes($isLike)
    {
        return $this->likes->where('liked', $isLike)->count();
    }

    // いいね！作成
    public function like()
    {
        $this->likes()->updateOrCreate([
            'user_id' => auth()->id(),
        ],
        [
            'liked' => true
        ]);
    }

    // ダメね！作成
    public function dislike()
    {
        $this->likes()->updateOrCreate([
            'user_id' => auth()->id(),
        ],
        [
            'liked' => false
        ]);
    }

    // いいねボタンの表示用に、ユーザーにいいねされてるか？の判定
    public function isLikedBy(User $user)
    {
        return (bool) $user
            ->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    // いいねボタンの表示用に、ユーザーにいいねされてるか？の判定
    public function isDislikedBy(User $user)
    {
        return (bool) $user
            ->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
    }
}
