<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | May Harmony Find You</title>
    <link rel="stylesheet" href="{{ asset('css/brand.css') }}">
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
                    <a href="{{ route('products.index') }}" class="text-brand-light hover:text-white">Products</a>
                    <a href="{{ route('contact') }}" class="text-brand-light hover:text-white">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-brand-dark mb-8">Your Selection</h1>

        @if(count($cart) === 0)
            <div class="bg-white p-8 rounded-lg shadow-md text-center border border-brand-light">
                <p class="text-gray-600 mb-4">Your selection is currently empty.</p>
                <a href="{{ route('products.index') }}" class="text-brand-medium hover:text-brand-light hover:underline">Explore our collection</a>
            </div>
        @else
            @php
                $total = 0;
                foreach($cart as $item) {
                    $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                }
            @endphp
            <div class="bg-white shadow-md rounded-lg overflow-hidden border border-brand-light">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-brand-bg-medium">
                            <th class="px-6 py-3 text-sm font-medium text-brand-dark">Product</th>
                            <th class="px-6 py-3 text-sm font-medium text-brand-dark">Quantity</th>
                            <th class="px-6 py-3 text-sm font-medium text-brand-dark">Price</th>
                            <th class="px-6 py-3 text-sm font-medium text-brand-dark">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-light">
                        @foreach($cart as $id => $item)
                        <tr>
                            <td class="px-6 py-4">
                                @isset($item['image'])
                                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=100&h=100&fit=crop" alt="Product placeholder" class="w-12 h-12 object-cover rounded-lg">
                                @endisset
                                <span class="text-sm font-medium text-brand-dark block mt-1">{{ $item['name'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="text-brand-orange hover:text-orange-700 text-sm">Remove</button>
                                </form>
                                <span class="text-sm text-gray-500 ml-2">{{ $item['quantity'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-brand-dark">${{ number_format($item['price'], 2) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-brand-dark">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6 bg-brand-bg-medium flex justify-between items-center border-t border-brand-light">
                    <span class="text-xl font-bold text-brand-dark">Total: ${{ number_format($total, 2) }}</span>
                    <div class="flex space-x-4">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-brand-orange hover:underline">Clear Cart</button>
                        </form>
                        <a href="{{ route('inquiry.create', ['cart' => $cart]) }}" class="bg-brand-medium text-white px-6 py-2 rounded-lg hover:bg-brand-light transition-colors shadow-lg shadow-brand-bg-light">Complete Your Order</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
