@extends('layouts.app')

@section('content')
    @include('_publish-tweet-pannel')

    <div class="border border-gray-300 rounded-lg">
        @foreach ($tweets as $tweet)
            @include('_tweet')
        @endforeach
    </div>
@endsection
