<!-- Standalone Navigation for Public Pages with Tailwind Config -->
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
