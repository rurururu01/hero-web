# 🆓 Hero Web - Deploy GRATIS dengan Domain

Repository: https://github.com/rurururu01/hero-web

## 🎯 REKOMENDASI #1: Railway.app (100% GRATIS)

**Kenapa Railway?**
✅ Benar-benar GRATIS (500 jam/bulan = ~20 hari)
✅ Domain gratis: `*.up.railway.app`  
✅ Database PostgreSQL gratis
✅ Auto-deploy dari GitHub (sekali setup, selalu update otomatis)
✅ TIDAK PERLU KARTU KREDIT
✅ Setup cuma 5 menit

---

## 📱 Cara Deploy ke Railway (Super Mudah)

### Step 1: Daftar Railway (1 menit)
1. Buka: https://railway.app
2. Klik **"Login"** atau **"Start a New Project"**
3. Login pakai **GitHub** (akun rurururu01)
4. Selesai! Tidak perlu isi form macam-macam

### Step 2: Deploy Project (2 menit)
1. Di Railway Dashboard, klik **"New Project"**
2. Pilih **"Deploy from GitHub repo"**
3. Authorize Railway untuk akses GitHub
4. Pilih repository: **`hero-web`**
5. Railway akan otomatis detect Laravel dan mulai deploy

### Step 3: Tambah Database (1 menit)
1. Klik **"New"** → **"Database"** → **"Add PostgreSQL"**
2. Database akan otomatis terhubung ke app
3. Tidak perlu setting apa-apa!

### Step 4: Set Environment Variables (1 menit)
1. Klik service "hero-web" → **"Variables"** tab
2. Tambahkan:
   ```
   APP_KEY=base64:GENERATE_INI_NANTI
   APP_ENV=production
   APP_DEBUG=false
   ```
3. **Generate APP_KEY**:
   - Buka terminal di project lokal
   - Run: `php artisan key:generate --show`
   - Copy hasilnya (format: `base64:...`)
   - Paste ke variable `APP_KEY`

### Step 5: Deploy & Dapatkan Domain (30 detik)
1. Railway akan auto-deploy (tunggu ~2 menit)
2. Klik **"Settings"** → **"Generate Domain"**
3. Dapat domain GRATIS: `https://hero-web-production-xxxx.up.railway.app`
4. **SELESAI!** Website sudah online! 🎉

### Step 6: Auto-Deploy Selanjutnya
- Setiap kali push ke GitHub, Railway otomatis deploy ulang
- Tidak perlu deploy manual lagi!

---

## 💰 Gratis Berapa Lama?

**Railway gratis 500 jam per bulan:**
- Jika website selalu online: ~20 hari
- Jika traffic rendah: bisa full 30 hari
- Reset setiap bulan

**Tips Hemat**:
- Website akan sleep otomatis saat tidak ada traffic
- Bangun lagi saat ada visitor (10-20 detik)
- Cukup untuk project pribadi/portfolio

---

## 🔄 Update Database via Railway

```bash
# Via Railway CLI (optional)
railway login
railway link
railway run php artisan migrate
```

Atau manual via web:
1. Railway → Service → Deploy Logs
2. Database auto-migrate saat deploy

---

## 🔗 Link Penting

- **Deploy ke Railway**: https://railway.app
- **GitHub Repo**: https://github.com/rurururu01/hero-web
- **Dokumentasi Railway**: https://docs.railway.app

---

## ❓ Troubleshooting

### Error: "APP_KEY not set"
```bash
# Generate key lokal
php artisan key:generate --show

# Copy hasil (misal: base64:abc123...)
# Paste ke Railway Variables → APP_KEY
```

### Error: Database Connection
- Railway otomatis inject database variables
- Cek di Variables tab, pastikan ada `DATABASE_URL`
- Restart deployment

### Website Sleep/Lambat
- Normal untuk free tier
- Website sleep setelah 10 menit tidak ada traffic
- Wake up otomatis saat ada visitor (~10 detik)

---

## 🎁 BONUS: Opsi Gratis Lainnya

### InfinityFree (Alternatif jika Railway penuh)
- **Website**: https://infinityfree.net
- **Gratis**: PHP, MySQL, 5GB storage
- **Domain**: subdomain.infinityfreeapp.com
- **Cara**: Upload files via FTP, setup manual

### 000webhost
- **Website**: https://www.000webhost.com  
- **Gratis**: PHP 8.0, MySQL, 300MB storage
- **Domain**: subdomain.000webhostapp.com

⚠️ **Catatan**: Dua opsi di atas perlu upload manual dan setup lebih rumit. Railway lebih mudah!

---

## 📋 Ringkasan Singkat

**Langkah Deploy ke Railway (5 menit total):**

1. Buka https://railway.app → Login dengan GitHub
2. New Project → Deploy from GitHub repo → Pilih `hero-web`
3. Add New → Database → PostgreSQL
4. Variables → Tambah `APP_KEY` (generate dengan `php artisan key:generate --show`)
5. Settings → Generate Domain → Selesai!

**Domain gratis**: `https://hero-web-production-xxxx.up.railway.app`

🎉 **Website online dan otomatis update setiap push ke GitHub!**

---

**Last Updated**: January 2026  
**Repository**: https://github.com/rurururu01/hero-web
