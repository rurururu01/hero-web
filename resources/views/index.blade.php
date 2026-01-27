<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERO - Makanan Surplus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo img {
            height: 45px;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4B0082;
        }

        .search-bar {
            flex: 1;
            max-width: 600px;
            margin: 0 2rem;
        }

        .search-bar input {
            width: 100%;
            padding: 0.75rem 1.25rem;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #4B0082;
            box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
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
            padding: 10px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            background: none;
            font-size: 0.95rem;
        }

        .success-notification {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            padding: 1rem 2rem;
            margin: 0;
            border: none;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(21, 87, 36, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4B0082 0%, #764ba2 100%);
            color: white;
            border: 2px solid transparent;
            box-shadow: 0 4px 12px rgba(75, 0, 130, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(75, 0, 130, 0.3);
        }

        .btn-outline {
            background-color: transparent;
            color: #4B0082;
            border: 2px solid #4B0082;
        }

        .btn-outline:hover {
            background: linear-gradient(135deg, #4B0082 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(75, 0, 130, 0.2);
        }
        .banner {
            position: relative;
            height: 320px;
            overflow: hidden;
            margin-bottom: 0;
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
            color: white;
            width: 90%;
            max-width: 800px;
        }

        .banner-content h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
            font-weight: bold;
            line-height: 1.2;
        }

        .features {
            padding: 3rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, #FFA500 0%, #FFB84D 100%);
            margin: 0;
        }

        .features h2 {
            margin-bottom: 2.5rem;
            color: #333;
            font-size: 2rem;
            font-weight: bold;
        }

        .filter-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-left: 1rem;
            font-weight: 500;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .feature-grid {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 1.5rem 2rem;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 160px;
            flex: 0 1 auto;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .feature-item.active {
            background: linear-gradient(135deg, #4B0082 0%, #764ba2 100%);
            color: white;
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 25px rgba(75, 0, 130, 0.3);
        }

        .feature-item img {
            width: 64px;
            height: 64px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .feature-item.active img {
            filter: brightness(0) invert(1) drop-shadow(0 2px 4px rgba(255,255,255,0.3));
        }

        .feature-item span {
            font-size: 0.95rem;
            font-weight: 600;
            color: #333;
            text-align: center;
        }

        .feature-item.active span {
            color: white;
        }

        .restaurants {
            padding: 3rem 2rem;
            background: #f8f9fa;
        }

        .restaurants h2 {
            text-align: center;
            margin-bottom: 2.5rem;
            color: #333;
            font-size: 2rem;
            font-weight: bold;
        }

        .restaurant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }        .restaurant-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            background: white;
            position: relative;
        }

        .restaurant-card::before {
            content: '👉 Klik untuk melihat menu';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #4B0082 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem;
            text-align: center;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            font-size: 0.9rem;
            font-weight: 600;
            z-index: 1;
        }

        .restaurant-card:hover::before {
            transform: translateY(0);
        }

        .restaurant-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(75, 0, 130, 0.15);
        }

        .restaurant-card:active {
            transform: translateY(-7px);
        }

        .restaurant-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .restaurant-card:hover img {
            transform: scale(1.08);
        }

        .restaurant-info {
            padding: 1.25rem;
            background: white;
        }

        .restaurant-info h3 {
            margin-bottom: 0.5rem;
            color: #4B0082;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .footer {
            background: linear-gradient(135deg, #4B0082 0%, #764ba2 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .contact-info {
            margin-bottom: 2rem;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .contact-info p {
            margin: 0.5rem 0;
            font-size: 1rem;
        }

        .app-download {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .app-download img {
            height: 45px;
            transition: transform 0.3s ease;
        }

        .app-download a:hover img {
            transform: scale(1.1);
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
            background-color: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            margin: 10% auto;
            padding: 2.5rem;
            border-radius: 20px;
            width: 90%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modal-icon {
            font-size: 4rem;
            color: #ff6b35;
            margin-bottom: 1.5rem;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .modal-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }

        .modal-message {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
            font-size: 1.05rem;
        }

        .modal-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .modal-btn {
            padding: 12px 28px;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .modal-btn-primary {
            background: linear-gradient(135deg, #4B0082 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(75, 0, 130, 0.3);
        }

        .modal-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(75, 0, 130, 0.4);
        }

        .modal-btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .modal-btn-secondary:hover {
            background: #e9ecef;
            border-color: #ccc;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .feature-grid {
                gap: 1rem;
            }

            .feature-item {
                min-width: 140px;
                padding: 1.25rem 1.5rem;
            }

            .feature-item img {
                width: 56px;
                height: 56px;
            }

            .banner-content h1 {
                font-size: 1.75rem;
            }

            .restaurant-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .header {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .search-bar {
                order: 3;
                width: 100%;
                max-width: 100%;
                margin: 0;
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
            <input type="text" id="searchInput" placeholder="Search essentials, groceries and more..." oninput="searchRestaurants()">
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
            <div class="feature-item" onclick="filterRestaurants('terdekat')" style="cursor: pointer; transition: transform 0.3s;">
                <img src="/images/icons/resto_tredekat.png" alt="Terdekat">
                <span>Resto Terdekat</span>
            </div>
            <div class="feature-item" onclick="filterRestaurants('promo')" style="cursor: pointer; transition: transform 0.3s;">
                <img src="/images/icons/pesta_promo.png" alt="Promo">
                <span>Pesta Promo</span>
            </div>
            <div class="feature-item" onclick="filterRestaurants('tersedia')" style="cursor: pointer; transition: transform 0.3s;">
                <img src="/images/icons/masih_tersedia.png" alt="Tersedia">
                <span>Masih Tersedia</span>
            </div>
            <div class="feature-item" onclick="filterRestaurants('juara')" style="cursor: pointer; transition: transform 0.3s;">
                <img src="/images/icons/resto_juara.png" alt="Juara">
                <span>Resto Juara</span>
            </div>
            <div class="feature-item" onclick="filterRestaurants('sering')" style="cursor: pointer; transition: transform 0.3s;">
                <img src="/images/icons/sering_dikunjungi.png" alt="Dikunjungi">
                <span>Sering Dikunjungi</span>
            </div>
            <div class="feature-item" onclick="filterRestaurants('dicari')" style="cursor: pointer; transition: transform 0.3s;">
                <img src="/images/icons/paling_dicari.png" alt="Dicari">
                <span>Paling Dicari</span>
            </div>
        </div>
    </section>

    <section class="restaurants">
        <h2 id="restaurantTitle">Kamu ingin makan apa?</h2>
        <div class="restaurant-grid" id="restaurantGrid">
            <div class="restaurant-card" 
                 data-category="terdekat,juara,sering,dicari" 
                 data-promo="true" 
                 data-tersedia="true"
                 data-rating="4.5" 
                 data-name="warteg orens bahari tenggilis"
                 onclick="window.location.href='{{ route('resto', 'warteg-orens-bahari') }}'">
                <img src="/images/restaurants/warteg.png" alt="Warteg Orens Bahari">
                <div class="restaurant-info">
                    <h3>Warteg Orens Bahari - Tenggilis</h3>
                    <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">⭐ 4.5 | 📍 Terdekat</p>
                    <p style="color: #ff6b35; font-size: 0.85rem; font-weight: 500; margin-top: 0.25rem;">🔥 Promo 20%</p>
                </div>
            </div>
            <div class="restaurant-card" 
                 data-category="terdekat,tersedia" 
                 data-promo="false" 
                 data-tersedia="true"
                 data-rating="4.3" 
                 data-name="bengis kitchen kutisari"
                 onclick="window.location.href='{{ route('resto', 'bengis-kitchen') }}'">
                <img src="/images/restaurants/bengis.png" alt="Bengis Kitchen">
                <div class="restaurant-info">
                    <h3>Bengis Kitchen - Kutisari</h3>
                    <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">⭐ 4.3 | 📍 Kutisari</p>
                    <p style="color: #4CAF50; font-size: 0.85rem; font-weight: 500; margin-top: 0.25rem;">✅ Masih Tersedia</p>
                </div>
            </div>
            <div class="restaurant-card" 
                 data-category="juara,sering,dicari" 
                 data-promo="true" 
                 data-tersedia="true"
                 data-rating="4.7" 
                 data-name="bube heytato rungkut"
                 onclick="window.location.href='{{ route('resto', 'bube-heytato') }}'">
                <img src="/images/restaurants/bube.png" alt="Bube x Heytato">
                <div class="restaurant-info">
                    <h3>Bube x Heytato - Rungkut</h3>
                    <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">⭐ 4.7 | 🏆 Juara</p>
                    <p style="color: #ff6b35; font-size: 0.85rem; font-weight: 500; margin-top: 0.25rem;">🔥 Promo 15%</p>
                </div>
            </div>
            <div class="restaurant-card" 
                 data-category="terdekat,juara,tersedia,sering" 
                 data-promo="false" 
                 data-tersedia="true"
                 data-rating="4.6" 
                 data-name="bakso mie ayam asia bangsa"
                 onclick="window.location.href='{{ route('resto', 'bakso-asia') }}'">
                <img src="/images/restaurants/asia.png" alt="Bakso dan Mie Ayam Asia">
                <div class="restaurant-info">
                    <h3>Bakso dan Mie Ayam Asia Bangsa</h3>
                    <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">⭐ 4.6 | 🔥 Sering Dikunjungi</p>
                    <p style="color: #4CAF50; font-size: 0.85rem; font-weight: 500; margin-top: 0.25rem;">✅ Masih Tersedia</p>
                </div>
            </div>
        </div>
        <div id="noResults" style="display: none; text-align: center; padding: 4rem 2rem; background: white; border-radius: 20px; margin: 2rem auto; max-width: 600px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
            <p style="font-size: 3rem; margin-bottom: 1rem;">😔</p>
            <p style="font-size: 1.3rem; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Tidak ada restoran ditemukan</p>
            <p style="font-size: 1rem; color: #666; margin-bottom: 1.5rem;">Coba filter lain atau reset pencarian</p>
            <button onclick="resetFilter()" class="btn btn-primary" style="margin-top: 1rem; padding: 12px 32px;">
                <i class="fas fa-redo-alt" style="margin-right: 8px;"></i>Reset Filter
            </button>
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
        let currentFilter = 'all';

        function filterRestaurants(filter) {
            currentFilter = filter;
            const cards = document.querySelectorAll('.restaurant-card');
            const title = document.getElementById('restaurantTitle');
            const noResults = document.getElementById('noResults');
            const restaurantGrid = document.getElementById('restaurantGrid');
            let visibleCount = 0;

            // Update title based on filter with badge
            const filterTitles = {
                'terdekat': 'Resto Terdekat 📍',
                'promo': 'Pesta Promo 🎉',
                'tersedia': 'Masih Tersedia ✅',
                'juara': 'Resto Juara ⭐',
                'sering': 'Sering Dikunjungi 🔥',
                'dicari': 'Paling Dicari 🔍',
                'all': 'Kamu ingin makan apa?'
            };
            
            // Remove existing badge
            const existingBadge = title.querySelector('.filter-badge');
            if (existingBadge) {
                existingBadge.remove();
            }
            
            // Set title and add active badge for non-all filters
            if (filter !== 'all') {
                title.innerHTML = filterTitles[filter] + ' <span class="filter-badge">Filter Aktif</span>';
            } else {
                title.textContent = filterTitles[filter];
            }

            // Update feature items styling - remove all active classes first
            document.querySelectorAll('.feature-item').forEach(item => {
                item.classList.remove('active');
                item.style.transform = 'scale(1)';
            });
            
            // Add active class to clicked item
            if (event && event.currentTarget) {
                event.currentTarget.classList.add('active');
            }

            // Filter cards with improved logic
            cards.forEach(card => {
                let shouldShow = false;
                
                if (filter === 'all') {
                    shouldShow = true;
                } else if (filter === 'promo') {
                    // Check data-promo attribute
                    shouldShow = card.getAttribute('data-promo') === 'true';
                } else if (filter === 'tersedia') {
                    // Check data-tersedia attribute
                    shouldShow = card.getAttribute('data-tersedia') === 'true';
                } else {
                    // Check if filter is in data-category (comma separated)
                    const categories = card.getAttribute('data-category');
                    shouldShow = categories && categories.split(',').includes(filter);
                }
                
                // Apply search filter if active
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                if (shouldShow && searchTerm) {
                    const cardName = card.getAttribute('data-name') || '';
                    const cardText = card.textContent.toLowerCase();
                    shouldShow = cardName.includes(searchTerm) || cardText.includes(searchTerm);
                }
                
                if (shouldShow) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCount === 0) {
                restaurantGrid.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                restaurantGrid.style.display = 'grid';
                noResults.style.display = 'none';
            }

            // Smooth scroll to restaurants section
            document.querySelector('.restaurants').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function resetFilter() {
            currentFilter = 'all';
            document.getElementById('searchInput').value = '';
            const cards = document.querySelectorAll('.restaurant-card');
            const title = document.getElementById('restaurantTitle');
            const noResults = document.getElementById('noResults');
            const restaurantGrid = document.getElementById('restaurantGrid');

            title.textContent = 'Kamu ingin makan apa?';
            cards.forEach(card => {
                card.style.display = 'block';
            });

            restaurantGrid.style.display = 'grid';
            noResults.style.display = 'none';

            // Reset feature items styling
            document.querySelectorAll('.feature-item').forEach(item => {
                item.classList.remove('active');
                item.style.transform = 'scale(1)';
            });
        }

        function searchRestaurants() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.restaurant-card');
            const noResults = document.getElementById('noResults');
            const restaurantGrid = document.getElementById('restaurantGrid');
            const title = document.getElementById('restaurantTitle');
            let visibleCount = 0;

            cards.forEach(card => {
                let shouldShow = false;
                
                // First check if card matches current filter
                if (currentFilter === 'all') {
                    shouldShow = true;
                } else if (currentFilter === 'promo') {
                    shouldShow = card.getAttribute('data-promo') === 'true';
                } else if (currentFilter === 'tersedia') {
                    shouldShow = card.getAttribute('data-tersedia') === 'true';
                } else {
                    const categories = card.getAttribute('data-category');
                    shouldShow = categories && categories.split(',').includes(currentFilter);
                }
                
                // Then apply search filter
                if (shouldShow && searchTerm) {
                    const cardName = card.getAttribute('data-name') || '';
                    const cardText = card.textContent.toLowerCase();
                    shouldShow = cardName.includes(searchTerm) || cardText.includes(searchTerm);
                }
                
                if (shouldShow) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update title with search info
            if (searchTerm) {
                const filterTitles = {
                    'terdekat': 'Resto Terdekat 📍',
                    'promo': 'Pesta Promo 🎉',
                    'tersedia': 'Masih Tersedia ✅',
                    'juara': 'Resto Juara ⭐',
                    'sering': 'Sering Dikunjungi 🔥',
                    'dicari': 'Paling Dicari 🔍'
                };
                const baseTitle = currentFilter !== 'all' ? filterTitles[currentFilter] : 'Pencarian';
                title.innerHTML = `${baseTitle}: "${searchTerm}" <span class="filter-badge">${visibleCount} hasil</span>`;
            } else if (currentFilter === 'all') {
                title.textContent = 'Kamu ingin makan apa?';
            }

            // Show/hide no results message
            if (visibleCount === 0) {
                restaurantGrid.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                restaurantGrid.style.display = 'grid';
                noResults.style.display = 'none';
            }
        }

        function showLoginAlert() {
            document.getElementById('loginModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('loginModal').style.display = 'none';
            document.body.style.overflow = 'auto';
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

        // Add hover effect to feature items
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.feature-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'scale(1.05)';
                    }
                });
                item.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'scale(1)';
                    }
                });
            });

            // Add fade in animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>