@if (auth()->user()->isNot($user))
    <form method="POST" action="/profiles/{{ $user->username }}/follow">
        @csrf
        <button href="" class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs">
            {{ auth()->user()->isFollow($user) ? 'Unfollow Me' : 'Follow Me' }}
        </button>
    </form>
@endif
