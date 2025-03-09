@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4 text-center">Edit Post</h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold">Title:</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-semibold">Content:</label>
                    <textarea name="content" id="content" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" rows="5" required>{{ $post->content }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold">Upload Image</label>
                    <input type="file" name="image" id="image" class="mt-2 border rounded w-full p-2">
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
