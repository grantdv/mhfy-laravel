<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | MHFY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-brand-light">MHFY Admin - Edit Product</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-sm text-brand-light hover:text-brand-medium">Back to List</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-brand-light">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-brand-dark">Product Details</h2>
                    <div class="flex items-center">
                        <span class="mr-2 text-sm text-gray-500">Status:</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-brand-bg-medium peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-light rounded-full peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 peer-checked:bg-brand-medium"></div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-brand-dark mb-1">Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" required class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-brand-dark mb-1">Description</label>
                        <textarea name="description" rows="5" required class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none">{{ $product->description }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Price ($)</label>
                        <input type="number" name="price" step="0.01" value="{{ $product->price }}" required class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" required class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-brand-dark mb-1">Product Image</label>
                        <input type="file" name="image" class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none">
                        @if($product->image)
                            <div class="mt-2">
                                <p class="text-xs text-gray-500 mb-2">Current image: {{ $product->image }}</p>
                                <a href="{{ asset('storage/'.$product->image) }}" target="_blank" class="text-brand-medium hover:underline">View Image</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="bg-brand-medium text-white px-8 py-3 rounded-lg font-bold hover:bg-brand-light transition-colors shadow-lg shadow-brand-bg-light">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
