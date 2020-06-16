<x-app>
    <header class="mb-6">
        <div class="relative">
            <img class="mb-2" src="{{ asset('/images/profile-banner.jpg') }}" alt="banner-image">
            <img src={{ $user->avatar }} alt="user" width="150" style="left: 50%;"
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2">
        </div>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                {{-- memo: Carbonライブラリの便利メソッド現: diffForHumans() 現在の時間とcreated_atの差分表示 --}}
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @can ('edit', $user)
                    <a href="/profiles/{{ $user->name }}/edit" class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2">Edit Profile</a>
                @endcan

                        {{-- コンポーネントへ$userの受け渡し --}}
                <x-follow-button :user="$user"></x-follow-button>
            </div>
        </div>

        <p class="text-sm">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis quod dignissimos corrupti officia, nam, magni ullam delectus culpa nobis repudiandae facilis nisi numquam ipsum quae libero blanditiis quisquam magnam accusamus!
        </p>

    </header>
    <hr>

    @include('_timeline', [
        'tweets' => $user->tweets
    ])
</x-app>
