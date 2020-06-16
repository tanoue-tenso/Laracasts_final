<h3 class="font-bold text-xl mb-4">Followings</h3>

<ul>
    @forelse (auth()->user()->follows as $user)
        <li class="mb-4">
            <a href="{{ route('profile', $user) }}" class="flex items-center text-sm">
                <img src={{ $user->avatar }} alt="user" class="rounded-full mr-2" width="40" height="40">
                {{ $user->name }}
            </a>
        </li>
    @empty
        <li>No friends yet ( ˘ω˘ )</li>
    @endforelse
</ul>
