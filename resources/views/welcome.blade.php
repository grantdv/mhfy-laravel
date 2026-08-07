<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>May Harmony Find You - Brand Colors</title>
    <link rel="stylesheet" href="{{ asset('css/brand.css') }}">
</head>
<body class="font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-brand-dark text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="logo-white-bg">
                        <img src="{{ asset('images/logo.png') }}" alt="May Harmony Find You Logo" class="h-12 w-auto">
                    </div>
                    <span class="text-xl font-bold">May Harmony Find You</span>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('products.index') }}" class="text-brand-light hover:text-brand-medium transition">Products</a>
                    <a href="{{ route('contact') }}" class="text-brand-light hover:text-brand-medium transition">Contact</a>
                </div>
                <div>
                    <a href="{{ route('login') }}" class="bg-brand-medium text-white px-4 py-2 rounded text-sm font-semibold">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Gradient Background -->
    <section id="home" class="bg-gradient-brand text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center mb-6">
                <div class="logo-white-bg bg-white/90 backdrop-blur-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="May Harmony Find You Logo" class="h-20 w-auto mx-auto">
                </div>
            </div>
            <h1 class="text-5xl font-bold mb-4">May Harmony Find You</h1>
            <p class="text-xl mb-8">Discover tranquility and balance in your daily life</p>
            <a href="{{ route('products.index') }}" class="bg-brand-accent text-white text-lg py-3 px-8 rounded-lg font-bold hover:bg-orange-600 transition duration-300 shadow-lg">
                Explore Now
            </a>
        </div>
    </section>

    <!-- Orange Accent Showcase Section -->
    <section class="py-16 bg-gradient-accent text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur rounded-lg p-6">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-4 h-4 rounded-full bg-brand-accent"></div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-4 h-4 rounded-full bg-brand-accent"></div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-4 h-4 rounded-full bg-brand-accent"></div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-4 h-4 rounded-full bg-brand-accent"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-lg p-6">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded bg-brand-dark"></div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded bg-brand-medium"></div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded bg-brand-light"></div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded bg-brand-accent shadow-lg shadow-orange-500/50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
