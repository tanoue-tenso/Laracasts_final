<div class="flex">
    <form action="/tweets/{{ $tweet->id }}/like" method="post">
        @csrf
        <div class="flex items-center mr-4 {{ $tweet->isLikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
            <div class="mr-1 w-3" style="transform: scale(-1,1)">
                <i class="far fa-thumbs-up"></i>
            </div>

            <button type="submit" class="text-xs">{{ $tweet->countLikesOrDislikes(true) }}</button>
        </div>
    </form>

    <form action="/tweets/{{ $tweet->id }}/like" method="post">
        @csrf
        @method('delete')
        <div class="flex items-center {{ $tweet->isDislikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
            <div class="mr-1 w-3" style="transform: scale(-1,1)">
                <i class="far fa-thumbs-down"></i>
            </div>

            <button type="submit" class="text-xs">{{ $tweet->countLikesOrDislikes(false) }}</button>
        </div>
    </form>
</div>
