<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | May Harmony Find You</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute -top-1 -right-2 bg-brand-orange text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount ?? 0 }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('products.index') }}" class="text-brand-light hover:text-white font-medium">Back to Catalog</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-brand-light">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 relative h-96 bg-brand-bg-medium">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=500&h=500&fit=crop" alt="Product placeholder" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                    <div class="mb-8">
                        <h1 class="text-4xl font-extrabold text-brand-dark mb-2">{{ $product->name }}</h1>
                        <p class="text-lg text-brand-medium font-semibold">${{ number_format($product->price, 2) }}</p>
                    </div>

                    <div class="prose prose-brand max-w-none text-gray-600 mb-10">
                        <p class="text-xl leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                <div class="border-t border-brand-light pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-6">
                        <div class="text-gray-600">
                            @if($product->stock_quantity > 0)
                                <span class="text-green-600 font-bold">In Stock ({{ $product->stock_quantity }} available)</span>
                            @else
                                <span class="text-brand-orange font-bold">Backordered</span>
                            @endif
                        </div>
                        
                        <form action="{{ route('cart.add') }}" method="POST" class="flex space-x-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-brand-medium text-white px-8 py-4 rounded-xl font-bold hover:bg-brand-light transition duration-300 shadow-lg shadow-brand-bg-light">
                                Add to Selection
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
