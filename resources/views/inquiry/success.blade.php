<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | May Harmony Find You</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">May Harmony Find You</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium">Products</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-indigo-600 font-medium">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-12 rounded-xl shadow-lg border border-gray-100 text-center">
            <div class="mb-6">
                <div class="bg-green-100 text-green-600 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4-4m0 0l4 4m-4-4v12"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-3xl font-bold mb-2 text-gray-900">Order Confirmed</h1>
            <p class="text-gray-600 mb-8">Thank you for your order! Your inquiry has been received and our team will contact you shortly to confirm the next steps.</p>
            <p class="text-sm text-gray-400 mb-8">Order ID: #{{ $order_id }}</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-indigo-700 transition-colors">
                Continue Browsing
            </a>
        </div>
    </div>
</body>
</html>
