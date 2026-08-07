<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>May Harmony Find You - Brand Colors</title>
    <link rel="stylesheet" href="{{ asset('css/brand.css') }}">
</head>
<body class="bg-dark-blue">
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

    <!-- Hero Section with Logo - Light Blue Background -->
    <section class="bg-light-blue py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center mb-8">
                <div class="logo-white-bg bg-white/90 backdrop-blur-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="May Harmony Find You Logo" class="h-20 w-auto mx-auto">
                </div>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl font-bold mb-6 text-center text-brand-dark">May Harmony Find You</h1>
                <p class="text-xl mb-12 text-center text-brand-dark">Discover tranquility and balance in your daily life</p>
                
                <div class="bg-white p-8 rounded-xl shadow-lg border border-brand-light mb-8">
                    <h2 class="text-3xl font-bold text-brand-dark mb-6 text-center">Welcome</h2>
                    <p class="text-gray-600 mb-8 text-center">
                        Your premier concierge for bespoke experiences and high-end services. 
                        Our team is dedicated to ensuring your experience is seamless.
                    </p>
                    
                    <div class="flex space-x-4 justify-center">
                        <a href="{{ route('products.index') }}" class="inline-block bg-brand-medium text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-light transition duration-300 shadow-lg shadow-brand-bg-light text-center">
                            Products
                        </a>
                        <a href="{{ route('contact') }}" class="inline-block bg-brand-bg-light text-brand-dark px-6 py-3 rounded-lg font-semibold hover:bg-brand-light transition duration-300 text-center">
                            Get in Touch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Orange Splash Section -->
    <section class="bg-orange-splash py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Begin?</h2>
            <p class="text-white/90 mb-8">Explore our curated collection of premium products</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-white text-brand-dark px-8 py-3 rounded-lg font-bold hover:bg-brand-light transition duration-300 shadow-lg">
                Browse Products
            </a>
        </div>
    </section>
</body>
</html>
