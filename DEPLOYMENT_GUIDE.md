# Hero Web - Deployment Guide

## Persiapan Deployment

### Requirements
- PHP 8.1 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer
- Node.js & NPM

## Deployment ke Hosting (cPanel/Shared Hosting)

### 1. Upload Files
Upload semua file ke hosting Anda, pastikan folder `public` menjadi document root.

### 2. Konfigurasi Database
1. Buat database MySQL di cPanel
2. Copy file `.env.example` menjadi `.env`
3. Edit file `.env`:
```
APP_NAME="Hero Web"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 3. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
```bash
php artisan migrate --force
```

### 6. Optimize untuk Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 7. Set Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Deployment ke VPS (Ubuntu/Debian)

### 1. Install Requirements
```bash
sudo apt update
sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip
sudo apt install nginx mysql-server composer
```

### 2. Clone Repository
```bash
cd /var/www
sudo git clone https://github.com/rurururu01/HERO.git hero-web
cd hero-web
```

### 3. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### 4. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
nano .env  # Edit database credentials
```

### 5. Database Setup
```bash
php artisan migrate --force
```

### 6. Set Permissions
```bash
sudo chown -R www-data:www-data /var/www/hero-web
sudo chmod -R 755 /var/www/hero-web/storage
sudo chmod -R 755 /var/www/hero-web/bootstrap/cache
```

### 7. Nginx Configuration
Create file `/etc/nginx/sites-available/hero-web`:
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/hero-web/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/hero-web /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### 8. SSL Certificate (Optional but Recommended)
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 9. Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Update Deployment

### Pull Latest Changes
```bash
cd /var/www/hero-web
git pull origin main
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Troubleshooting

### Storage Link Error
```bash
php artisan storage:link
```

### Clear All Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Permission Issues
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## Domain Configuration

1. **Point domain ke server**:
   - Tambahkan A Record di DNS provider Anda
   - Arahkan ke IP address server

2. **Update .env**:
   - Ubah `APP_URL` menjadi domain Anda

3. **Restart services**:
```bash
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm
```

## Security Checklist

- [ ] Set `APP_DEBUG=false` di production
- [ ] Set `APP_ENV=production`
- [ ] Generate unique `APP_KEY`
- [ ] Use strong database passwords
- [ ] Install SSL certificate
- [ ] Set proper file permissions
- [ ] Enable firewall
- [ ] Regular backups

## Maintenance Mode

Enable maintenance mode:
```bash
php artisan down
```

Disable maintenance mode:
```bash
php artisan up
```

---

**Repository**: https://github.com/rurururu01/HERO.git
**Last Updated**: January 2026
