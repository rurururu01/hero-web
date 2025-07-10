# User Management CRUD - Laravel Livewire + Tailwind CSS

## Overview
Sistem manajemen user dengan fitur CRUD lengkap menggunakan Laravel Livewire, Tailwind CSS, dan Alpine.js. Form modal diperbaharui secara realtime tanpa reload halaman.

## Fitur-fitur

### ✅ CRUD Operations
- **Create**: Tambah user baru dengan modal form
- **Read**: Tampilkan daftar user dengan pagination
- **Update**: Edit user existing dengan modal form
- **Delete**: Hapus user dengan konfirmasi

### ✅ Real-time Features
- Live search berdasarkan nama dan email
- Real-time pagination
- Modal form yang responsive
- Loading indicators
- Flash messages dengan auto-hide

### ✅ UI/UX Features
- **Responsive Design**: Mobile-first approach dengan Tailwind CSS
- **Modal Forms**: Form create/edit dalam modal yang elegant
- **Loading States**: Indikator loading untuk operasi async
- **Animations**: Smooth transitions dengan Alpine.js
- **Icons**: Font Awesome icons untuk visual yang menarik
- **Avatar**: Initial-based user avatars

### ✅ Validation
- Server-side validation dengan Laravel
- Real-time error display
- Unique email validation
- Password confirmation untuk create/update

## File Structure

```
app/
├── Livewire/
│   └── Data/
│       └── UserTable.php      # Main Livewire component
├── Models/
│   └── User.php               # User model
database/
├── seeders/
│   └── UserSeeder.php         # Sample data seeder
resources/
├── views/
│   ├── users.blade.php        # Main users page
│   └── livewire/
│       └── data/
│           └── user-table.blade.php # Livewire component view
routes/
└── web.php                    # Routes definition
```

## Technologies Used

- **Laravel 11**: Backend framework
- **Livewire 3**: Real-time components
- **Tailwind CSS**: Utility-first CSS framework
- **Alpine.js**: Lightweight JavaScript framework
- **Font Awesome**: Icon library

## Usage

### Accessing the Application
1. Navigate to `/users` route
2. Click "Add New User" to create new user
3. Use search bar to find specific users
4. Click "Edit" to update user information
5. Click "Delete" to remove users (with confirmation)

### Sample Data
Run the seeder to populate with sample users:
```bash
php artisan db:seed --class=UserSeeder
```

### Features in Action

#### 1. Create User
- Click "Add New User" button
- Fill form in modal
- Real-time validation
- Success message after creation

#### 2. Search Users
- Type in search box
- Live filtering by name/email
- Pagination resets automatically

#### 3. Edit User
- Click "Edit" button on any user
- Form pre-populated with user data
- Password field optional for updates
- Email uniqueness validation

#### 4. Delete User
- Click "Delete" button
- Confirmation dialog appears
- User removed with success message

## Responsive Design
- Mobile-friendly layout
- Adaptive table columns
- Touch-friendly buttons
- Optimized modal sizing

## Performance Features
- Pagination for large datasets
- Efficient database queries
- Minimal JavaScript footprint
- CSS optimizations

## Future Enhancements
- [ ] Bulk operations
- [ ] Advanced filtering
- [ ] Role management
- [ ] Export functionality
- [ ] User profile images
- [ ] Activity logs

## Recent Updates

### Navigation Structure Changes
Aplikasi telah direorganisasi dengan struktur navigasi yang lebih intuitif:

**Perubahan Navigasi:**
1. **Homepage (`/`)**: Button "Users" dihapus, akses ke user management melalui "Daftar Data"
2. **Daftar Data (`/daftardata`)**: Menampilkan tab navigation dengan 2 opsi:
   - 📊 **Data Makanan** (aktif) - Mengelola data makanan/minuman
   - 👥 **Data User** - Mengelola data user
3. **Data User (`/users`)**: Tab navigation dengan visual yang konsisten

**Tab Navigation Features:**
- ✅ Visual indicator untuk tab aktif/tidak aktif
- ✅ Hover effects untuk pengalaman user yang lebih baik
- ✅ Font Awesome icons untuk setiap tab
- ✅ Responsive design
- ✅ Consistent styling antara kedua halaman

**File Structure Changes:**
- `app/Livewire/Data/UserTable.php` - Livewire component (moved to Data namespace)
- `resources/views/livewire/data/user-table.blade.php` - Component view (moved to data subfolder)
- `resources/views/users.blade.php` - Updated navigation structure
- `resources/views/daftardata.blade.php` - Added tab navigation
- `resources/views/index.blade.php` - Removed direct Users button

**Namespace Information:**
- **Livewire Component**: `App\Livewire\Data\UserTable`
- **View Path**: `livewire.data.user-table`
- **Directive Usage**: `@livewire('data.user-table')`

This structure provides better organization for larger applications with multiple data-related components and creates a more intuitive user flow.
