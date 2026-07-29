<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Concierge Portal</h1>
                    <p class="text-gray-600 mb-8">Welcome back. Use the controls below to manage the May Harmony Find You inventory and customer inquiries.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Products Card -->
                        <div class="p-6 bg-indigo-50 rounded-xl border border-indigo-100 hover:bg-indigo-100 transition-colors cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-indigo-600 text-white p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4a1.5 1.5 0 00-1.5 0l-8 4m16 0l-8 4a1.5 1.5 0 01-1.5 0l-8-4m16 0l-8 4a1.5 1.5 0 01-1.5 0l-8-4m16 0l-8 4a1.5 1.5 0 01-1.5 0l-8-4"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-indigo-900">Product Catalog</h3>
                                    <p class="text-sm text-indigo-700">Manage inventory, pricing, and stock levels.</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.products.index') }}" class="mt-4 block text-indigo-600 font-bold hover:underline">Manage Products &rarr;</a>
                        </div>

                        <!-- Orders Card -->
                        <div class="p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-green-600 text-white p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 12l2 2 4-4"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-green-900">Order Requests</h3>
                                    <p class="text-sm text-green-700">Review inquiries and process invoices.</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="mt-4 block text-green-600 font-bold hover:underline">Manage Orders &rarr;</a>
                        </div>

                        <!-- Placeholder Card -->
                        <div class="p-6 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="flex items-center">
                                <div class="bg-gray-400 text-white p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Coming Soon</h3>
                                    <p class="text-sm text-gray-600">More admin features coming shortly.</p>
                                </div>
                            </div>
                            <div class="mt-4 text-gray-400 text-sm italic">Stay tuned for more tools.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
