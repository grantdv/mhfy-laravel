<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Welcome back, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-600 mb-8">Here's a quick look at your account status and recent activity.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-gray-800">Quick Actions</h4>
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('profile.show') }}" class="flex items-center p-4 bg-indigo-50 rounded-lg border border-indigo-100 hover:bg-indigo-100 transition-colors">
                                    <div class="bg-indigo-600 text-white p-2 rounded-md mr-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h8a7 7 0 007-7z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-indigo-900">Manage Profile</p>
                                        <p class="text-sm text-indigo-700">Update your name, phone, and shipping address.</p>
                                    </div>
                                </a>

                                <a href="{{ route('orders.history') }}" class="flex items-center p-4 bg-green-50 rounded-lg border border-green-100 hover:bg-green-100 transition-colors">
                                    <div class="bg-green-600 text-white p-2 rounded-md mr-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 12l2 2 4-4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-green-900">Order History</p>
                                        <p class="text-sm text-green-700">Track your inquiries and recent purchases.</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Latest Order Status</h4>
                            @if($latestOrder = auth()->user()->orders()->latest()->first())
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Order ID:</span>
                                        <span class="font-bold">#{{ $latestOrder->id }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Type:</span>
                                        <span class="font-medium">{{ $latestOrder->type === 'product' ? 'Product Order' : 'General Inquiry' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $latestOrder->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($latestOrder->status) }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('orders.history') }}" class="mt-6 inline-block text-indigo-600 font-bold hover:underline">View full history &rarr;</a>
                            @else
                                <p class="text-gray-500 text-center py-8">No orders found in your account yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
