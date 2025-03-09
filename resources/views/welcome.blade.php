<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App - Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">BlogApp</h1>
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold">Login</a>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold mb-4">Discover Amazing Stories</h2>
            <p class="text-lg mb-6">Explore blogs on technology, lifestyle, and more!</p>
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold">Get Started</a>
        </div>
    </section>
    
    <!-- Recent Blogs -->
    <section class="container mx-auto py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Latest Blogs</h2>
        <div class="grid md:grid-cols-3 gap-6 px-4">
            @foreach($posts as $post)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-40 object-cover rounded-md mb-3">
                    @endif
                    <h3 class="text-xl font-bold">{{ $post->title }}</h3>
                    <p class="text-gray-600 mt-2">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 mt-4 block">Read More →</a>
                </div>
            @endforeach
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="bg-blue-600 text-white py-12 text-center">
        <h2 class="text-2xl font-bold">Start Reading Now!</h2>
        <p class="mt-2">Join our platform and explore a variety of blogs.</p>
        <a href="#" class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold mt-4 inline-block">Join Now</a>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-10">
        <p>&copy; 2025 BlogApp. All Rights Reserved.</p>
    </footer>
</body>
</html>