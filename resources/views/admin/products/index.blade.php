<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | MHFY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-brand-light">MHFY Admin - Products</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.orders.index') }}" class="text-sm text-brand-light hover:text-brand-medium">Orders</a>
                <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-brand-medium">Products</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-brand-dark">Product Catalog</h2>
            <a href="{{ route('admin.products.create') }}" class="bg-brand-medium text-white px-4 py-2 rounded-lg font-bold hover:bg-brand-light transition-colors shadow-lg shadow-brand-bg-light">
                + Add New Product
            </a>
        </div>

        @if (session('success'))
            <div class="bg-brand-bg-light border border-brand-orange text-brand-orange px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-brand-light">
            <table class="min-w-full divide-y divide-brand-light">
                <thead class="bg-brand-bg-medium">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brand-dark uppercase tracking-wider">Product Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brand-dark uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brand-dark uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brand-dark uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-brand-dark uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-brand-light">
                    @forelse ($products as $product)
                    <tr class="hover:bg-brand-bg-light transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/40' }}" class="w-8 h-8 rounded-full mr-3" alt="">
                                <span class="text-sm font-medium text-brand-dark">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-dark">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-dark">
                            @if($product->stock_quantity > 0)
                                <span class="text-green-600 font-bold">{{ $product->stock_quantity }}</span>
                            @else
                                <span class="text-brand-orange font-bold">0 (Backordered)</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->is_active)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-brand-medium text-white">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-brand-bg-medium text-brand-orange">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="text-brand-medium hover:text-brand-light mr-4">View</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-brand-medium hover:text-brand-light mr-4">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-brand-orange hover:text-orange-700" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">No products found in the catalog.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 bg-brand-bg-medium text-sm text-brand-dark text-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</body>
</html>
