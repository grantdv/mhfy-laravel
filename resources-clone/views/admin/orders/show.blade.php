<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} | MHFY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-gray-800 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold">MHFY Admin</h1>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-300 hover:text-white">Back to Orders</a>
                </div>
            </div>
        </header>

        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900">Order #{{ $order->id }}</h2>
                <div class="flex space-x-3">
                    @if ($order->status === 'pending')
                        <form action="{{ route('admin.orders.invoice', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Invoice Order
                        </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Customer Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Customer Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Name</p>
                                <p class="text-base font-medium text-gray-900">{{ $order->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="text-base font-medium text-gray-900">{{ $order->email }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500">Shipping Address</p>
                                <p class="text-base font-medium text-gray-900">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h3>
                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'invoiced' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Stripe Details</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Session ID</p>
                                <p class="text-sm font-mono text-gray-600 break-all">{{ $order->stripe_session_id ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
