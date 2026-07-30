<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | May Harmony Find You</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">May Harmony Find You</a>
                </div>
                <div class="flex space-x-4 items-center">
                    <a href="{{ route('cart.show') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out relative">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Cart
                        @php
                            $cart = \App\Services\CartService::getCart();
                            $cartCount = count($cart);
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium">Products</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-indigo-600 font-medium">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900">Our Services</h1>
            <p class="mt-4 text-lg text-gray-600">Select a service below to explore our premium concierge offerings.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($products as $product)
            <div class="group bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative h-64 bg-gray-100 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=500&h=500&fit=crop" alt="Product placeholder" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $product->description }}</p>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="text-xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product->id) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">Details</a>
                            <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-indigo-700 transition duration-200">
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
