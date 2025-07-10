<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERO - Data User</title>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @livewireStyles
    <style>
        :root {
            --primary-color: #FF1493;
            --secondary-color: #FFA500;
            --text-color: #333;
            --white: #fff;
            --purple: #4B0082;
            --green: #4CAF50;
            --orange: #FF5722;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: var(--secondary-color);
            padding: 2rem;
        }

        .container {
            background: var(--white);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--text-color);
            font-size: 2rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            color: var(--white);
        }

        .btn-orange {
            background-color: var(--orange);
        }

        .btn-orange:hover {
            background-color: #f4511e;
        }

        .btn-green {
            background-color: var(--green);
        }

        .btn-green:hover {
            background-color: #45a049;
        }

        /* Tab Navigation Styles */
        .tab-navigation {
            display: flex;
            background: var(--white);
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .tab-link {
            flex: 1;
            padding: 1rem 2rem;
            text-decoration: none;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
        }

        .tab-link.active {
            background-color: var(--purple);
            color: white;
        }

        .tab-link.inactive {
            background-color: #f8f9fa;
            color: var(--text-color);
        }

        .tab-link.inactive:hover {
            background-color: #e9ecef;
        }

        .header-with-tabs {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .header-with-tabs h1 {
            color: var(--text-color);
            font-size: 2rem;
        }        .header-with-tabs .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 0.75rem;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #333;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #f5f5f5;
        }

        .pagination .current {
            background-color: var(--purple);
            color: white;
            border-color: var(--purple);
        }

        .pagination .disabled {
            color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="header-with-tabs">
            <h1>Manajemen Data</h1>
            <div class="header-actions">
                <a href="{{ route('home') }}" class="btn btn-green">
                    <i class="fas fa-home mr-2"></i>Kembali ke Home
                </a>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <a href="{{ route('daftardata') }}" class="tab-link inactive">
                <i class="fas fa-utensils mr-2"></i>  Data Makanan
            </a>
            <a href="{{ route('users') }}" class="tab-link active">
                <i class="fas fa-users mr-2"></i>  Data User
            </a>
        </div>

        <!-- Livewire Table Component -->
        @livewire('data.user-table')
    </div>

    @livewireScripts
</body>
</html>
