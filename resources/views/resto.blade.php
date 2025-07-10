<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant['name'] }} - HERO</title>
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

<body class="bg-gradient-to-br from-blue-500 via-purple-500 to-purple-700 min-h-screen font-sans">
    <div class="max-w-6xl mx-auto p-4 md:p-8">
        
        <!-- Back Button -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-secondary to-orange-500 text-white px-6 py-3 rounded-full font-medium transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-orange-300/30 mb-8">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Homepage
        </a>

        <!-- Restaurant Header -->
        <div class="bg-white rounded-2xl p-6 md:p-8 mb-8 shadow-xl">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <img src="{{ asset($restaurant['image']) }}" alt="{{ $restaurant['name'] }}" class="w-full h-48 md:h-56 object-cover rounded-xl shadow-lg">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-primary mb-4">{{ $restaurant['name'] }}</h1>
                    <div class="flex flex-wrap gap-4 md:gap-6 mb-4">
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fas fa-map-marker-alt text-secondary"></i>
                            <span>{{ $restaurant['location'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fas fa-phone text-secondary"></i>
                            <span>{{ $restaurant['phone'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($restaurant['rating']))
                                        <i class="fas fa-star"></i>
                                    @elseif($i == ceil($restaurant['rating']))
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-600">{{ $restaurant['rating'] }}/5</span>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed">{{ $restaurant['description'] }}</p>
                </div>
            </div>
        </div>

        <!-- Makanan Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 mb-8 shadow-xl">
            <h2 class="flex items-center gap-4 text-2xl font-bold text-primary mb-8 pb-4 border-b-4 border-secondary">
                <i class="fas fa-utensils text-secondary"></i>
                Makanan Tersedia
            </h2>
            
            @if($makananItems->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($makananItems as $item)
                        <div class="bg-gray-50 rounded-xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl border-2 border-transparent hover:border-secondary">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-lg font-bold text-gray-800 mb-2">{{ $item->nama_barang }}</div>
                                    <div class="flex items-center gap-2">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->stok <= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            Stok: {{ $item->stok }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-500 block">Harga Beli</span>
                                    <div class="font-bold text-red-500">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</div>
                                    <span class="text-xs text-gray-500 block">Harga Jual</span>
                                    <div class="font-bold text-success">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="flex items-center gap-2 text-sm">
                                    <i class="fas fa-calendar-alt text-secondary"></i>
                                    <span class="text-gray-600">Exp: {{ $item->tanggal_kadaluarsa->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm">
                                    <i class="fas fa-tag text-secondary"></i>
                                    <span class="text-gray-600">{{ ucfirst($item->jenis_barang) }}</span>
                                </div>
                            </div>
                            
                            <button class="order-btn w-full py-3 bg-gradient-to-r from-success to-green-600 text-white rounded-lg font-bold transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-green-300/30" 
                                    data-item-name="{{ $item->nama_barang }}" 
                                    data-item-price="{{ $item->harga_jual }}">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Pesan Sekarang
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-xl">
                    <i class="fas fa-utensils text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 italic">Tidak ada makanan yang tersedia saat ini</p>
                </div>
            @endif
        </div>

        <!-- Minuman Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-xl">
            <h2 class="flex items-center gap-4 text-2xl font-bold text-primary mb-8 pb-4 border-b-4 border-secondary">
                <i class="fas fa-coffee text-secondary"></i>
                Minuman Tersedia
            </h2>
            
            @if($minumanItems->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($minumanItems as $item)
                        <div class="bg-gray-50 rounded-xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl border-2 border-transparent hover:border-secondary">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-lg font-bold text-gray-800 mb-2">{{ $item->nama_barang }}</div>
                                    <div class="flex items-center gap-2">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->stok <= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            Stok: {{ $item->stok }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-500 block">Harga Beli</span>
                                    <div class="font-bold text-red-500">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</div>
                                    <span class="text-xs text-gray-500 block">Harga Jual</span>
                                    <div class="font-bold text-success">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="flex items-center gap-2 text-sm">
                                    <i class="fas fa-calendar-alt text-secondary"></i>
                                    <span class="text-gray-600">Exp: {{ $item->tanggal_kadaluarsa->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm">
                                    <i class="fas fa-tag text-secondary"></i>
                                    <span class="text-gray-600">{{ ucfirst($item->jenis_barang) }}</span>
                                </div>
                            </div>
                            
                            <button class="order-btn w-full py-3 bg-gradient-to-r from-success to-green-600 text-white rounded-lg font-bold transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-green-300/30" 
                                    data-item-name="{{ $item->nama_barang }}" 
                                    data-item-price="{{ $item->harga_jual }}">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Pesan Sekarang
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-xl">
                    <i class="fas fa-coffee text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 italic">Tidak ada minuman yang tersedia saat ini</p>
                </div>
            @endif
        </div>    </div>

    <script>
        // Add event listeners to all order buttons
        document.addEventListener('DOMContentLoaded', function() {
            const orderButtons = document.querySelectorAll('.order-btn');
            
            orderButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemName = this.dataset.itemName;
                    const itemPrice = parseFloat(this.dataset.itemPrice);
                    orderItem(itemName, itemPrice, this);
                });
            });
            
            // Add hover effects to menu items
            const menuItems = document.querySelectorAll('.bg-gray-50');
            menuItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
          function orderItem(itemName, price, button) {
            // Get item data from the button's parent card
            const card = button.closest('.bg-gray-50');
            const stockText = card.querySelector('.px-3').textContent;
            const stock = parseInt(stockText.replace('Stok: ', ''));
            const buyPriceText = card.querySelector('.text-red-500').textContent;
            const buyPrice = parseInt(buyPriceText.replace(/[^\d]/g, ''));
            const expiryText = card.querySelector('.text-gray-600').textContent;
            const expiry = expiryText.replace('Exp: ', '');
            
            // Create URL with parameters
            const checkoutUrl = '{{ route("checkout") }}' + 
                '?name=' + encodeURIComponent(itemName) +
                '&stock=' + stock +
                '&buyPrice=' + buyPrice +
                '&sellPrice=' + price +
                '&expiry=' + encodeURIComponent(expiry);
              // Redirect to checkout page
            window.location.href = checkoutUrl;
        }
    </script>
</body>
</html>
