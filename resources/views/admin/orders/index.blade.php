<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | MHFY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">MHFY Admin</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-sm hover:text-indigo-300">Products</a>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-indigo-400">Orders</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Dashboard Overview</h2>
            <a href="{{ route('admin.orders.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-indigo-700 transition-colors shadow-md">
                View All Orders
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Revenue</p>
                <p class="text-3xl font-bold text-indigo-600 mt-2">${{ number_format($totalRevenue, 2) }}</p>
                <p class="text-xs text-gray-400 mt-1">From paid orders</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Orders</p>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalOrders }}</p>
                <p class="text-xs text-gray-400 mt-1">Total requests processed</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Conversion Rate</p>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $conversionRate }}%</p>
                <p class="text-xs text-gray-400 mt-1">Inquiry to Paid %</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="text-lg font-bold mb-4">Inventory Alerts</h3>
                <ul class="space-y-3">
                    @forelse ($lowStockProducts as $product)
                        <li class="flex justify-between items-center p-3 bg-orange-50 rounded-lg border border-orange-100">
                            <span class="font-medium text-gray-900">{{ $product->name }}</span>
                            <span class="text-sm font-bold text-orange-700">Only {{ $product->stock_quantity }} left!</span>
                        </li>
                    @empty
                        <li class="text-gray-500 py-4 text-center">All products are well-stocked.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="text-lg font-bold mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    @forelse ($recentOrders as $order)
                        <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                            <div>
                                <p class="text-sm font-bold text-gray-900">Order #{{ $order->id }}</p>
                                <p class="text-xs text-gray-500">{{ $order->full_name }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent activity.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</body>
</html>
