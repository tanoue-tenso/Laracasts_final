<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user)
    {
        // memo: abort_if() => 第一引数がfalseのとき, 第二引数のステータスコードを返す
        // abort_if(Gate::allows('edit', $user), 404);
        // ↓ authに関連したステータスコードを返したい時は以下の方がスマート
        Gate::authorize('edit', $user);

        return view('profiles.edit', compact('user'));
    }
}
