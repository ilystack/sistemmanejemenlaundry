<div class="p-6" x-data="orderFormData()" x-init="init()">

    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <template x-for="i in 5" :key="i">
                <div class="flex items-center flex-1">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold transition-all"
                        :class="step >= i ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-500'">
                        <span x-text="i"></span>
                    </div>
                    <div x-show="i < 5" class="flex-1 h-1 mx-2"
                        :class="step > i ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-700'"></div>
                </div>
            </template>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center" x-text="stepTitle"></p>
    </div>

    <form @submit.prevent="submitOrder()">

        {{-- STEP 1: Pilih Tipe Paket (KG vs PCS) --}}
        <div x-show="step === 1" x-transition class="space-y-4">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Pilih Tipe Paket</h3>
            <div class="grid grid-cols-2 gap-4">
                <button type="button" @click="selectTipePaket('kg')"
                    class="p-6 border-2 rounded-xl transition-all hover:shadow-lg"
                    :class="tipePaket === 'kg' ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-blue-300'">
                    <div class="text-4xl mb-2">⚖️</div>
                    <h4 class="font-bold text-gray-900 dark:text-white">Kilogram (KG)</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Cuci per kilogram</p>
                </button>
                <button type="button" @click="selectTipePaket('pcs')"
                    class="p-6 border-2 rounded-xl transition-all hover:shadow-lg"
                    :class="tipePaket === 'pcs' ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-blue-300'">
                    <div class="text-4xl mb-2">🧺</div>
                    <h4 class="font-bold text-gray-900 dark:text-white">Pieces (PCS)</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Cuci per item</p>
                </button>
            </div>
        </div>

        {{-- STEP 2: Pilih Paket Spesifik --}}
        <div x-show="step === 2" x-transition class="space-y-4">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                Pilih Paket <span x-text="tipePaket === 'kg' ? 'Kilogram' : 'Satuan (PCS)'"></span>
            </h3>

            {{-- Filter Jenis Layanan (Khusus PCS) --}}
            <div x-show="tipePaket === 'pcs'" class="space-y-4 mb-6">
                <p class="text-sm text-gray-600 dark:text-gray-400">Pilih jenis layanan terlebih dahulu:</p>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" @click="selectJenisLayanan('cuci_saja')"
                        class="p-3 text-sm border rounded-lg transition-all text-center hover:bg-gray-50 dark:hover:bg-gray-700"
                        :class="jenisLayanan === 'cuci_saja' ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20 text-blue-700 font-bold' : 'border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300'">
                        🧴 Cuci Saja
                    </button>
                    <button type="button" @click="selectJenisLayanan('cuci_setrika')"
                        class="p-3 text-sm border rounded-lg transition-all text-center hover:bg-gray-50 dark:hover:bg-gray-700"
                        :class="jenisLayanan === 'cuci_setrika' ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20 text-blue-700 font-bold' : 'border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300'">
                        👕 Cuci + Setrika
                    </button>
                    <button type="button" @click="selectJenisLayanan('kilat')"
                        class="p-3 text-sm border rounded-lg transition-all text-center hover:bg-gray-50 dark:hover:bg-gray-700"
                        :class="jenisLayanan === 'kilat' ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20 text-blue-700 font-bold' : 'border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300'">
                        ⚡ Kilat
                    </button>
                </div>
            </div>

            {{-- List Paket untuk KG (Single Select) --}}
            <div x-show="tipePaket === 'kg' && filteredPakets.length > 0"
                class="space-y-3 max-h-80 overflow-y-auto custom-scrollbar p-1">
                <template x-for="paket in filteredPakets" :key="paket.id">
                    <button type="button" @click="selectPaket(paket)"
                        class="w-full p-4 border-2 rounded-lg transition-all hover:shadow-md text-left"
                        :class="paketId === paket.id ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-blue-300'">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white" x-text="paket.nama"></h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span
                                        class="text-xs px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300"
                                        x-text="formatJenisLayanan(paket.jenis_layanan)"></span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-blue-600 dark:text-blue-400"
                                    x-text="'Rp ' + paket.harga.toLocaleString('id-ID')"></p>
                                <p class="text-xs text-gray-500" x-text="'per ' + paket.satuan"></p>
                            </div>
                        </div>
                    </button>
                </template>
            </div>

            {{-- Shopping Cart untuk PCS (Multiple Select dengan +/-) --}}
            <div x-show="tipePaket === 'pcs' && filteredPakets.length > 0"
                class="space-y-3 max-h-80 overflow-y-auto custom-scrollbar p-1">
                <template x-for="paket in filteredPakets" :key="paket.id">
                    <div class="w-full p-4 border-2 rounded-lg transition-all"
                        :class="getCartQuantity(paket.id) > 0 ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700'">
                        <div class="flex justify-between items-center">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 dark:text-white" x-text="paket.nama"></h4>
                                <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold mt-1"
                                    x-text="'Rp ' + paket.harga.toLocaleString('id-ID') + '/pcs'"></p>
                            </div>
                            <div class="flex items-center gap-3">
                                <button type="button" @click="decrementCart(paket.id)"
                                    :disabled="getCartQuantity(paket.id) === 0"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 disabled:bg-gray-300 dark:disabled:bg-gray-600 text-white font-bold transition">
                                    −
                                </button>
                                <span class="w-12 text-center font-bold text-lg text-gray-900 dark:text-white"
                                    x-text="getCartQuantity(paket.id)"></span>
                                <button type="button" @click="incrementCart(paket.id, paket)"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-green-500 hover:bg-green-600 text-white font-bold transition">
                                    +
                                </button>
                            </div>
                        </div>
                        <div x-show="getCartQuantity(paket.id) > 0" x-transition
                            class="mt-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Subtotal: <span class="font-bold text-blue-600 dark:text-blue-400"
                                    x-text="'Rp ' + (getCartQuantity(paket.id) * paket.harga).toLocaleString('id-ID')"></span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Empty State jika belum pilih layanan (PCS) atau tidak ada paket --}}
            <div x-show="tipePaket === 'pcs' && !jenisLayanan" class="text-center py-8 text-gray-500">
                <p>Silakan pilih jenis layanan di atas ☝️</p>
            </div>
            <div x-show="(tipePaket === 'kg' || jenisLayanan) && filteredPakets.length === 0"
                class="text-center py-8 text-gray-500">
                <p>Tidak ada paket tersedia untuk kategori ini.</p>
            </div>

            {{-- Input Jumlah untuk KG --}}
            <div x-show="tipePaket === 'kg' && paketId" x-transition
                class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Jumlah (<span x-text="selectedPaket?.satuan || 'kg'"></span>)
                </label>
                <div class="flex items-center gap-4">
                    <input type="number" x-model="jumlah" step="0.1" min="0.1" required
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 text-lg"
                        placeholder="0">
                    <div class="text-right min-w-[120px]">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Estimasi Total</p>
                        <p class="font-bold text-lg text-blue-600 dark:text-blue-400"
                            x-text="'Rp ' + ((jumlah || 0) * (selectedPaket?.harga || 0)).toLocaleString('id-ID')"></p>
                    </div>
                </div>
            </div>

            {{-- Cart Summary untuk PCS --}}
            <div x-show="tipePaket === 'pcs' && cartTotal > 0" x-transition
                class="mt-4 pt-4 border-t-2 border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-700 dark:text-gray-300">🛒 Total Item:</span>
                    <span class="font-bold text-gray-900 dark:text-white" x-text="cartItemCount + ' item'"></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Total Harga:</span>
                    <span class="font-bold text-xl text-blue-600 dark:text-blue-400"
                        x-text="'Rp ' + cartTotal.toLocaleString('id-ID')"></span>
                </div>
            </div>
        </div>

        {{-- STEP 3: Metode Pengantaran --}}
        <div x-show="step === 3" x-transition class="space-y-4">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Metode Pengantaran</h3>
            <div class="grid grid-cols-2 gap-4">
                <button type="button" @click="selectMetodePengantaran('antar_sendiri')"
                    class="p-6 border-2 rounded-xl transition-all hover:shadow-lg"
                    :class="metodePengantaran === 'antar_sendiri' ? 'border-green-600 bg-green-50 dark:bg-green-900/20' : 'border-gray-200 dark:border-gray-700'">
                    <div class="text-4xl mb-2">🚶</div>
                    <h4 class="font-bold text-gray-900 dark:text-white">Antar Sendiri</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Gratis</p>
                </button>
                <button type="button" @click="selectMetodePengantaran('dijemput')"
                    class="p-6 border-2 rounded-xl transition-all hover:shadow-lg"
                    :class="metodePengantaran === 'dijemput' ? 'border-green-600 bg-green-50 dark:bg-green-900/20' : 'border-gray-200 dark:border-gray-700'">
                    <div class="text-4xl mb-2">🚗</div>
                    <h4 class="font-bold text-gray-900 dark:text-white">Dijemput</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Rp 1.000/km</p>
                </button>
            </div>

            {{-- GPS Location (jika dijemput) --}}
            <div x-show="metodePengantaran === 'dijemput'" x-transition
                class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h5 class="font-semibold text-gray-900 dark:text-white">Deteksi Lokasi</h5>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Untuk menghitung biaya penjemputan</p>
                    </div>
                    <button type="button" @click="getLocation()" :disabled="gettingLocation"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white text-sm font-semibold rounded-lg transition">
                        <span x-show="!gettingLocation">📍 Ambil Lokasi</span>
                        <span x-show="gettingLocation">⏳ Mengambil...</span>
                    </button>
                </div>
                <div x-show="jarak > 0" x-transition class="text-sm">
                    <p class="text-gray-700 dark:text-gray-300">Jarak: <span class="font-bold"
                            x-text="jarak + ' km'"></span></p>
                    <p class="text-gray-700 dark:text-gray-300">Ongkir: <span
                            class="font-bold text-blue-600 dark:text-blue-400"
                            x-text="'Rp ' + ongkir.toLocaleString('id-ID')"></span></p>
                </div>
            </div>
        </div>

        {{-- STEP 4: Metode Pembayaran --}}
        <div x-show="step === 4" x-transition class="space-y-4">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Metode Pembayaran</h3>
            <div class="grid grid-cols-2 gap-4">
                <button type="button" @click="metodePembayaran = 'cash'"
                    class="p-6 border-2 rounded-xl transition-all hover:shadow-lg"
                    :class="metodePembayaran === 'cash' ? 'border-purple-600 bg-purple-50 dark:bg-purple-900/20' : 'border-gray-200 dark:border-gray-700'">
                    <div class="text-4xl mb-2">💵</div>
                    <h4 class="font-bold text-gray-900 dark:text-white">Cash</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Bayar di tempat</p>
                </button>
                <button type="button" @click="metodePembayaran = 'qris'"
                    class="p-6 border-2 rounded-xl transition-all hover:shadow-lg"
                    :class="metodePembayaran === 'qris' ? 'border-purple-600 bg-purple-50 dark:bg-purple-900/20' : 'border-gray-200 dark:border-gray-700'">
                    <div class="text-4xl mb-2">📱</div>
                    <h4 class="font-bold text-gray-900 dark:text-white">QRIS</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Scan QR Code</p>
                </button>
            </div>

            <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <h5 class="font-semibold text-gray-900 dark:text-white mb-3">Ringkasan Order</h5>
                <div class="space-y-2 text-sm">
                    <template x-if="tipePaket === 'kg'">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Paket:</span>
                                <span class="font-medium text-gray-900 dark:text-white"
                                    x-text="selectedPaket?.nama"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Layanan:</span>
                                <span class="font-medium text-gray-900 dark:text-white"
                                    x-text="formatJenisLayanan(selectedPaket?.jenis_layanan)"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Jumlah:</span>
                                <span class="font-medium text-gray-900 dark:text-white"
                                    x-text="jumlah + ' ' + selectedPaket?.satuan"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                                <span class="font-medium text-gray-900 dark:text-white"
                                    x-text="'Rp ' + (jumlah * (selectedPaket?.harga || 0)).toLocaleString('id-ID')"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="tipePaket === 'pcs'">
                        <div class="space-y-3">
                            <div
                                class="flex justify-between items-center pb-2 border-b border-gray-300 dark:border-gray-600">
                                <span class="font-semibold text-gray-700 dark:text-gray-300">Item yang Dipilih:</span>
                                <span class="text-xs text-gray-500" x-text="cart.length + ' jenis'"></span>
                            </div>
                            <template x-for="item in cart" :key="item.paket_id">
                                <div class="flex justify-between items-start py-1">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900 dark:text-white" x-text="item.paket.nama">
                                        </p>
                                        <p class="text-xs text-gray-500"
                                            x-text="item.quantity + ' pcs × Rp ' + item.paket.harga.toLocaleString('id-ID')">
                                        </p>
                                    </div>
                                    <span class="font-semibold text-blue-600 dark:text-blue-400"
                                        x-text="'Rp ' + (item.quantity * item.paket.harga).toLocaleString('id-ID')"></span>
                                </div>
                            </template>
                            <div class="flex justify-between pt-2 border-t border-gray-300 dark:border-gray-600">
                                <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                                <span class="font-medium text-gray-900 dark:text-white"
                                    x-text="'Rp ' + cartTotal.toLocaleString('id-ID')"></span>
                            </div>
                        </div>
                    </template>

                    <div x-show="metodePengantaran === 'dijemput'" class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Ongkir (<span x-text="jarak"></span> km):</span>
                        <span class="font-medium text-gray-900 dark:text-white"
                            x-text="'Rp ' + ongkir.toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-gray-300 dark:border-gray-600">
                        <span class="font-bold text-gray-900 dark:text-white">Total:</span>
                        <span class="font-bold text-blue-600 dark:text-blue-400 text-lg"
                            x-text="'Rp ' + totalHarga.toLocaleString('id-ID')"></span>
                    </div>
                    <div x-show="metodePembayaran === 'cash' && metodePengantaran === 'dijemput'"
                        class="text-xs text-amber-600 dark:text-amber-400 pt-2">
                        ⚠️ Bayar ongkir dulu (DP): <span class="font-bold"
                            x-text="'Rp ' + ongkir.toLocaleString('id-ID')"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 5: QR Code (jika perlu bayar) --}}
        <div x-show="step === 5" x-transition class="space-y-4">
            <div class="text-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Scan QR Code untuk Pembayaran</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4" x-text="qrMessage"></p>

                <div class="bg-white p-6 rounded-xl inline-block shadow-lg" x-show="qrCodeUrl">
                    <img :src="qrCodeUrl" alt="QR Code" class="w-64 h-64 mx-auto">
                </div>

                <div
                    class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                    <p class="text-sm text-amber-800 dark:text-amber-300">
                        ⏰ QR Code berlaku selama <span class="font-bold">10 menit</span>
                    </p>
                    <p class="text-xs text-amber-600 dark:text-amber-400 mt-1">
                        Scan QR Code di atas, atau klik link di bawah ini jika menggunakan device yang sama.
                    </p>

                    {{-- Tombol Link Direct untuk HP --}}
                    <a :href="paymentUrl" target="_blank"
                        class="mt-3 block w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold text-sm transition">
                        🔗 Bayar Sekarang
                    </a>
                </div>
            </div>
        </div>

        {{-- Navigation Buttons --}}
        <div class="flex justify-between gap-3 mt-6 pt-4 border-t border-gray-200 dark:border-gray-600">
            <button type="button" @click="prevStep()" x-show="step > 1 && step < 5"
                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                ← Kembali
            </button>
            <div class="flex-1"></div>
            <button type="button" @click="nextStep()" x-show="step < 4" :disabled="!canProceed()"
                class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 rounded-lg transition shadow-md hover:shadow-lg">
                Lanjut →
            </button>
            <button type="button" @click="submitOrder()" x-show="step === 4 && !needsPayment()" :disabled="isSubmitting"
                class="px-6 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 disabled:bg-gray-400 rounded-lg transition shadow-md hover:shadow-lg">
                <span x-show="!isSubmitting">✓ Buat Order</span>
                <span x-show="isSubmitting">⏳ Memproses...</span>
            </button>
            <button type="button" @click="submitOrder()" x-show="step === 4 && needsPayment()" :disabled="isSubmitting"
                class="px-6 py-2 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 disabled:bg-gray-400 rounded-lg transition shadow-md hover:shadow-lg">
                <span x-show="!isSubmitting">💳 Lanjut Bayar</span>
                <span x-show="isSubmitting">⏳ Memproses...</span>
            </button>
        </div>
    </form>
</div>

<script>
    function orderFormData() {
        return {
            step: 1,
            tipePaket: null,
            jenisLayanan: null,
            paketId: null,
            selectedPaket: null,
            jumlah: null,
            metodePengantaran: 'antar_sendiri',
            metodePembayaran: 'cash',
            latitude: null,
            longitude: null,
            jarak: 0,
            ongkir: 0,
            gettingLocation: false,
            isSubmitting: false,
            pakets: [],
            qrCodeUrl: null,
            paymentUrl: null,
            cart: [],

            init() {
                this.fetchPakets();
            },

            async fetchPakets() {
                try {
                    const response = await fetch('/api/pakets');
                    this.pakets = await response.json();
                } catch (error) {
                    console.error('Error fetching pakets:', error);
                }
            },

            get filteredPakets() {
                if (this.tipePaket === 'kg') {
                    return this.pakets.filter(p => p.satuan === 'kg');
                } else if (this.tipePaket === 'pcs') {
                    if (!this.jenisLayanan) return [];
                    return this.pakets.filter(p => p.satuan === 'pcs' && p.jenis_layanan === this.jenisLayanan);
                }
                return [];
            },

            get cartTotal() {
                return this.cart.reduce((total, item) => total + (item.quantity * item.paket.harga), 0);
            },

            get cartItemCount() {
                return this.cart.reduce((count, item) => count + item.quantity, 0);
            },

            getCartQuantity(paketId) {
                const item = this.cart.find(i => i.paket_id === paketId);
                return item ? item.quantity : 0;
            },

            incrementCart(paketId, paket) {
                const existingItem = this.cart.find(i => i.paket_id === paketId);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    this.cart.push({ paket_id: paketId, paket: paket, quantity: 1 });
                }
            },

            decrementCart(paketId) {
                const existingItem = this.cart.find(i => i.paket_id === paketId);
                if (existingItem) {
                    existingItem.quantity--;
                    if (existingItem.quantity === 0) {
                        this.cart = this.cart.filter(i => i.paket_id !== paketId);
                    }
                }
            },

            get stepTitle() {
                const titles = {
                    1: 'Pilih Tipe Paket',
                    2: 'Pilih Paket & Jumlah',
                    3: 'Metode Pengantaran',
                    4: 'Metode Pembayaran',
                    5: 'Scan QR Code'
                };
                return titles[this.step] || '';
            },

            get totalHarga() {
                if (this.tipePaket === 'pcs') {
                    return this.cartTotal + this.ongkir;
                } else {
                    const subtotal = this.jumlah * (this.selectedPaket?.harga || 0);
                    return subtotal + this.ongkir;
                }
            },

            get qrMessage() {
                if (this.metodePembayaran === 'qris') {
                    return `Total Pembayaran: Rp ${this.totalHarga.toLocaleString('id-ID')}`;
                } else if (this.metodePembayaran === 'cash' && this.metodePengantaran === 'dijemput') {
                    return `Bayar DP Ongkir: Rp ${this.ongkir.toLocaleString('id-ID')}`;
                }
                return '';
            },

            formatJenisLayanan(raw) {
                const map = {
                    'cuci_saja': 'Cuci Saja',
                    'cuci_setrika': 'Cuci + Setrika',
                    'kilat': 'Kilat'
                };
                return map[raw] || raw;
            },

            selectTipePaket(tipe) {
                this.tipePaket = tipe;
                this.paketId = null;
                this.selectedPaket = null;
                this.jenisLayanan = null;
                this.nextStep();
            },

            selectJenisLayanan(layanan) {
                this.jenisLayanan = layanan;
                this.paketId = null;
                this.selectedPaket = null;
                this.cart = [];
            },

            selectPaket(paket) {
                this.paketId = paket.id;
                this.selectedPaket = paket;
            },

            selectMetodePengantaran(metode) {
                this.metodePengantaran = metode;
                if (metode === 'antar_sendiri') {
                    this.jarak = 0;
                    this.ongkir = 0;
                    this.latitude = null;
                    this.longitude = null;
                }
            },

            async getLocation() {
                if (!navigator.geolocation) {
                    alert('Browser Anda tidak mendukung Geolocation');
                    return;
                }

                this.gettingLocation = true;

                try {
                    const position = await new Promise((resolve, reject) => {
                        navigator.geolocation.getCurrentPosition(resolve, reject);
                    });

                    this.latitude = position.coords.latitude;
                    this.longitude = position.coords.longitude;

                    // Hitung jarak ke laundry
                    const response = await fetch('/api/calculate-distance', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            latitude: this.latitude,
                            longitude: this.longitude
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.jarak = data.distance;
                        this.ongkir = data.fee;
                    } else {
                        alert(data.message || 'Gagal menghitung jarak');
                    }
                } catch (error) {
                    alert('Gagal mendapatkan lokasi: ' + error.message);
                } finally {
                    this.gettingLocation = false;
                }
            },

            canProceed() {
                if (this.step === 1) return this.tipePaket !== null;
                if (this.step === 2) {
                    if (this.tipePaket === 'pcs') {
                        return this.cart.length > 0;
                    } else {
                        return this.paketId !== null && this.jumlah > 0;
                    }
                }
                if (this.step === 3) {
                    if (this.metodePengantaran === 'dijemput') {
                        return this.jarak > 0;
                    }
                    return true;
                }
                return true;
            },

            needsPayment() {
                return this.metodePembayaran === 'qris' ||
                    (this.metodePembayaran === 'cash' && this.metodePengantaran === 'dijemput');
            },

            nextStep() {
                if (this.canProceed()) {
                    this.step++;
                }
            },

            prevStep() {
                this.step--;
            },

            async submitOrder() {
                if (this.isSubmitting) return;

                this.isSubmitting = true;

                try {
                    let formData;

                    if (this.tipePaket === 'pcs') {
                        formData = {
                            tipe_paket: this.tipePaket,
                            items: this.cart.map(item => ({
                                paket_id: item.paket_id,
                                quantity: item.quantity,
                                harga_satuan: item.paket.harga
                            })),
                            pickup: this.metodePengantaran,
                            metode_pembayaran: this.metodePembayaran,
                            customer_latitude: this.latitude,
                            customer_longitude: this.longitude,
                            jarak_km: this.jarak,
                            ongkir: this.ongkir,
                            total_harga: this.cartTotal + this.ongkir
                        };
                    } else {
                        formData = {
                            tipe_paket: this.tipePaket,
                            paket_id: this.paketId,
                            jumlah: this.jumlah,
                            pickup: this.metodePengantaran,
                            metode_pembayaran: this.metodePembayaran,
                            customer_latitude: this.latitude,
                            customer_longitude: this.longitude,
                            jarak_km: this.jarak,
                            ongkir: this.ongkir,
                            total_harga: (this.jumlah * (this.selectedPaket?.harga || 0)) + this.ongkir
                        };
                    }

                    const response = await fetch('/order', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (data.success) {
                        if (this.needsPayment()) {
                            this.qrCodeUrl = data.qr_code_url;
                            this.paymentUrl = data.payment_url;

                            this.step = 5;
                        } else {
                            if (typeof window.showToast === 'function') {
                                window.showToast('Order berhasil dibuat!', 'success');
                            }
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    } else {
                        alert(data.message || 'Gagal membuat order');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan: ' + error.message);
                } finally {
                    this.isSubmitting = false;
                }
            }
        }
    }
</script>