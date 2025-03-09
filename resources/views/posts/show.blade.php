@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" 
                     class="w-1/2 sm:w-1/3 md:w-1/4 mx-auto h-auto rounded-lg mb-4 shadow-md">
            @endif
            
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            <p class="text-gray-600 text-sm mb-2">
                Posted on {{ $post->created_at->format('F d, Y') }}  
                <br>
                <span class="text-gray-800 font-semibold">By: {{ $post->user->name ?? 'Unknown' }}</span>
            </p>
            <p class="text-gray-800 leading-relaxed">{!! nl2br(e($post->content)) !!}</p>

            <div class="mt-6">
                <a href="{{ route('posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                    Back to Posts
                </a>

                @if(auth()->id() == $post->user_id)
                    <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition ml-2">
                        Edit Post
                    </a>
                @endif
            </div>
        </div>

        <div class="mt-10 bg-white p-6 rounded-lg shadow-md">
            @if(Auth::check())
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="content" class="w-full border p-2" rows="3" placeholder="Add a comment"></textarea>
                    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Post Comment</button>
                </form>
            @else
                <p class="text-gray-500">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to comment.</p>
            @endif

            <h3 class="mt-5">Comments</h3>
            @foreach($post->comments as $comment)
                <div class="border p-3 mt-3">
                    <strong>{{ $comment->user->name }}</strong> said:
                    <p id="comment-{{ $comment->id }}">{{ $comment->content }}</p>
                    <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>

                    @if(Auth::id() === $comment->user_id)
                        <div class="flex flex-col space-y-2 mt-2">
                            <!-- Edit Comment Form -->
                            <form action="{{ route('comments.update', $comment) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <textarea name="content" class="w-full border p-2">{{ $comment->content }}</textarea>
                                <button type="submit" class="mt-2 bg-yellow-500 text-white px-4 py-2 rounded">Edit</button>
                            </form>

                            <!-- Delete Comment Form -->
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
