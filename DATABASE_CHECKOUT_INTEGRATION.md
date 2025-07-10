# Database Integration untuk Checkout System

## Fitur yang Ditambahkan

### 1. **CheckoutController**
Controller baru yang menangani proses checkout dengan database:

#### **Method `index()`**
- Menerima parameter produk dari URL
- Memvalidasi parameter yang diperlukan
- Menampilkan halaman checkout dengan data produk

#### **Method `processOrder()`**
- Memproses pesanan dengan validasi
- Mengecek stok tersedia di database
- Mengurangi stok sesuai jumlah pesanan
- Menggunakan database transaction untuk konsistensi data
- Mengembalikan response JSON dengan status pesanan

#### **Method `getItemStock()`**
- Mengecek stok terkini dari database
- Memastikan data stok selalu up-to-date
- Digunakan untuk sinkronisasi real-time

### 2. **Route Baru**
Menambahkan 3 route baru untuk checkout:
```php
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');
Route::post('/checkout/stock', [CheckoutController::class, 'getItemStock'])->name('checkout.stock');
```

### 3. **JavaScript Enhancement**

#### **Real-time Stock Checking**
- `checkCurrentStock()`: Mengecek stok terkini saat halaman dimuat
- Memperbarui display jika stok berbeda dari parameter URL
- Menonaktifkan tombol jika stok habis

#### **Enhanced Payment Processing**
- `processPayment()`: Mengirim request AJAX ke server
- Validasi client-side dan server-side
- Update stok real-time setelah pembelian berhasil
- Loading state dengan spinner
- Error handling yang komprehensif

#### **UI/UX Improvements**
- Loading spinner pada tombol pembayaran
- Notifikasi toast yang informatif
- Tombol disabled ketika stok habis
- Visual feedback untuk berbagai status

### 4. **Database Transaction**
Menggunakan database transaction untuk memastikan:
- Atomicity: Semua operasi berhasil atau semua gagal
- Consistency: Data tetap konsisten meski ada error
- Isolation: Transaksi tidak saling mengganggu
- Durability: Perubahan tersimpan permanen

### 5. **Error Handling**
Comprehensive error handling untuk:
- Produk tidak ditemukan
- Stok tidak mencukupi
- Validasi input gagal
- Database connection error
- Network error

## Flow Proses Checkout

### 1. **Inisialisasi Halaman**
```
User akses /checkout?name=...&stock=...&buyPrice=...&sellPrice=...&expiry=...
↓
CheckoutController@index validates parameters
↓
View rendered dengan data produk
↓
JavaScript checkCurrentStock() memverifikasi stok dari database
```

### 2. **Proses Pembelian**
```
User pilih metode pembayaran → klik "Bayar Sekarang"
↓
JavaScript validates input (quantity, payment method)
↓
AJAX POST ke /checkout/process dengan data pesanan
↓
CheckoutController@processOrder:
  - Cari produk di database
  - Validasi stok tersedia
  - Database transaction:
    - Update stock (-quantity)
    - Save changes
  - Return success response
↓
JavaScript update UI:
  - Update stock display
  - Show success notification
  - Show success modal
```

### 3. **Real-time Stock Sync**
- Setiap kali halaman dimuat: cek stok terkini
- Setelah pembelian berhasil: update stok di UI
- Disable interaction jika stok habis

## Validasi yang Diterapkan

### **Server-side Validation**
```php
$request->validate([
    'item_name' => 'required|string',
    'quantity' => 'required|integer|min:1',
    'payment_method' => 'required|string',
    'total_price' => 'required|numeric|min:0',
]);
```

### **Client-side Validation**
- Quantity tidak melebihi stok
- Metode pembayaran harus dipilih
- Stok harus tersedia (> 0)

## File yang Dimodifikasi/Dibuat

### **Baru:**
- `app/Http/Controllers/CheckoutController.php`

### **Dimodifikasi:**
- `routes/web.php` - Menambah route checkout
- `resources/views/checkout.blade.php` - JavaScript enhancement

## Database Schema
Menggunakan tabel `makanan` dengan field:
- `nama_barang` - Nama produk
- `stok` - Jumlah stok
- `harga_beli` - Harga beli
- `harga_jual` - Harga jual
- `tanggal_kadaluarsa` - Tanggal expired

## Security Features
- CSRF Token protection
- Input validation dan sanitization
- Database transaction untuk data integrity
- Error handling tanpa expose sensitive info

## User Experience Features
- Loading state dengan spinner
- Toast notifications
- Real-time stock updates
- Responsive error messages
- Smooth transitions dan animations

## Testing Scenarios
1. **Normal Purchase**: User beli dengan stok cukup
2. **Insufficient Stock**: User beli melebihi stok
3. **Out of Stock**: User akses produk stok habis
4. **Invalid Product**: User akses produk tidak ada
5. **Network Error**: Connection timeout/error
6. **Concurrent Purchase**: Multiple users beli produk sama

## Next Steps (Opsional)
1. Buat tabel `orders` untuk history pembelian
2. Implementasi sistem keranjang belanja
3. Integrasi payment gateway real
4. Notifikasi email/SMS
5. Sistem inventory management
6. Analytics dan reporting
