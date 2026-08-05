<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} | MHFY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-brand-bg-light">
    <div class="min-h-screen flex flex-col">
        <header class="bg-brand-dark text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-brand-light">MHFY Admin</h1>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-brand-light hover:text-brand-medium">Back to Orders</a>
                </div>
            </div>
        </header>

        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-brand-dark">Order #{{ $order->id }}</h2>
                <div class="flex space-x-3">
                    @if ($order->status === 'pending')
                        <form action="{{ route('admin.orders.invoice', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-medium hover:bg-brand-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-medium">
                            Invoice Order
                        </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Customer Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6 border border-brand-light">
                        <h3 class="text-lg font-bold text-brand-dark mb-4">Customer Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Name</p>
                                <p class="text-base font-medium text-brand-dark">{{ $order->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="text-base font-medium text-brand-dark">{{ $order->email }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500">Shipping Address</p>
                                <p class="text-base font-medium text-brand-dark">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-md rounded-lg p-6 border border-brand-light">
                        <h3 class="text-lg font-bold text-brand-dark mb-4">Order Summary</h3>
                        <div class="flex justify-between items-center pb-4 border-b border-brand-light">
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $order->status === 'pending' ? 'bg-brand-bg-medium text-brand-orange' : '' }}
                                    {{ $order->status === 'invoiced' ? 'bg-brand-medium text-white' : '' }}
                                    {{ $order->status === 'paid' ? 'bg-green-600 text-white' : '' }}
                                ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6 border border-brand-light">
                        <h3 class="text-lg font-bold text-brand-dark mb-4">Stripe Details</h3>
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
