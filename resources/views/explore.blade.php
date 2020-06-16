<x-app>
    <div>
        @foreach ($users as $user)
            <a href="/profiles/{{ $user->username }}" class="flex items-center mb-5">
                <img
                    src="{{ $user->avatar }}"
                    alt="{{ $user->name }}'s avatar"
                    width="60"
                    class="mr-4 rounded"
                    style="height: 60px; object-fit: cover; object-position: center;"
                >

                <div>
                    <h4 class="font-bold">{{ '@' . $user->username }}</h4>
                </div>

            </a>
        @endforeach

        {{-- pagination用のリンクを自動で挿入してくれる --}}
        {{ $users->links() }}
    </div>
</x-app>
