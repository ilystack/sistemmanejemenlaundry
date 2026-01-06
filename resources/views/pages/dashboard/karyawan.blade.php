<x-sidetop role="karyawan" title="Dashboard Karyawan">

    <x-absensi-modal />
    <x-profile-completion-modal />

    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Orderan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                            {{ $stats['orderan_hari_ini'] }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z" />
                            <path
                                d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Orderan Selesai</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                            {{ $stats['orderan_selesai'] }}
                        </p>
                    </div>
                    <div
                        class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Absensi Bulan Ini</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                            {{ $stats['absensi_bulan_ini'] }} Hari
                        </p>
                    </div>
                    <div
                        class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z" />
                        <path
                            d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z" />
                    </svg>
                    Orderan Terbaru
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($orders as $order)
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white">
                                    #{{ $order->antrian }} - {{ $order->user->name }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $order->paket->nama }} ({{ $order->jumlah }} {{ $order->paket->satuan }})
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    {{ $order->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                        @if($order->status === 'menunggu') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400
                                                        @elseif($order->status === 'diproses') bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400
                                                        @elseif($order->status === 'selesai') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400
                                                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400
                                                        @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p>Belum ada orderan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Order Modal --}}
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 backdrop-blur-sm transition-opacity"
            @click="showModal = false"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="showModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-gray-200 dark:border-gray-700">

                <div
                    class="px-6 py-4 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-gray-700 dark:to-gray-700 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white" id="modal-title">
                        Buat Order Baru
                    </h3>
                    <button @click="showModal = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @include('pages.order.form-modal')
            </div>
        </div>
    </div>

</x-sidetop>