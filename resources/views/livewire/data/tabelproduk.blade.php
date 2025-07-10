<div>
    <!-- Search Container -->
    <div class="search-container">
        <div class="search-form">
            <div class="search-box">
                <img src="{{ asset('images/icons/paling_dicari.png') }}" alt="Search Icon" class="search-icon">
                <input type="text" 
                       wire:model.live="search" 
                       placeholder="Cari Data Makanan" 
                       class="search-input">
            </div>
            @if($search || $filter != 'semua')
                <button wire:click="resetFilters" class="reset-btn">Reset</button>
            @endif
        </div>
    </div>    <!-- Filter Section -->
    <div class="filter-section" style="margin-bottom: 1rem;">
        <div class="filter-container">
            <select wire:model.live="filter" class="filter-select">
                <option value="semua">Semua</option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="stok_sedikit">Stok Sedikit</option>
                <option value="kadaluarsa_dekat">Kadaluarsa Dekat</option>
                <option value="harga_murah">Harga Murah</option>
            </select>
            <a href="{{ route('grafik') }}" class="grafik-btn">
                <img src="{{ asset('images/icons/grafik.svg') }}" alt="Grafik Icon" class="grafik-icon">
                Lihat Grafik
            </a>
        </div>
    </div>

    <!-- Active Filters Indicator -->
    @if($filter && $filter != 'semua')
        <div class="active-filters">
            <span style="color: #666; font-size: 0.9rem;">Filter aktif:</span>
            <span class="filter-indicator">
                @switch($filter)
                    @case('makanan')
                        Jenis: Makanan
                        @break
                    @case('minuman')
                        Jenis: Minuman
                        @break
                    @case('stok_sedikit')
                        Stok Paling Sedikit
                        @break
                    @case('kadaluarsa_dekat')
                        Kadaluarsa Terdekat
                        @break
                    @case('harga_murah')
                        Harga Paling Murah
                        @break
                    @default
                        {{ $filter }}
                @endswitch
            </span>
        </div>
    @endif    <!-- Loading indicator -->
    <div wire:loading.delay class="loading-indicator" style="text-align: center; margin: 1rem 0; color: #666; font-style: italic; opacity: 0.7;">
        <span>Memuat data...</span>
    </div>

    <!-- Table Container with loading overlay -->
    <div wire:loading.class="loading-overlay" style="position: relative;">
        <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Stok</th>
                <th>Tgl Kadaluarsa</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($makanan as $item)
                <tr wire:key="makanan-{{ $item->id }}">
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ ucfirst($item->jenis_barang) }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->tanggal_kadaluarsa->format('d/m/Y') }}</td>
                    <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('editdata', $item->id) }}" class="btn btn-small" style="background-color:rgb(31, 208, 122); text-decoration: none;">Edit</a>
                            <button wire:click="confirmDelete({{ $item->id }}, '{{ $item->nama_barang }}')" 
                                    class="btn btn-small" 
                                    style="background-color: #dc3545;"
                                    wire:loading.attr="disabled"
                                    wire:target="confirmDelete({{ $item->id }}, '{{ $item->nama_barang }}')">
                                <span wire:loading.remove wire:target="confirmDelete({{ $item->id }}, '{{ $item->nama_barang }}')">Hapus</span>
                                <span wire:loading wire:target="confirmDelete({{ $item->id }}, '{{ $item->nama_barang }}')">Loading...</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #666;">
                        @if($search)
                            Tidak ada data yang ditemukan untuk pencarian "{{ $search }}"
                        @else
                            Belum ada data makanan
                        @endif
                    </td>
                </tr>
            @endforelse        </tbody>
    </table>
    </div><!-- Pagination -->
    @if($makanan->hasPages())
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($makanan->onFirstPage())
                <span class="disabled">« Sebelumnya</span>
            @else
                <button wire:click="previousPage" class="pagination-btn">« Sebelumnya</button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($makanan->getUrlRange(1, $makanan->lastPage()) as $page => $url)
                @if ($page == $makanan->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="pagination-btn">{{ $page }}</button>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($makanan->hasMorePages())
                <button wire:click="nextPage" class="pagination-btn">Selanjutnya »</button>
            @else
                <span class="disabled">Selanjutnya »</span>
            @endif
        </div>

        <!-- Pagination Info -->
        <div style="text-align: center; margin-top: 1rem; color: #666; font-size: 0.9rem;">
            Menampilkan {{ $makanan->firstItem() }} - {{ $makanan->lastItem() }} dari {{ $makanan->total() }} data
        </div>
    @endif

    <!-- Loading indicator -->
    <div wire:loading class="loading-indicator" style="text-align: center; margin: 1rem 0; color: #666;">
        <span>Memuat data...</span>
    </div>

    <style>
    .search-container {
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
        border: none;
        cursor: pointer;
    }

    .reset-btn:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .filter-section {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 1rem;
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.9rem;
        background-color: white;
        cursor: pointer;
        min-width: 120px;
    }

    .filter-select:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
    }

    .filter-indicator {
        display: inline-block;
        background-color: #4B0082;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        margin-left: 1rem;
        font-weight: 500;
    }    .active-filters {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .filter-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .grafik-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(255, 107, 53, 0.3);
        border: none;
    }

    .grafik-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(255, 107, 53, 0.4);
        color: white;
        text-decoration: none;
    }

    .grafik-icon {
        width: 16px;
        height: 16px;
        filter: brightness(0) invert(1);
    }

    .loading-indicator {
        opacity: 0.7;
        font-style: italic;
    }

    .loading-overlay {
        opacity: 0.5;
        pointer-events: none;
    }

    .loading-overlay::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 10;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn {
        padding: 8px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        color: white;
    }

    .btn-small {
        padding: 5px 10px;
        font-size: 0.8rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    th {
        background-color: #4B0082;
        color: white;
        padding: 1rem;
        text-align: left;
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
        gap: 0.5rem;
    }

    .pagination-btn {
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        border: 1px solid #ddd;
        color: #333;
        border-radius: 4px;
        background: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .pagination-btn:hover {
        background-color: #f5f5f5;
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
    }    .pagination .current {
        background-color: #4B0082;
        color: white;
        border-color: #4B0082;
    }

    .pagination .disabled {
        color: #ccc;
        cursor: not-allowed;
    }
    </style>
</div>
