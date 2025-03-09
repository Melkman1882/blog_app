<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::latest()->paginate(6); // 6 posts per page
        $myPosts = auth()->user() ? auth()->user()->posts()->latest()->paginate(6) : collect([]); // Fix pagination

        return view('posts.index', compact('allPosts', 'myPosts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate image
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public'); // Save in storage/app/public/post_images
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403, 'Unauthorized access.');

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403, 'Unauthorized access.');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
            $post->image = $imagePath;
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $post->image,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403, 'Unauthorized access.');

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
