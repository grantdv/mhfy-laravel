<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to May Harmony Find You</title>
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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
            <h1 class="text-3xl font-bold mb-2 text-gray-900">Welcome to May Harmony Find You</h1>
            <p class="text-gray-600 mb-8">Your premier concierge for bespoke experiences and high-end services.</p>
            
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 shadow-lg shadow-indigo-100 text-center">
                    Explore Our Services
                </a>
                <a href="{{ route('contact') }}" class="inline-block bg-gray-100 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition duration-300 text-center">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</body>
</html>
