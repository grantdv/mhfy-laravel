<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to May Harmony Find You</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,load"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#04405F',
                            medium: '#3483EB',
                            light: '#8AE1F0',
                            accent: '#f5771d',
                            bgLight: '#F0FCFD',
                            bgMedium: '#D2F4F9',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-brand-light">May Harmony Find You</a>
                </div>
                <div class="flex space-x-4 items-center">
                    <a href="{{ route('cart.show') }}" class="inline-flex items-center px-3 py-2 border border-brand-light text-sm leading-4 font-medium rounded-md text-brand-light bg-brand-bg-light hover:bg-brand-light hover:text-brand-dark focus:outline-none transition duration-150 ease-in-out relative">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Cart
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-2 bg-brand-orange text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount ?? 0 }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('products.index') }}" class="text-brand-light hover:text-white font-medium">Products</a>
                    <a href="{{ route('contact') }}" class="text-brand-light hover:text-white font-medium">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-brand-light">
            <h1 class="text-3xl font-bold mb-2 text-brand-dark">Welcome to May Harmony Find You</h1>
            <p class="text-gray-600 mb-8">Your premier concierge for bespoke experiences and high-end services.</p>
            
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('products.index') }}" class="inline-block bg-brand-medium text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-light transition duration-300 shadow-lg shadow-brand-bg-light text-center">
                    Explore Our Services
                </a>
                <a href="{{ route('contact') }}" class="inline-block bg-brand-bg-light text-brand-dark px-6 py-3 rounded-lg font-semibold hover:bg-brand-light transition duration-300 text-center">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</body>
</html>
