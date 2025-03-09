@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4 md:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-center mb-10 text-gray-800">Blog Posts</h1>

    <!-- Tab Navigation -->
    <div class="flex justify-center space-x-6 mb-8 border-b pb-3">
        <button id="allBlogsTab" class="tab-btn px-6 py-2 text-lg font-semibold border-b-4 border-blue-600 text-blue-600 focus:outline-none transition-all duration-300">
            All Blogs
        </button>
        <button id="myBlogsTab" class="tab-btn px-6 py-2 text-lg font-semibold text-gray-500 border-b-4 border-transparent hover:text-blue-600 hover:border-blue-600 transition-all duration-300">
            My Blogs
        </button>
    </div>

    <!-- Create Post Button -->
    <div class="flex justify-end mb-8">
        <a href="{{ route('posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md shadow transition-all duration-300">
            + Create New Post
        </a>
    </div>

    <!-- All Blogs Section -->
    <div id="allBlogsSection">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($allPosts as $post)
            <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-64 object-cover">
                @endif

                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Posted on {{ $post->created_at->format('F d, Y') }}  
                        <br> By: <span class="text-blue-600 font-semibold">{{ $post->user->name ?? 'Unknown' }}</span>
                    </p>

                    <p class="text-gray-700 mt-3 line-clamp-3">{{ Str::limit(strip_tags($post->content), 120) }}</p>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline font-semibold transition duration-300">
                            Read More →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination moved below the grid -->
        <div class="mt-12 flex justify-center">
            {{ $allPosts->links() }}
        </div>
    </div>

    <!-- My Blogs Section (Initially Hidden) -->
    <div id="myBlogsSection" class="hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($myPosts as $post)
            <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-64 object-cover">
                @endif

                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Posted on {{ $post->created_at->format('F d, Y') }}
                    </p>
                    <p class="text-gray-700 mt-3 line-clamp-3">{{ Str::limit(strip_tags($post->content), 120) }}</p>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline font-semibold transition duration-300">
                            Read More →
                        </a>
                        <div class="flex space-x-2">
                            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination moved below the grid -->
        @if($myPosts->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $myPosts->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>

<!-- JavaScript for Tabs & Delete Confirmation -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const allBlogsTab = document.getElementById("allBlogsTab");
        const myBlogsTab = document.getElementById("myBlogsTab");
        const allBlogsSection = document.getElementById("allBlogsSection");
        const myBlogsSection = document.getElementById("myBlogsSection");

        function switchTab(activeTab, inactiveTab, activeSection, inactiveSection) {
            activeTab.classList.add("text-blue-600", "border-blue-600");
            activeTab.classList.remove("text-gray-500", "border-transparent");
            inactiveTab.classList.add("text-gray-500", "border-transparent");
            inactiveTab.classList.remove("text-blue-600", "border-blue-600");

            activeSection.classList.remove("hidden");
            inactiveSection.classList.add("hidden");
        }

        allBlogsTab.addEventListener("click", function () {
            switchTab(allBlogsTab, myBlogsTab, allBlogsSection, myBlogsSection);
        });

        myBlogsTab.addEventListener("click", function () {
            switchTab(myBlogsTab, allBlogsTab, myBlogsSection, allBlogsSection);
        });
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this post?");
    }
</script>
@endsection
