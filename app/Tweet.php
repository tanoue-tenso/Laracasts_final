<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $guarded = []; // memo: 全てのカラムはcreate可能

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
