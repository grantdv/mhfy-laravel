<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brand-light leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-brand-bg-light overflow-hidden shadow-sm sm:rounded-lg border border-brand-light">
                <div class="p-8">
                    <h1 class="text-3xl font-bold text-brand-dark mb-2">Concierge Portal</h1>
                    <p class="text-gray-600 mb-8">Welcome back. Use the controls below to manage the May Harmony Find You inventory and customer inquiries.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Products Card -->
                        <div class="p-6 bg-brand-bg-medium rounded-xl border border-brand-light hover:bg-brand-bg-light transition-colors cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-brand-medium text-white p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4a1.5 1.5 0 00-1.5 0l-8 4m16 0l-8 4a1.5 1.5 0 01-1.5 0l-8-4m16 0l-8 4a1.5 1.5 0 01-1.5 0l-8-4m16 0l-8 4a1.5 1.5 0 01-1.5 0l-8-4"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-brand-dark">Product Catalog</h3>
                                    <p class="text-sm text-gray-600">Manage inventory, pricing, and stock levels.</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.products.index') }}" class="mt-4 block text-brand-medium font-bold hover:underline">Manage Products &rarr;</a>
                        </div>

                        <!-- Orders Card -->
                        <div class="p-6 bg-brand-bg-medium rounded-xl border border-brand-light hover:bg-brand-bg-light transition-colors cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-brand-medium text-white p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 12l2 2 4-4"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-brand-dark">Order Requests</h3>
                                    <p class="text-sm text-gray-600">Review inquiries and process invoices.</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="mt-4 block text-brand-medium font-bold hover:underline">Manage Orders &rarr;</a>
                        </div>

                        <!-- Placeholder Card -->
                        <div class="p-6 bg-brand-bg-medium rounded-xl border border-brand-light">
                            <div class="flex items-center">
                                <div class="bg-brand-orange text-white p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-brand-dark">Coming Soon</h3>
                                    <p class="text-sm text-gray-600">More admin features coming shortly.</p>
                                </div>
                            </div>
                            <div class="mt-4 text-brand-orange text-sm italic">Stay tuned for more tools.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
