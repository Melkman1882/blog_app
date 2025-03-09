<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Post;

// Serve the landing page at the root "/"
Route::get('/', function () {
    $posts = Post::latest()->take(6)->get(); // Fetch latest 6 posts
    return view('welcome', compact('posts')); // Pass posts to the view
});

// Redirect dashboard to blog posts after login
Route::get('/dashboard', function () {
    return redirect()->route('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication routes (login, register, etc.)
require __DIR__.'/auth.php';

// Group protected routes that require authentication
Route::middleware('auth')->group(function () {
    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Blog post CRUD routes (only authenticated users can access)
    Route::resource('posts', PostController::class);

    // Comment routes
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
