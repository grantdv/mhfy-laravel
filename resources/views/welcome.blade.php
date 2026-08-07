<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>May Harmony Find You - Brand Colors</title>
    <link rel="stylesheet" href="{{ asset('css/brand.css') }}">
</head>
<body class="font-sans bg-white">
    <!-- Navigation Bar -->
    <nav class="bg-brand-dark text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="logo-white-bg">
                        <img src="{{ asset('images/logo.png') }}" alt="May Harmony Find You Logo" class="h-12 w-auto">
                    </div>
                    <span class="text-xl font-bold">May Harmony Find You</span>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('products.index') }}" class="text-brand-light hover:text-brand-medium transition">Products</a>
                    <a href="{{ route('contact') }}" class="text-brand-light hover:text-brand-medium transition">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-brand text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center mb-6">
                <div class="logo-white-bg bg-white/90 backdrop-blur-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="May Harmony Find You Logo" class="h-20 w-auto mx-auto">
                </div>
            </div>
            <h1 class="text-5xl font-bold mb-4">May Harmony Find You</h1>
            <p class="text-xl mb-8">Discover tranquility and balance in your daily life</p>
            <a href="{{ route('products.index') }}" class="bg-brand text-lg py-3 px-8 rounded-lg font-bold text-white">Explore Now</a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-16 bg-brand-bg-light">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-brand-dark text-center mb-12">Our Products</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6 border-2 border-brand-accent">
                    <div class="text-brand-accent text-4xl mb-4"><i class="fas fa-star"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Product 1</h3>
                    <p class="text-gray-600 mb-4">Product description</p>
                    <button class="bg-brand text-white w-full py-2 px-4 rounded-lg font-bold">Add to Cart</button>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Product 2</h3>
                    <p class="text-gray-600 mb-4">Product description</p>
                    <button class="bg-brand text-white w-full py-2 px-4 rounded-lg font-bold">Add to Cart</button>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Product 3</h3>
                    <p class="text-gray-600 mb-4">Product description</p>
                    <button class="bg-brand text-white w-full py-2 px-4 rounded-lg font-bold">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
