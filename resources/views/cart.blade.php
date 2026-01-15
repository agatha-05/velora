<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bag - Velora Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fdfbf7; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
        .product-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        /* Custom Checkbox Style */
        .custom-checkbox {
            width: 24px;
            height: 24px;
            cursor: pointer;
            accent-color: #d97706; /* Amber-600 */
        }
    </style>
</head>
<body class="text-gray-900">

    <nav class="sticky top-0 z-50 glass border-b border-amber-100">
        <div class="max-w-6xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="p-2 bg-amber-100 rounded-full group-hover:bg-amber-600 group-hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                <span class="font-bold text-sm uppercase tracking-widest text-gray-500 group-hover:text-amber-600 transition">Kembali</span>
            </a>
            <h1 class="text-2xl font-extrabold tracking-tighter text-amber-600">VELORA</h1>
            <div class="w-10"></div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="lg:w-2/3">
                <div class="flex items-center justify-between mb-10">
                    <div class="flex items-end gap-4">
                        <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Tas Belanja</h2>
                        <span id="items-count-top" class="text-amber-600 font-bold text-xl mb-1">(0)</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-2xl border border-gray-100 shadow-sm">
                        <input type="checkbox" id="select-all" onclick="toggleSelectAll(this)" class="custom-checkbox">
                        <label for="select-all" class="text-sm font-bold text-gray-500 cursor-pointer">Pilih Semua</label>
                    </div>
                </div>

                <div id="cart-items" class="space-y-6">
                    </div>

                <div id="empty-cart" class="hidden flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-40 h-40 bg-amber-50 rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-amber-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Keranjangmu Kosong</h3>
                    <a href="{{ route('home') }}" class="bg-gray-900 text-white px-10 py-4 rounded-full font-bold hover:bg-amber-600 transition-all shadow-xl">Mulai Cari Produk</a>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div id="summary-card" class="bg-white rounded-[40px] p-10 border border-amber-50 shadow-2xl shadow-amber-100/50 sticky top-32">
                    <h3 class="text-2xl font-extrabold mb-8 tracking-tight">Ringkasan</h3>
                    
                    <div class="space-y-5">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Produk Terpilih</span>
                            <span id="selected-count" class="font-bold">0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Subtotal</span>
                            <span id="subtotal" class="font-bold text-lg">Rp0</span>
                        </div>
                        
                        <div class="pt-6 mt-6 border-t border-gray-100">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Total Bayar</p>
                            <p id="total-price" class="text-4xl font-extrabold text-amber-600 tracking-tighter">Rp0</p>
                        </div>
                    </div>

                    <button onclick="checkoutWhatsApp()" id="btn-checkout" disabled class="w-full bg-gray-300 text-white mt-10 py-5 rounded-[25px] font-black uppercase tracking-widest transition-all shadow-xl cursor-not-allowed">
                        Checkout (<span id="btn-count">0</span>)
                    </button>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Objek untuk menyimpan status pilihan produk (ID => Boolean)
        let selectedItems = {};

        function renderCart() {
            const cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
            const container = document.getElementById('cart-items');
            const emptyState = document.getElementById('empty-cart');
            const countTop = document.getElementById('items-count-top');
            
            countTop.innerText = `(${cart.length})`;

            if (cart.length === 0) {
                emptyState.classList.remove('hidden');
                container.innerHTML = '';
                updateSummary();
                return;
            }

            emptyState.classList.add('hidden');
            container.innerHTML = '';

            cart.forEach((item, index) => {
                // Default: jika belum ada di objek selectedItems, set false
                if (selectedItems[item.id] === undefined) selectedItems[item.id] = false;

                container.innerHTML += `
                    <div class="product-card glass p-6 md:p-8 rounded-[40px] border border-white shadow-sm flex items-center gap-4 md:gap-8">
                        <div class="flex-shrink-0">
                            <input type="checkbox" 
                                   class="custom-checkbox item-checkbox" 
                                   ${selectedItems[item.id] ? 'checked' : ''} 
                                   onclick="toggleItemSelection('${item.id}')">
                        </div>

                        <div class="flex flex-col md:flex-row items-center gap-6 flex-grow">
                            <img src="${item.image}" class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-[25px] shadow-md" alt="${item.name}">
                            
                            <div class="flex-grow text-center md:text-left">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-extrabold text-gray-900 text-lg md:text-xl tracking-tight">${item.name}</h3>
                                    <button onclick="removeFromCart(${index})" class="text-red-300 hover:text-red-500 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-amber-600 font-black text-lg mt-1">Rp${item.price.toLocaleString('id-ID')}</p>
                                
                                <div class="flex items-center justify-center md:justify-start mt-4 gap-4">
                                    <div class="flex items-center p-1 bg-gray-50 rounded-xl border border-gray-100">
                                        <button onclick="changeQty(${index}, -1)" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white transition font-bold">-</button>
                                        <span class="w-10 text-center font-extrabold text-sm">${item.quantity}</span>
                                        <button onclick="changeQty(${index}, 1)" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white transition font-bold text-amber-600">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            updateSummary();
        }

        function toggleItemSelection(id) {
            selectedItems[id] = !selectedItems[id];
            updateSummary();
        }

        function toggleSelectAll(masterCheckbox) {
            const cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
            cart.forEach(item => {
                selectedItems[item.id] = masterCheckbox.checked;
            });
            renderCart(); // Re-render untuk update tampilan checkbox
        }

        function updateSummary() {
            const cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
            let total = 0;
            let count = 0;

            cart.forEach(item => {
                if (selectedItems[item.id]) {
                    total += item.price * item.quantity;
                    count++;
                }
            });

            document.getElementById('subtotal').innerText = 'Rp' + total.toLocaleString('id-ID');
            document.getElementById('total-price').innerText = 'Rp' + total.toLocaleString('id-ID');
            document.getElementById('selected-count').innerText = count;
            document.getElementById('btn-count').innerText = count;

            const btn = document.getElementById('btn-checkout');
            if (count > 0) {
                btn.disabled = false;
                btn.classList.remove('bg-gray-300', 'cursor-not-allowed');
                btn.classList.add('bg-amber-600', 'hover:bg-amber-700', 'shadow-amber-200');
            } else {
                btn.disabled = true;
                btn.classList.add('bg-gray-300', 'cursor-not-allowed');
                btn.classList.remove('bg-amber-600', 'hover:bg-amber-700', 'shadow-amber-200');
            }
        }

        function changeQty(index, delta) {
            let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
            cart[index].quantity += delta;
            if (cart[index].quantity < 1) {
                removeFromCart(index);
            } else {
                localStorage.setItem('velora_cart', JSON.stringify(cart));
                renderCart();
            }
        }

        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
            delete selectedItems[cart[index].id]; // Hapus dari status terpilih
            cart.splice(index, 1);
            localStorage.setItem('velora_cart', JSON.stringify(cart));
            renderCart();
        }

        function checkoutWhatsApp() {
            let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
            let total = 0;
            let text = "*ORDER VELORA PREMIUM*%0A%0A";
            
            let hasSelection = false;
            cart.forEach((item, i) => {
                if (selectedItems[item.id]) {
                    text += `- *${item.name}* (${item.quantity}x) - Rp${(item.price * item.quantity).toLocaleString('id-ID')}%0A`;
                    total += item.price * item.quantity;
                    hasSelection = true;
                }
            });

            if(!hasSelection) return alert("Pilih minimal satu produk!");

            text += `%0A*TOTAL AKHIR: Rp${total.toLocaleString('id-ID')}*`;
            window.open(`https://wa.me/6281234567890?text=${text}`, '_blank');
        }

        document.addEventListener('DOMContentLoaded', renderCart);
    </script>
</body>
</html>