# Hero Web - Deployment dengan Domain Gratis

Repository: https://github.com/rurururu01/hero-web

## ⚠️ GitHub Pages Tidak Mendukung Laravel

GitHub Pages hanya untuk static sites (HTML/CSS/JS). Laravel memerlukan PHP server dan database.

## 🚀 Opsi Deployment Gratis dengan Domain

### 1. Railway.app (Recommended - Gratis + Custom Domain)

**Kelebihan:**
- Gratis 500 jam/bulan
- Domain gratis: `*.up.railway.app`
- Bisa custom domain gratis
- Auto deploy dari GitHub
- Include database PostgreSQL gratis

**Langkah Deploy:**

1. **Daftar di Railway**: https://railway.app
   - Login dengan GitHub

2. **Deploy dari GitHub**:
   - Klik "New Project"
   - Pilih "Deploy from GitHub repo"
   - Pilih repository `hero-web`

3. **Tambahkan Database**:
   - Klik "New" → "Database" → "Add PostgreSQL"
   - Railway akan auto-configure connection

4. **Set Environment Variables**:
   ```
   APP_KEY=(generate dengan: php artisan key:generate --show)
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-app.up.railway.app
   
   DB_CONNECTION=pgsql
   DB_HOST=${{Postgres.PGHOST}}
   DB_PORT=${{Postgres.PGPORT}}
   DB_DATABASE=${{Postgres.PGDATABASE}}
   DB_USERNAME=${{Postgres.PGUSER}}
   DB_PASSWORD=${{Postgres.PGPASSWORD}}
   ```

5. **Deploy**:
   - Railway akan otomatis deploy
   - Domain: `https://your-app.up.railway.app`

6. **Custom Domain (Opsional)**:
   - Settings → Domains → Add Custom Domain
   - Tambahkan CNAME record di DNS provider Anda

---

### 2. Heroku (Gratis dengan Domain .herokuapp.com)

**Kelebihan:**
- Domain gratis: `*.herokuapp.com`
- Mudah digunakan
- Bisa custom domain (perlu verifikasi kartu kredit)

**Langkah Deploy:**

1. **Install Heroku CLI**: https://devcenter.heroku.com/articles/heroku-cli

2. **Login dan Create App**:
   ```bash
   heroku login
   cd C:\Users\adity\Downloads\hero_web\hero
   heroku create hero-web-app
   ```

3. **Tambahkan PostgreSQL**:
   ```bash
   heroku addons:create heroku-postgresql:mini
   ```

4. **Set Environment**:
   ```bash
   heroku config:set APP_KEY=$(php artisan key:generate --show)
   heroku config:set APP_ENV=production
   heroku config:set APP_DEBUG=false
   heroku config:set DB_CONNECTION=pgsql
   ```

5. **Deploy**:
   ```bash
   git push heroku main
   heroku run php artisan migrate --force
   ```

6. **Buka App**:
   ```bash
   heroku open
   ```
   Domain: `https://hero-web-app.herokuapp.com`

---

### 3. Vercel + PlanetScale (Gratis - Perlu Setup Extra)

**Kelebihan:**
- Deployment super cepat
- Custom domain gratis
- Database MySQL gratis dari PlanetScale

**Catatan**: Perlu konfigurasi tambahan untuk Laravel di Vercel (serverless).

---

### 4. InfinityFree (Hosting PHP Gratis)

**Kelebihan:**
- Hosting PHP gratis
- MySQL database gratis
- Subdomain gratis: `*.infinityfreeapp.com`
- Bisa custom domain

**Kekurangan:**
- Ada iklan (bisa dihilangkan)
- Batasan bandwidth

**Website**: https://infinityfree.net

---

### 5. 000webhost (PHP Hosting Gratis)

**Kelebihan:**
- PHP 7.4/8.0
- MySQL database
- 300 MB storage
- 3 GB bandwidth

**Website**: https://www.000webhost.com

---

## 🎯 Rekomendasi

### Untuk Development/Testing:
**Railway.app** - Paling mudah, auto-deploy dari GitHub, gratis dengan custom domain.

### Untuk Production:
1. **Railway.app** (Gratis 500 jam/bulan)
2. **Heroku** (Gratis dengan batasan)
3. **VPS Murah** (DigitalOcean, Vultr - $5/bulan)

---

## 📋 Checklist Sebelum Deploy

- [ ] Generate `APP_KEY` baru
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Konfigurasi database credentials
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Run `npm run build`
- [ ] Set file permissions (storage, bootstrap/cache)

---

## 🔗 Links

- **Repository**: https://github.com/rurururu01/hero-web
- **Railway**: https://railway.app
- **Heroku**: https://www.heroku.com
- **InfinityFree**: https://infinityfree.net

---

## 💡 Tips

1. **Railway** paling direkomendasikan untuk Laravel (paling mudah setup)
2. Gunakan PostgreSQL untuk Railway/Heroku (sudah include)
3. Custom domain bisa menggunakan Cloudflare (gratis)
4. Untuk production serius, pertimbangkan VPS atau shared hosting berbayar

---

**Last Updated**: January 2026
