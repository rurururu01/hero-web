<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERO - Makanan Surplus</title>
    <style>
        :root {
            --primary-color: #FF1493;
            --secondary-color: #FFA500;
            --text-color: #333;
            --white: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: var(--secondary-color);
        }

        .header {
            background: var(--white);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo img {
            height: 40px;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
            margin: 0 2rem;
        }

        .search-bar input {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 0.9rem;
        }        .user-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .user-welcome {
            color: var(--text-color);
            font-weight: 500;
            background-color: #e8f5e8;
            padding: 8px 16px;
            border-radius: 20px;
            border: 1px solid #4CAF50;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            background: none;
        }

        .success-notification {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            margin: 1rem 2rem;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            text-align: center;
        }

        .btn-primary {
            background-color: #4B0082;
            color: white;
            border: 2px solid #4B0082;
        }

        .btn-primary:hover {
            background-color: #3a006b;
            border-color: #3a006b;
        }

        .btn-outline {
            background-color: transparent;
            color: #4B0082;
            border: 2px solid #4B0082;
        }

        .btn-outline:hover {
            background-color: #4B0082;
            color: white;
        }
        .banner {
            position: relative;
            height: 300px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: var(--white);
        }

        .banner-content h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .features {
            padding: 2rem;
            text-align: center;
            background: var(--orange);
            margin: 2rem 0;
        }

        .features h2 {
            margin-bottom: 2rem;
            color: var(--text-color);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 10px;
            background: var(--white);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .feature-item img {
            width: 60px;
            height: 60px;
        }

        .restaurants {
            padding: 2rem;
            background: var(--white);
        }

        .restaurants h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: var(--text-color);
        }

        .restaurant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }        .restaurant-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .restaurant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .restaurant-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .restaurant-info {
            padding: 1rem;
        }

        .footer {
            background: #4B0082;
            color: var(--white);
            padding: 2rem;
            text-align: center;
        }

        .contact-info {
            margin-bottom: 2rem;
        }

        .app-download {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }        .app-download img {
            height: 40px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: var(--white);
            margin: 15% auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        .modal-icon {
            font-size: 3rem;
            color: #ff6b35;
            margin-bottom: 1rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .modal-message {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .modal-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .modal-btn-primary {
            background-color: #4B0082;
            color: white;
        }

        .modal-btn-primary:hover {
            background-color: #3a006b;
            transform: translateY(-1px);
        }

        .modal-btn-secondary {
            background-color: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
        }

        .modal-btn-secondary:hover {
            background-color: #e9ecef;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(-50px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>    <header class="header">
        <div class="logo">
            <img src="/images/logo.png" alt="HERO Logo">
            <h1>HERO</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search essentials, groceries and more...">
        </div>        <div class="user-actions">
            @auth
                <a href="{{ route('daftar-data') }}" class="btn btn-outline">Daftar Data</a>
            @else
                <button onclick="showLoginAlert()" class="btn btn-outline">Daftar Data</button>
            @endauth
            @auth
                <span class="user-welcome">Halo, {{ Auth::user()->name }}!</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline">Logout</button>
                </form>
            @else
                <a href="/login" class="btn btn-outline">Log In</a>
                <a href="/register" class="btn btn-outline">Sign Up</a>
            @endauth
        </div></header>

    @if(session('success'))
        <div class="success-notification">
            {{ session('success') }}
        </div>
    @endif

    <section class="banner">
        <img src="/images/buah.jpg" alt="Food Banner">
        <div class="banner-content">
            <h1>Lapar? Hero akan menghancurkan rasa laparmu!</h1>
        </div>
    </section>

    <section class="features">
        <h2>Yuk mulai pesan</h2>
        <div class="feature-grid">
            <div class="feature-item">
                <img src="/images/icons/resto_tredekat.png" alt="Terdekat">
                <span>Resto Terdekat</span>
            </div>
            <div class="feature-item">
                <img src="/images/icons/pesta_promo.png" alt="Promo">
                <span>Pesta Promo</span>
            </div>
            <div class="feature-item">
                <img src="/images/icons/masih_tersedia.png" alt="Tersedia">
                <span>Masih Tersedia</span>
            </div>
            <div class="feature-item">
                <img src="/images/icons/resto_juara.png" alt="Juara">
                <span>Resto Juara</span>
            </div>
            <div class="feature-item">
                <img src="/images/icons/sering_dikunjungi.png" alt="Dikunjungi">
                <span>Sering Dikunjungi</span>
            </div>
            <div class="feature-item">
                <img src="/images/icons/paling_dicari.png" alt="Dicari">
                <span>Paling Dicari</span>
            </div>
        </div>
    </section>

    <section class="restaurants">
        <h2>Kamu ingin makan apa?</h2>        <div class="restaurant-grid">
            <div class="restaurant-card">
                <a href="{{ route('resto', 'warteg-orens-bahari') }}" style="text-decoration: none; color: inherit;">
                    <img src="/images/restaurants/warteg.png" alt="Warteg Orens Bahari">
                    <div class="restaurant-info">
                        <h3>Warteg Orens Bahari - Tenggilis</h3>
                        <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">Klik untuk melihat menu</p>
                    </div>
                </a>
            </div>
            <div class="restaurant-card">
                <img src="/images/restaurants/bengis.png" alt="Bengis Kitchen">
                <div class="restaurant-info">
                    <h3>Bengis Kitchen - Kutisari</h3>
                </div>
            </div>
            <div class="restaurant-card">
                <img src="/images/restaurants/bube.png" alt="Bube x Heytato">
                <div class="restaurant-info">
                    <h3>Bube x Heytato - Rungkut</h3>
                </div>
            </div>
            <div class="restaurant-card">
                <img src="/images/restaurants/asia.png" alt="Bakso dan Mie Ayam Asia">
                <div class="restaurant-info">
                    <h3>Bakso dan Mie Ayam Asia Bangsa</h3>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="contact-info">
            <h3>Contact Us</h3>
            <p>WhatsApp: +62 896-9722-7557</p>
            <p>Call Us: +62 877-2439-7903</p>
        </div>
        <div class="app-download">
            <a href="#"><img src="/images/appstore.png" alt="Download on App Store"></a>
            <a href="#"><img src="/images/playstore.png" alt="Get it on Google Play"></a>
        </div>    </footer>

    <!-- Login Alert Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">🔒</div>
            <div class="modal-title">Login Diperlukan</div>
            <div class="modal-message">
                Login terlebih dahulu untuk manage data
            </div>
            <div class="modal-buttons">
                <a href="/login" class="modal-btn modal-btn-primary">Login Sekarang</a>
                <button onclick="closeModal()" class="modal-btn modal-btn-secondary">Batal</button>
            </div>
        </div>
    </div>

    <script>
        function showLoginAlert() {
            document.getElementById('loginModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeModal() {
            document.getElementById('loginModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('loginModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>