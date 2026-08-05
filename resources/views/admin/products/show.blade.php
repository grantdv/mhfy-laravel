<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details | MHFY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-brand-light">MHFY Admin - Product Details</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-sm text-brand-light hover:text-brand-medium">Back to List</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-brand-light">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-brand-dark mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-500">ID: #{{ $product->id }} | Slug: {{ $product->slug }}</p>
                </div>
                <div class="flex space-x-3">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-brand-medium text-white' : 'bg-brand-bg-medium text-brand-orange' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-brand-dark mb-2">Description</h3>
                        <p class="text-gray-600 whitespace-pre-wrap">{{ $product->description }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Price</h3>
                            <p class="text-xl font-bold text-brand-dark">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Stock Quantity</h3>
                            <p class="text-xl font-bold {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-brand-orange' }}">
                                {{ $product->stock_quantity }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center bg-brand-bg-medium rounded-xl p-4 border border-brand-light">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="max-h-96 rounded-lg shadow-md" alt="{{ $product->name }}">
                    @else
                        <div class="text-center">
                            <img src="https://via.placeholder.com/400x300?text=No+Image" class="max-h-96 rounded-lg shadow-md" alt="No image">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-brand-light flex justify-between">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-brand-medium text-white px-6 py-2 rounded-lg font-bold hover:bg-brand-light transition-colors shadow-lg shadow-brand-bg-light">
                    Edit Product
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-brand-orange hover:text-orange-700 font-bold" onclick="return confirm('Are you sure you want to delete this product?')">
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
