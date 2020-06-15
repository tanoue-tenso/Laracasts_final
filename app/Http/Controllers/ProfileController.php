<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user)
    {
        // memo: abort_if() => 第一引数がfalseのとき, 第二引数のステータスコードを返す
        abort_if($user->isNot(auth()->user()), 404);

        return view('profiles.edit', compact('user'));
    }
}
