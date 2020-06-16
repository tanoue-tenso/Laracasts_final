<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

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

    public function update(User $user)
    {
        $attributes = request()->validate([
                'username' => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)], // memo: 既に登録されているusernameと被るのを防ぐため、Rule::unique()を呼び出している
                'name' => ['string', 'required', 'max:255'],
                'avatar' => ['required', 'file'],
                'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
                'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed']
            ]);

        $attributes['avatar'] = request('avatar')->store('avatars'); // storage/app/avatarsフォルダに保存, memo: envにFILESYSTEM_DRIVERでpublicを指定。 これでpublicにアクセスできる

        $user->update($attributes);

        return redirect('/profiles/'.$user->username);
    }
}
