<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Checkout | May Harmony Find You</title>
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
                                {{ data_get($cartCount, 0) }}
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
        @if(empty($cart))
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 text-center">
                <h1 class="text-3xl font-bold mb-4 text-gray-900">Your cart is empty</h1>
                <p class="text-gray-600 mb-8">It looks like you haven't added any products to your cart yet.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-100">
                    Browse Products
                </a>
            </div>
        @else
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                <h1 class="text-3xl font-bold mb-8 text-gray-900">Complete Your Inquiry</h1>
                
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-4">Order Summary</h3>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-2 text-left">Item</th>
                                    <th class="py-2 text-center">Qty</th>
                                    <th class="py-2 text-right">Price</th>
                                    <th class="py-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($cart as $id => $item)
                                <tr class="border-b border-gray-100 last:border-none">
                                    <td class="py-2">
                                        @isset($item['image'])
                                            <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded-lg">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=100&h=100&fit=crop" alt="Product placeholder" class="w-12 h-12 object-cover rounded-lg">
                                        @endisset
                                        <span class="text-sm font-medium block mt-1">{{ $item['name'] ?? 'Product ' . $item['id'] }}</span>
                                    </td>
                                    <td class="py-2 text-center">{{ $item['quantity'] }}</td>
                                    <td class="py-2 text-right">${{ number_format($item['price'], 2) }}</td>
                                    <td class="py-2 text-right font-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                            <span class="text-lg font-bold">Total:</span>
                            <span class="text-xl font-bold text-indigo-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="full_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                        <textarea name="shipping_address" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"></textarea>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-100">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

</body>
</html>
