<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products | May Harmony Find You</title>
    <link rel="stylesheet" href="{{ asset('css/brand.css') }}">
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-brand-light">
                        <div class="logo-white-bg inline-block">
                            <img src="{{ asset('images/logo.png') }}" alt="May Harmony Find You Logo" class="h-10 w-auto">
                        </div>
                        <span class="ml-2">May Harmony Find You</span>
                    </a>
                </div>
                <div class="flex space-x-4 items-center">
                    <a href="{{ route('cart.show') }}" class="inline-flex items-center px-3 py-2 border border-brand-light text-sm leading-4 font-medium rounded-md text-brand-light bg-brand-bg-light hover:bg-brand-light hover:text-brand-dark focus:outline-none transition duration-150 ease-in-out relative">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Cart
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute -top-1 -right-2 bg-brand-orange text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount ?? 0 }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('products.index') }}" class="text-brand-light hover:text-white font-medium">Products</a>
                    <a href="{{ route('contact') }}" class="text-brand-light hover:text-white font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="mb-12 text-center">
            <h1 class="text-4xl font-extrabold text-brand-dark">Our Products</h1>
            <p class="mt-4 text-lg text-gray-600">Explore our curated collection of premium products.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($products as $product)
            <div class="group bg-brand-bg-light rounded-xl shadow-md overflow-hidden border border-brand-light hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative h-64 bg-brand-bg-medium overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=500&h=500&fit=crop" alt="Product placeholder" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-brand-dark mb-2 group-hover:text-brand-medium transition-colors">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $product->description }}</p>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="text-xl font-bold text-brand-medium">${{ number_format($product->price, 2) }}</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product->id) }}" class="text-sm font-semibold text-brand-medium hover:text-brand-light">Details</a>
                            <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-brand-medium text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-brand-light transition duration-200">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
