# HERO - Laravel E-Commerce Application

## 📝 Deskripsi
HERO adalah aplikasi e-commerce berbasis Laravel yang dirancang untuk manajemen surplus makanan/minuman dengan fitur lengkap meliputi authentication, CRUD, checkout system, dan dashboard analytics.

## ✨ Fitur Utama

### 🔐 Authentication System
- **Login/Register** dengan validasi lengkap
- **User Management** dengan Livewire components
- **Session Management** dan logout functionality
- **Input validation** dan error handling

### 📊 Data Management
- **CRUD Makanan/Minuman** dengan real-time updates
- **Filter, Search & Pagination** menggunakan Livewire
- **Export Data** dan bulk operations
- **Stock Management** dengan database integration

### 🛒 Checkout System
- **Real-time Stock Checking** 
- **Multiple Payment Methods** (COD, ShopeePay, GoPay, Dana)
- **Database Transaction** untuk stock updates
- **Responsive Design** desktop dan mobile
- **Order Processing** dengan AJAX

### 📈 Analytics & Reporting
- **Chart Visualization** dengan Chart.js
- **Stock Analytics** makanan vs minuman
- **Interactive Dashboard** dengan real-time data
- **Data Export** dalam berbagai format

### 🏪 Restaurant Features
- **Restaurant Listings** dengan dynamic content
- **Menu Display** dari database
- **Order Simulation** dengan product details
- **Responsive Cards** dan interactive UI

### 🎨 UI/UX Features
- **Responsive Design** dengan Tailwind CSS
- **Real-time Notifications** dan toast messages
- **Loading States** dan progress indicators
- **Modal Systems** dan interactive components
- **Consistent Theme** dengan orange/purple color scheme

## 🛠️ Tech Stack

### Backend
- **Laravel 11** - PHP Framework
- **Livewire 3** - Real-time components
- **MySQL** - Database
- **Eloquent ORM** - Database operations

### Frontend
- **Tailwind CSS** - Styling framework
- **Chart.js** - Data visualization
- **Font Awesome** - Icons
- **JavaScript ES6** - Interactive features

### Development Tools
- **Composer** - PHP package manager
- **NPM** - Node package manager
- **Vite** - Build tool
- **Git** - Version control

## 📁 Struktur Project

```
hero/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── CheckoutController.php
│   │   └── HomeController.php
│   ├── Livewire/Data/
│   │   ├── TabelProduk.php
│   │   └── UserTable.php
│   └── Models/
│       ├── Makanan.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── checkout.blade.php
│   ├── daftardata.blade.php
│   ├── grafik.blade.php
│   ├── resto.blade.php
│   └── livewire/data/
├── routes/
│   └── web.php
└── public/
    └── images/
```

## 🚀 Installation

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Git

### Steps

1. **Clone Repository**
```bash
git clone https://github.com/your-username/hero-laravel.git
cd hero-laravel
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hero
DB_USERNAME=root
DB_PASSWORD=
```

5. **Database Migration**
```bash
php artisan migrate
php artisan db:seed
```

6. **Build Assets**
```bash
npm run build
```

7. **Start Development Server**
```bash
php artisan serve
```

## 📊 Database Schema

### Table: makanan
- `id` - Primary Key
- `nama_barang` - Product Name
- `jenis_barang` - Product Type (Makanan/Minuman)
- `stok` - Stock Quantity
- `harga_beli` - Buy Price
- `harga_jual` - Sell Price
- `tanggal_kadaluarsa` - Expiry Date

### Table: users
- Standard Laravel user table
- Additional fields for user management

## 🌟 Key Features Detail

### Real-time Stock Management
- Auto-update stock saat checkout
- Database transaction untuk data consistency
- Real-time stock checking via AJAX
- Stock validation sebelum purchase

### Responsive Checkout
- Desktop: 3-column layout
- Mobile: Single column dengan sticky total
- Interactive quantity selector
- Multiple payment method options

### Advanced Filtering
- Real-time search dalam table
- Filter berdasarkan jenis barang
- Pagination dengan custom styling
- Export data functionality

### Modern UI Components
- Toast notifications
- Loading spinners
- Modal dialogs
- Responsive grids
- Interactive buttons

## 📱 Screenshots

### Dashboard
- Clean interface dengan data overview
- Interactive charts dan statistics
- Quick action buttons

### Checkout System
- Professional payment interface
- Real-time stock updates
- Multiple payment options
- Success confirmations

### Data Management
- Advanced table dengan filter/search
- Inline editing capabilities
- Bulk operations
- Export functionality

## 🤝 Contributing

1. Fork the project
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 👥 Authors

- **Bangkit-ki** - *Initial work* - [bangkit-ki](https://github.com/bangkit-ki)

## 🙏 Acknowledgments

- Laravel team untuk framework yang amazing
- Livewire untuk real-time components
- Tailwind CSS untuk styling framework
- Chart.js untuk data visualization

## 📞 Support

Jika ada pertanyaan atau issue, silakan:
- Buat issue di GitHub repository
- Contact: riki.audy123@gmail.com

---

**⭐ Star this repository jika project ini helpful!**
