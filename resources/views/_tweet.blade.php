<div class="flex p-4 border-b boder-b-gray-400">

    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('profile', $tweet->user) }}">
            <img src={{ auth()->user()->avatar }} alt="user" class="rounded-full mr-2" width="50" style="height: 50px; object-fit: cover; object-position: center;">
        </a>
    </div>

    <div>
        <h5 class="font-bold mb-2">
            <a href="{{ route('profile', $tweet->user) }}">
                {{ $tweet->user->name }}
            </a>
        </h5>
        <p class="text-sm mb-3">{{ $tweet->body }}</p>

        <div class="flex">
            <div class="flex items-center mr-4 {{ $tweet->isLikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
                <div class="mr-1 w-3" style="transform: scale(-1,1)">
                    <i class="far fa-thumbs-up"></i>
                </div>

                <span class="text-xs">{{ $tweet->countLikesOrDislikes(true) }}</span>
            </div>

            <div class="flex items-center {{ $tweet->isDislikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
                <div class="mr-1 w-3" style="transform: scale(-1,1)">
                    <i class="far fa-thumbs-down"></i>
                </div>

                <span class="text-xs">{{ $tweet->countLikesOrDislikes(false) }}</span>
            </div>
        </div>
    </div>
</div>
