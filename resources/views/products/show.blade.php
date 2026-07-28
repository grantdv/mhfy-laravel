<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | MHFY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">MHFY</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium">Back to Catalog</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div>
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $product->name }}</h1>
                        <p class="text-lg text-indigo-600 font-semibold">${{ number_format($product->price, 2) }}</p>
                    </div>
                </div>

                <div class="prose prose-indigo max-w-none text-gray-600 mb-10">
                    <p class="text-xl leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="border-t border-gray-100 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-6">
                        <div class="text-gray-600">
                            @if($product->stock_quantity > 0)
                                <span class="text-green-600 font-bold">In Stock ({{ $product->stock_quantity }} available)</span>
                            @else
                                <span class="text-orange-600 font-bold">Backordered</span>
                            @endif
                        </div>
                        
                        <form action="{{ route('cart.add') }}" method="POST" class="flex space-x-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-indigo-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-indigo-700 transition duration-300 shadow-lg shadow-indigo-200">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
