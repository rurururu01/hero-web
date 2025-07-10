<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pesanan - HERO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4B0082',
                        secondary: '#FFA500',
                        success: '#4CAF50',
                        warning: '#ff6b35'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen font-sans">
    <div class="w-full min-h-screen">
        
        <!-- Header -->
        <div class="bg-white shadow-sm px-4 lg:px-8 py-4 flex items-center gap-4">
            <button onclick="goBack()" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <h1 class="text-lg lg:text-2xl font-semibold text-gray-800">Checkout Pesanan</h1>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto p-4 lg:p-8">
            <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Left Column - Informasi Pesanan & Detail Produk -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Pesanan -->
                    <div class="bg-white rounded-lg p-6 lg:p-8 shadow-sm border">
                        <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 mb-6">Informasi Pesanan</h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 text-sm lg:text-base">Nama Makanan</span>
                                    <span class="font-medium text-gray-800 lg:text-lg" id="itemName">-</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 text-sm lg:text-base">Tanggal Pemesanan</span>
                                    <span class="font-medium text-gray-800 lg:text-lg">{{ date('l, d M Y') }}</span>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 text-sm lg:text-base">Jenis Layanan</span>
                                    <span class="font-medium text-gray-800 lg:text-lg">Ambil Ditempat</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 text-sm lg:text-base">Jumlah Makanan</span>
                                    <div class="flex items-center gap-3">
                                        <button onclick="decreaseQuantity()" class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-secondary text-white flex items-center justify-center hover:bg-orange-600 transition-colors">
                                            <i class="fas fa-minus text-sm lg:text-base"></i>
                                        </button>
                                        <span class="font-medium text-gray-800 w-12 text-center text-lg lg:text-xl" id="quantity">1</span>
                                        <button onclick="increaseQuantity()" class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-secondary text-white flex items-center justify-center hover:bg-orange-600 transition-colors">
                                            <i class="fas fa-plus text-sm lg:text-base"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Produk -->
                    <div class="bg-white rounded-lg p-6 lg:p-8 shadow-sm border">
                        <h3 class="text-xl lg:text-2xl font-semibold text-gray-800 mb-6">Detail Produk</h3>
                        <div class="grid md:grid-cols-2 gap-4 lg:gap-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 lg:text-lg">Stok Tersedia:</span>
                                <span class="text-gray-800 font-medium lg:text-lg" id="itemStock">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 lg:text-lg">Harga Beli:</span>
                                <span class="text-red-500 font-semibold lg:text-lg" id="itemBuyPrice">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 lg:text-lg">Harga Jual:</span>
                                <span class="text-success font-semibold lg:text-lg" id="itemSellPrice">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 lg:text-lg">Expired:</span>
                                <span class="text-gray-800 font-medium lg:text-lg" id="itemExpiry">-</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Metode Pembayaran & Total -->
                <div class="space-y-6">
                    <!-- Metode Pembayaran -->
                    <div class="bg-white rounded-lg p-6 lg:p-8 shadow-sm border">
                        <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 mb-6">Metode Pembayaran</h2>
                        
                        <!-- Cash On Site -->
                        <div class="mb-6">
                            <label class="flex items-center gap-4 p-4 lg:p-5 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="payment" value="cos" class="w-5 h-5 lg:w-6 lg:h-6 text-secondary">
                                <span class="font-medium text-gray-800 text-lg lg:text-xl">COD (Cash On Site)</span>
                            </label>
                        </div>

                        <!-- Dompet Digital -->
                        <div class="mb-3">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="font-medium text-gray-800 text-lg lg:text-xl">Dompet Digital</span>
                                <button onclick="toggleDigitalWallet()" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-down transition-transform duration-200 text-lg" id="walletToggle"></i>
                                </button>
                            </div>
                            
                            <div id="digitalWalletOptions" class="space-y-3 max-h-0 overflow-hidden transition-all duration-300">
                                <!-- ShopeePay -->
                                <label class="flex items-center gap-4 p-4 lg:p-5 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment" value="shopeepay" class="w-5 h-5 lg:w-6 lg:h-6 text-secondary">
                                    <img src="/images/icons/logo_shopeepay.png" alt="ShopeePay" class="w-8 h-8 lg:w-10 lg:h-10">
                                    <span class="font-medium text-gray-800 flex-1 lg:text-lg">ShopeePay</span>
                                </label>
                                
                                <!-- GoPay -->
                                <label class="flex items-center gap-4 p-4 lg:p-5 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment" value="gopay" class="w-5 h-5 lg:w-6 lg:h-6 text-secondary">
                                    <img src="/images/icons/logo_gopay.png" alt="GoPay" class="w-8 h-8 lg:w-10 lg:h-10">
                                    <span class="font-medium text-gray-800 flex-1 lg:text-lg">GoPay</span>
                                </label>
                                
                                <!-- Dana -->
                                <label class="flex items-center gap-4 p-4 lg:p-5 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment" value="dana" class="w-5 h-5 lg:w-6 lg:h-6 text-secondary">
                                    <img src="/images/icons/logo_dana.png" alt="Dana" class="w-8 h-8 lg:w-10 lg:h-10">
                                    <span class="font-medium text-gray-800 flex-1 lg:text-lg">Dana</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Total dan Button Bayar -->
                    <div class="bg-white rounded-lg p-6 lg:p-8 shadow-sm border sticky top-4">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-xl lg:text-2xl font-semibold text-gray-800">Total:</span>
                            <span class="text-2xl lg:text-3xl font-bold text-secondary" id="totalPrice">Rp 0</span>
                        </div>
                          <button onclick="processPayment()" class="w-full bg-gray-300 text-gray-500 py-4 lg:py-5 rounded-lg font-semibold text-lg lg:text-xl transition-colors duration-300 flex items-center justify-center gap-2" id="payButton" disabled>
                            <span id="buttonText">Pilih Metode Pembayaran</span>
                            <i class="fas fa-spinner fa-spin hidden" id="loadingSpinner"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-6 lg:p-8 mx-4 max-w-md lg:max-w-lg w-full text-center">
            <div class="w-20 h-20 lg:w-24 lg:h-24 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-white text-3xl lg:text-4xl"></i>
            </div>
            
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-6">Pembelian Berhasil!</h2>
            
            <div class="text-left space-y-3 mb-8 bg-gray-50 p-4 lg:p-6 rounded-lg">
                <div class="flex justify-between text-base lg:text-lg">
                    <span class="text-gray-500">Nama Makanan</span>
                    <span class="font-medium text-gray-800" id="modalItemName">-</span>
                </div>
                <div class="flex justify-between text-base lg:text-lg">
                    <span class="text-gray-500">Tanggal Pemesanan</span>
                    <span class="font-medium text-gray-800">{{ date('l, d M Y') }}</span>
                </div>
                <div class="flex justify-between text-base lg:text-lg">
                    <span class="text-gray-500">Jenis Layanan</span>
                    <span class="font-medium text-gray-800">Ambil Ditempat</span>
                </div>
                <div class="flex justify-between text-base lg:text-lg">
                    <span class="text-gray-500">Jumlah Makanan</span>
                    <span class="font-medium text-gray-800" id="modalQuantity">1</span>
                </div>
                <div class="flex justify-between text-base lg:text-lg border-t pt-3">
                    <span class="text-gray-500 font-medium">Total Harga</span>
                    <span class="font-bold text-gray-800 text-lg lg:text-xl" id="modalTotal">Rp 0</span>
                </div>
            </div>
            
            <p class="text-gray-600 mb-8 text-lg lg:text-xl">Ambil Makananmu Segera!</p>
            
            <button onclick="confirmOrder()" class="w-full bg-secondary text-white py-4 lg:py-5 rounded-lg font-semibold text-lg lg:text-xl hover:bg-orange-600 transition-colors">
                Konfirmasi
            </button>
        </div>
    </div>    <script>
        let itemData = {};
        let currentQuantity = 1;

        // Initialize page with URL parameters
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            itemData = {
                name: urlParams.get('name') || 'Item tidak ditemukan',
                stock: parseInt(urlParams.get('stock')) || 0,
                buyPrice: parseFloat(urlParams.get('buyPrice')) || 0,
                sellPrice: parseFloat(urlParams.get('sellPrice')) || 0,
                expiry: urlParams.get('expiry') || 'Tidak diketahui'
            };
            
            updateItemDisplay();
            
            // Add event listeners for payment methods
            const paymentRadios = document.querySelectorAll('input[name="payment"]');
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', updatePayButton);
            });

            // Check current stock from database
            checkCurrentStock();
        });

        function checkCurrentStock() {
            fetch('/checkout/stock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    item_name: itemData.name
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update stock if different from URL parameter
                    if (data.current_stock !== itemData.stock) {
                        itemData.stock = data.current_stock;
                        updateItemDisplay();
                        
                        // If current quantity exceeds available stock, reset to 1
                        if (currentQuantity > itemData.stock) {
                            currentQuantity = Math.min(1, itemData.stock);
                            document.getElementById('quantity').textContent = currentQuantity;
                            updateTotal();
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error checking stock:', error);
            });
        }

        function updateItemDisplay() {
            document.getElementById('itemName').textContent = itemData.name;
            document.getElementById('itemStock').textContent = itemData.stock + ' pcs';
            document.getElementById('itemBuyPrice').textContent = 'Rp ' + itemData.buyPrice.toLocaleString('id-ID');
            document.getElementById('itemSellPrice').textContent = 'Rp ' + itemData.sellPrice.toLocaleString('id-ID');
            document.getElementById('itemExpiry').textContent = itemData.expiry;
            
            updateTotal();

            // Disable buttons if no stock
            const increaseBtn = document.querySelector('button[onclick="increaseQuantity()"]');
            const decreaseBtn = document.querySelector('button[onclick="decreaseQuantity()"]');
            const payButton = document.getElementById('payButton');

            if (itemData.stock === 0) {
                increaseBtn.disabled = true;
                decreaseBtn.disabled = true;
                increaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
                decreaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
                payButton.disabled = true;
                payButton.textContent = 'Stok Habis';
                payButton.classList.add('bg-red-500', 'text-white');
                payButton.classList.remove('bg-gray-300', 'text-gray-500');
            } else {
                increaseBtn.disabled = false;
                decreaseBtn.disabled = false;
                increaseBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                decreaseBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        function updateTotal() {
            const total = itemData.sellPrice * currentQuantity;
            document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        function increaseQuantity() {
            if (currentQuantity < itemData.stock && itemData.stock > 0) {
                currentQuantity++;
                document.getElementById('quantity').textContent = currentQuantity;
                updateTotal();
            }
        }

        function decreaseQuantity() {
            if (currentQuantity > 1) {
                currentQuantity--;
                document.getElementById('quantity').textContent = currentQuantity;
                updateTotal();
            }
        }

        function toggleDigitalWallet() {
            const options = document.getElementById('digitalWalletOptions');
            const toggle = document.getElementById('walletToggle');
            
            if (options.style.maxHeight === '0px' || options.style.maxHeight === '') {
                options.style.maxHeight = '300px';
                toggle.style.transform = 'rotate(180deg)';
            } else {
                options.style.maxHeight = '0px';
                toggle.style.transform = 'rotate(0deg)';
            }
        }        function updatePayButton() {
            const selectedPayment = document.querySelector('input[name="payment"]:checked');
            const payButton = document.getElementById('payButton');
            const buttonText = document.getElementById('buttonText');
            
            // Check if stock is available
            if (itemData.stock === 0) {
                payButton.disabled = true;
                buttonText.textContent = 'Stok Habis';
                payButton.classList.add('bg-red-500', 'text-white');
                payButton.classList.remove('bg-gray-300', 'text-gray-500', 'bg-secondary', 'hover:bg-orange-600');
                return;
            }
            
            if (selectedPayment) {
                payButton.disabled = false;
                payButton.classList.remove('bg-gray-300', 'text-gray-500', 'bg-red-500');
                payButton.classList.add('bg-secondary', 'text-white', 'hover:bg-orange-600');
                buttonText.textContent = 'Bayar Sekarang';
            } else {
                payButton.disabled = true;
                payButton.classList.add('bg-gray-300', 'text-gray-500');
                payButton.classList.remove('bg-secondary', 'text-white', 'hover:bg-orange-600', 'bg-red-500');
                buttonText.textContent = 'Pilih Metode Pembayaran';
            }
        }

        function processPayment() {
            const selectedPayment = document.querySelector('input[name="payment"]:checked');
            if (!selectedPayment) {
                showNotification('Silakan pilih metode pembayaran terlebih dahulu', 'error');
                return;
            }

            if (itemData.stock === 0) {
                showNotification('Maaf, stok tidak tersedia', 'error');
                return;
            }

            if (currentQuantity > itemData.stock) {
                showNotification('Jumlah pesanan melebihi stok yang tersedia', 'error');
                return;
            }

            // Show loading state
            const payButton = document.getElementById('payButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            payButton.disabled = true;
            buttonText.textContent = 'Memproses Pesanan...';
            loadingSpinner.classList.remove('hidden');

            // Send order to server
            fetch('/checkout/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    item_name: itemData.name,
                    quantity: currentQuantity,
                    payment_method: selectedPayment.value,
                    total_price: itemData.sellPrice * currentQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update stock after successful order
                    itemData.stock = data.data.remaining_stock;
                    
                    // Update display with new stock
                    updateItemDisplay();
                    
                    // Update modal content
                    document.getElementById('modalItemName').textContent = data.data.item_name;
                    document.getElementById('modalQuantity').textContent = data.data.quantity;
                    document.getElementById('modalTotal').textContent = 'Rp ' + data.data.total_price.toLocaleString('id-ID');
                    
                    // Show success notification
                    showNotification('Pesanan berhasil diproses! Stok tersisa: ' + data.data.remaining_stock, 'success');
                    
                    // Show success modal after a short delay
                    setTimeout(() => {
                        document.getElementById('successModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }, 1000);
                } else {
                    showNotification('Error: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error processing order:', error);
                showNotification('Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.', 'error');
            })
            .finally(() => {
                // Reset button state
                loadingSpinner.classList.add('hidden');
                updatePayButton();
            });
        }

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transition-all duration-300 transform translate-x-full`;
            
            // Set colors based on type
            if (type === 'success') {
                notification.classList.add('bg-green-500', 'text-white');
            } else if (type === 'error') {
                notification.classList.add('bg-red-500', 'text-white');
            } else {
                notification.classList.add('bg-blue-500', 'text-white');
            }
            
            notification.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Slide in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 5000);
        }

        function confirmOrder() {
            // Redirect to homepage
            window.location.href = '{{ route("home") }}';
        }

        function goBack() {
            window.history.back();
        }

        // Close modal when clicking outside
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                document.getElementById('successModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>
</html>
