<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | May Harmony Find You</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">May Harmony Find You</a>
            <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600">Products</a>
        </div>
    </nav>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Your Selection</h1>
        @php
            $total = 0;
            foreach($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        @endphp
        
        @if(count($cart) === 0)
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <p class="text-gray-600 mb-4">Your selection is currently empty.</p>
                <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Explore our collection</a>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-sm font-medium text-gray-900">Product</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-900">Quantity</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-900">Price</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-900">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($cart as $id => $item)
                        <tr>
                            <td class="px-6 py-4">
                                @if($item['image'])
                                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=100&h=100&fit=crop" alt="Product placeholder" class="w-12 h-12 object-cover rounded-lg">
                                @endif
                                <span class="text-sm font-medium block mt-1">{{ $item['name'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Remove</button>
                                </form>
                                <span class="text-sm text-gray-500 ml-2">{{ $item['quantity'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium">${{ number_format($item['price'], 2) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6 bg-gray-50 flex justify-between items-center">
                    <span class="text-xl font-bold">Total: ${{ number_format($total, 2) }}</span>
                    <div class="flex space-x-4">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline">Clear Cart</button>
                        </form>
                        <a href="{{ route('inquiry.create', ['cart' => $cart]) }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg">Complete Your Order</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
