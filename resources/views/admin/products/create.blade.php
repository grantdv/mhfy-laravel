<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product | MHFY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-brand-light hover:text-brand-medium">← Back to Dashboard</a>
            <div class="flex space-x-4">
                <a href="{{ route('admin.orders.index') }}" class="text-sm text-brand-light hover:text-brand-medium">Orders</a>
                <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-brand-medium">Products</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-xl rounded-xl p-8 border border-brand-light">
            <h1 class="text-3xl font-extrabold text-brand-dark mb-6">Add New Product</h1>

            @if ($errors->any())
                <div class="bg-brand-bg-light border border-brand-orange text-brand-orange px-4 py-3 rounded mb-6">
                    <strong>Validation Error:</strong>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-brand-dark mb-2">Product Name *</label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium"
                            placeholder="e.g., Premium Handbag">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-brand-dark mb-2">Price ($)</label>
                        <input type="number" name="price" id="price" step="0.01" required min="0"
                            class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium"
                            placeholder="e.g., 299.99">
                    </div>

                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-brand-dark mb-2">Stock Quantity *</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" required min="0"
                            class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium"
                            placeholder="e.g., 50">
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-brand-dark mb-2">Product Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium">
                        <p class="text-xs text-gray-500 mt-1">Max size: 2MB. Accepted: jpg, png, gif, webp, bmp</p>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-brand-dark mb-2">Description *</label>
                    <textarea name="description" id="description" rows="6" required
                        class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium"
                        placeholder="Describe the product in detail..."></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-6 py-2 border border-brand-light text-brand-dark rounded-lg hover:bg-brand-bg-light transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-brand-medium text-white rounded-lg font-bold hover:bg-brand-light transition-colors shadow-lg shadow-brand-bg-light">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
