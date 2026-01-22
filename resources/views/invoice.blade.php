<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Velora Accessories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f9fafb; }
        .print-area { background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 20px 20px; }
    </style>
</head>
<body x-data="invoiceApp()">

    <main class="max-w-4xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8 no-print">
            <a href="/" class="flex items-center text-sm font-bold text-gray-500 hover:text-amber-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </a>
            <button onclick="window.print()" class="bg-white border border-gray-200 px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50">
                Cetak Invoice
            </button>
        </div>

        <div class="bg-white rounded-[40px] shadow-2xl shadow-gray-200/50 border border-gray-100 overflow-hidden relative">
            
            <div class="bg-gray-900 p-10 text-white flex flex-col md:flex-row justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-black tracking-tighter italic text-amber-500 mb-2">VELORA</h1>
                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-gray-400">Official Invoice</p>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Nomor Pesanan</p>
                    <p class="text-2xl font-black text-amber-500" x-text="order.orderId"></p>
                    <p class="text-xs mt-1 text-gray-400" x-text="order.date"></p>
                </div>
            </div>

            <div class="p-10">
                <div class="bg-amber-50 border border-amber-100 rounded-3xl p-6 mb-10 flex items-center gap-5">
                    <div class="bg-amber-500 p-3 rounded-2xl animate-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-amber-900 text-sm uppercase tracking-widest">Menunggu Pembayaran</h4>
                        <p class="text-amber-700 text-sm">Silakan lakukan transfer sesuai metode yang dipilih di bawah ini.</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-12 mb-12">
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Tujuan Pengiriman</h3>
                        <p class="font-black text-lg text-gray-900" x-text="order.customer.name"></p>
                        <p class="text-gray-500 text-sm mt-1" x-text="order.customer.phone"></p>
                        <p class="text-gray-500 text-sm mt-2 leading-relaxed" x-text="order.customer.address + ', ' + order.customer.city"></p>
                    </div>

                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Metode Pembayaran</h3>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-4 py-1.5 bg-gray-900 text-white rounded-lg text-xs font-bold" x-text="order.customer.payment"></span>
                        </div>
                        
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <template x-if="order.customer.payment === 'transfer'">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bank BCA</p>
                                    <p class="text-lg font-black text-gray-900 tracking-wider">1234 5678 90</p>
                                    <p class="text-xs text-gray-500">a/n Velora Accessories Official</p>
                                </div>
                            </template>
                            <template x-if="order.customer.payment === 'ewallet'">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Dana / OVO</p>
                                    <p class="text-lg font-black text-gray-900 tracking-wider">0812 3456 7890</p>
                                    <p class="text-xs text-gray-500">a/n Velora Accessories Official</p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Rincian Produk</h3>
                    <div class="border border-gray-100 rounded-[32px] overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Item</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase text-center">Qty</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase text-right">Harga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <template x-for="item in order.items" :key="item.id">
                                    <tr>
                                        <td class="px-6 py-4">
                                            <p class="font-bold text-gray-900 text-sm" x-text="item.name"></p>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter" x-text="item.variant_info"></p>
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm font-bold text-gray-600" x-text="item.quantity"></td>
                                        <td class="px-6 py-4 text-right text-sm font-black text-gray-900" x-text="'Rp' + (item.price * item.quantity).toLocaleString('id-ID')"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex flex-col items-end gap-2 border-t border-gray-100 pt-8">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Total Pembayaran</p>
                    <p class="text-5xl font-black text-amber-600 tracking-tighter" x-text="'Rp' + order.grandTotal.toLocaleString('id-ID')"></p>
                </div>
            </div>

            <div class="p-10 bg-gray-50 border-t border-gray-100 flex flex-col items-center text-center">
                <p class="text-xs text-gray-400 font-medium max-w-sm leading-relaxed mb-6">
                    Silakan simpan invoice ini sebagai bukti pemesanan Anda. Admin kami akan memproses pesanan setelah verifikasi pembayaran dilakukan.
                </p>
                <button @click="finishOrder()" class="bg-gray-900 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-amber-600 transition-all shadow-xl">
                    Selesai & Bersihkan Keranjang
                </button>
            </div>
        </div>
    </main>

    <script>
        function invoiceApp() {
            return {
                order: {
                    customer: {},
                    items: [],
                    grandTotal: 0,
                    orderId: '',
                    date: ''
                },

                init() {
                    // Ambil data dari localStorage yang disimpan di halaman checkout
                    const savedOrder = JSON.parse(localStorage.getItem('velora_last_order'));
                    
                    if (!savedOrder) {
                        alert('Data pesanan tidak ditemukan!');
                        window.location.href = '/';
                        return;
                    }

                    this.order = savedOrder;
                },

                finishOrder() {
                    // Bersihkan keranjang karena pesanan sudah "masuk"
                    localStorage.removeItem('velora_cart');
                    localStorage.removeItem('velora_last_order');
                    
                    alert('Terima kasih! Pesanan Anda telah tercatat dalam sistem kami.');
                    window.location.href = '/';
                }
            }
        }
    </script>

    <style>
        @media print {
            .no-print { display: none; }
            body { background-color: white; }
            .bg-gray-900 { background-color: #111827 !important; -webkit-print-color-adjust: exact; }
            .text-amber-500 { color: #f59e0b !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</body>
</html>