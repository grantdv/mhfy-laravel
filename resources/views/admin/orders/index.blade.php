<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | MHFY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-brand-light">MHFY Admin</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-sm text-brand-light hover:text-brand-medium">Products</a>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-brand-medium">Orders</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-brand-dark">Dashboard Overview</h2>
            <a href="{{ route('admin.orders.index') }}" class="bg-brand-medium text-white px-4 py-2 rounded-lg font-bold hover:bg-brand-light transition-colors shadow-lg shadow-brand-bg-light">
                View All Orders
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-md border border-brand-light">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Revenue</p>
                <p class="text-3xl font-bold text-brand-medium mt-2">${{ number_format($totalRevenue, 2) }}</p>
                <p class="text-xs text-gray-400 mt-1">From paid orders</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border border-brand-light">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Orders</p>
                <p class="text-3xl font-bold text-brand-medium mt-2">{{ $totalOrders }}</p>
                <p class="text-xs text-gray-400 mt-1">Total requests processed</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border border-brand-light">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Conversion Rate</p>
                <p class="text-3xl font-bold text-brand-medium mt-2">{{ $conversionRate }}%</p>
                <p class="text-xs text-gray-400 mt-1">Inquiry to Paid %</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md border border-brand-light">
                <h3 class="text-lg font-bold mb-4 text-brand-dark">Inventory Alerts</h3>
                <ul class="space-y-3">
                    @forelse ($lowStockProducts as $product)
                        <li class="flex justify-between items-center p-3 bg-brand-bg-medium rounded-lg border border-brand-orange">
                            <span class="font-medium text-brand-dark">{{ $product->name }}</span>
                            <span class="text-sm font-bold text-brand-orange">Only {{ $product->stock_quantity }} left!</span>
                        </li>
                    @empty
                        <li class="text-gray-500 py-4 text-center">All products are well-stocked.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border border-brand-light">
                <h3 class="text-lg font-bold mb-4 text-brand-dark">Recent Activity</h3>
                <div class="space-y-4">
                    @forelse ($recentOrders as $order)
                        <div class="flex justify-between items-center border-b border-brand-light pb-2">
                            <div>
                                <p class="text-sm font-bold text-brand-dark">Order #{{ $order->id }}</p>
                                <p class="text-xs text-gray-500">{{ $order->full_name }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $order->status === 'paid' ? 'bg-brand-medium text-white' : 'bg-brand-bg-medium text-brand-orange' }}">
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
