<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | May Harmony Find You</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-8">Your Selection</h1>
        
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
                                <span class="text-sm font-medium">{{ $item['id'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $item['quantity'] }}</td>
                            <td class="px-6 py-4 text-sm">$0.00</td>
                            <td class="px-6 py-4 text-sm">$0.00</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6 bg-gray-50 flex justify-between items-center">
                    <span class="text-xl font-bold">Total: $0.00</span>
                    <div class="flex space-x-4">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline">Clear Cart</button>
                        </form>
                        <a href="{{ route('inquiry.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg">Complete Your Order</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
