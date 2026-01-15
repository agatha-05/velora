<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Velora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900" x-data="checkoutApp()">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/cart" class="flex items-center text-sm font-bold text-gray-500 hover:text-amber-600 transition group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <h1 class="text-xl font-black italic tracking-tighter text-amber-600">VELORA</h1>
            <div class="w-20"></div> </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-10">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="lg:w-2/3 space-y-10">
                
                <section>
                    <div class="flex items-center gap-4 mb-6">
                        <span class="bg-amber-600 text-white w-8 h-8 rounded-xl flex items-center justify-center font-bold">1</span>
                        <h2 class="text-2xl font-black tracking-tight">Informasi Pengiriman</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 block">Nama Penerima</label>
                            <input type="text" x-model="form.name" placeholder="Nama lengkap Anda" class="w-full p-4 rounded-2xl border border-gray-100 bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 block">Nomor WhatsApp</label>
                            <input type="tel" x-model="form.phone" placeholder="0812xxxx" class="w-full p-4 rounded-2xl border border-gray-100 bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 block">Kota / Kecamatan</label>
                            <input type="text" x-model="form.city" placeholder="Contoh: Jakarta Selatan" class="w-full p-4 rounded-2xl border border-gray-100 bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 block">Alamat Lengkap</label>
                            <textarea x-model="form.address" rows="3" placeholder="Nama jalan, Nomor rumah, RT/RW..." class="w-full p-4 rounded-2xl border border-gray-100 bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all"></textarea>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-4 mb-6">
                        <span class="bg-amber-600 text-white w-8 h-8 rounded-xl flex items-center justify-center font-bold">2</span>
                        <h2 class="text-2xl font-black tracking-tight">Metode Pembayaran</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative flex items-center p-5 border-2 rounded-[24px] cursor-pointer transition-all duration-300"
                               :class="form.payment === 'transfer' ? 'border-amber-600 bg-amber-50/50 ring-4 ring-amber-50' : 'border-white bg-white hover:border-amber-200 shadow-sm'">
                            <input type="radio" name="payment" value="transfer" x-model="form.payment" class="hidden">
                            <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Transfer Bank</p>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">BCA / Mandiri / BNI</p>
                            </div>
                            <div x-show="form.payment === 'transfer'" class="ml-auto">
                                <div class="w-6 h-6 bg-amber-600 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                        </label>

                        <label class="relative flex items-center p-5 border-2 rounded-[24px] cursor-pointer transition-all duration-300"
                               :class="form.payment === 'ewallet' ? 'border-amber-600 bg-amber-50/50 ring-4 ring-amber-50' : 'border-white bg-white hover:border-amber-200 shadow-sm'">
                            <input type="radio" name="payment" value="ewallet" x-model="form.payment" class="hidden">
                            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">E-Wallet</p>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Dana / OVO / GoPay</p>
                            </div>
                            <div x-show="form.payment === 'ewallet'" class="ml-auto">
                                <div class="w-6 h-6 bg-amber-600 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                        </label>
                    </div>
                </section>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-[40px] p-8 border border-gray-100 shadow-xl shadow-gray-200/50 sticky top-28">
                    <h3 class="text-xl font-black mb-6 tracking-tight italic">Ringkasan Produk</h3>
                    
                    <div class="space-y-6 mb-8 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                        <template x-for="item in cartItems" :key="item.id">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-50 flex-shrink-0">
                                    <img :src="item.image" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-sm text-gray-900 truncate" x-text="item.name"></p>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest" x-text="item.variant_info"></p>
                                    <p class="text-xs font-black text-amber-600 mt-1" x-text="item.quantity + ' x Rp' + item.price.toLocaleString('id-ID')"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="space-y-4 border-t border-dashed border-gray-200 pt-6">
                        <div class="flex justify-between text-sm font-bold text-gray-400 uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-gray-900" x-text="'Rp' + total.toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between text-sm font-bold text-gray-400 uppercase tracking-widest">
                            <span>Ongkos Kirim</span>
                            <span class="text-amber-600 italic font-black text-[10px]">Gratis</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                            <span class="text-sm font-black uppercase tracking-widest text-gray-900">Total Akhir</span>
                            <span class="text-2xl font-black text-gray-900" x-text="'Rp' + total.toLocaleString('id-ID')"></span>
                        </div>
                    </div>

                    <button @click="confirmPurchase" 
                            class="w-full mt-8 bg-gray-900 text-white py-5 rounded-[24px] font-black tracking-[0.2em] uppercase hover:bg-amber-600 hover:shadow-2xl hover:shadow-amber-200 transition-all duration-300 disabled:opacity-30 disabled:pointer-events-none"
                            :disabled="!form.name || !form.phone || !form.address || !form.city">
                        Konfirmasi Pembelian
                    </button>
                    
                    <p class="text-[10px] text-center text-gray-400 font-bold uppercase tracking-widest mt-6">
                        🔒 Aman & Terenkripsi
                    </p>
                </div>
            </div>

        </div>
    </main>

    <script>
        function checkoutApp() {
            return {
                cartItems: [],
                total: 0,
                form: {
                    name: '',
                    phone: '',
                    city: '',
                    address: '',
                    payment: 'transfer'
                },

                init() {
                    // Ambil data dari keranjang (localStorage)
                    const cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
                    this.cartItems = cart;
                    
                    // Hitung total
                    this.calculateTotal();

                    // Jika keranjang kosong, arahkan kembali ke katalog
                    if (this.cartItems.length === 0) {
                        alert('Keranjang Anda kosong!');
                        window.location.href = '/';
                    }
                },

                calculateTotal() {
                    this.total = this.cartItems.reduce((acc, item) => acc + (item.price * item.quantity), 0);
                },

                confirmPurchase() {
                    // Simpan data checkout sementara untuk ditampilkan di Invoice/Konfirmasi Internal
                    const orderData = {
                        customer: this.form,
                        items: this.cartItems,
                        grandTotal: this.total,
                        orderId: 'VEL-' + Math.floor(Math.random() * 90000) + 10000,
                        date: new Date().toLocaleDateString('id-ID', { dateStyle: 'long' })
                    };

                    localStorage.setItem('velora_last_order', JSON.stringify(orderData));
                    
                    // Lanjut ke halaman Konfirmasi Internal (Invoice)
                    window.location.href = '/invoice';
                }
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
    </style>
</body>
</html>