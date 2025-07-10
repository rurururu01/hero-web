<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title>HERO - Daftar Data Barang</title>
    
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
        }        select {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
            background-color: white;
            cursor: pointer;
            min-width: 120px;
        }

        select:focus {
            outline: none;
            border-color: var(--green);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th {
            background-color: var(--purple);
            color: var(--white);
            padding: 1rem;
            text-align: left;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }        .btn-small {
            padding: 5px 10px;
            font-size: 0.8rem;
        }        .delete-form {
            display: inline;
        }        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 1rem;
            justify-content: center;
            width: 100%;
            max-width: 600px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 0.75rem 1.25rem;
            flex-grow: 1;
            max-width: 400px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .search-icon {
            width: 20px;
            height: 20px;
            margin-right: 0.75rem;
            opacity: 0.6;
        }

        .search-input {
            border: none;
            outline: none;
            flex-grow: 1;
            font-size: 1rem;
            padding: 0.25rem 0;
            color: #333;
        }

        .search-input::placeholder {
            color: #999;
            font-size: 0.95rem;
        }

        .search-btn {
            background-color: var(--green);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .search-btn:hover {
            background-color: #45a049;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .reset-btn {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }        .reset-btn:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .filter-indicator {
            display: inline-block;
            background-color: var(--purple);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            margin-left: 1rem;
            font-weight: 500;
        }

        .active-filters {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

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
        }        .pagination .disabled {
            color: #ccc;
            cursor: not-allowed;
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
        }

        .header-with-tabs .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
    </style>
</head>
<body><div class="container">
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="header-with-tabs">
            <h1>Manajemen Data</h1>
            <div class="header-actions">
                <a href="{{ route('home') }}" class="btn btn-green">Kembali ke Home</a>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <a href="{{ route('daftardata') }}" class="tab-link active">
                <i class="fas fa-utensils mr-2"></i> Data Makanan
            </a>
            <a href="{{ route('users') }}" class="tab-link inactive">
                <i class="fas fa-users mr-2"></i> Data User
            </a>
        </div>

        <!-- Action Button for Current Tab -->
        <div style="text-align: right; margin-bottom: 1.5rem;">
            <a href="{{ url('/tambahdata') }}" class="btn btn-orange">
                <i class="fas fa-plus mr-2"></i>Tambah Data Makanan
            </a>
        </div>

        <!-- Livewire Table Component -->
        @livewire('data.tabel-produk')
    </div>@livewireScripts
    <script>
        // Listen for delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('confirm-delete', (event) => {
                console.log('Delete confirmation received:', event);
                if (confirm(event.message)) {
                    Livewire.dispatch('deleteMakanan', { id: event.id });
                }
            });

            // Listen for success messages
            Livewire.on('item-deleted', (event) => {
                console.log('Item deleted:', event.message);
                // Optionally show a success notification
                if (event.message) {
                    alert(event.message);
                }
            });
        });
    </script>