<div>
    <!-- Add User Button -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
        <button wire:click="createUser" 
                style="background-color: #FF5722; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: 500; transition: all 0.3s ease;">
            <i class="fas fa-plus" style="margin-right: 8px;"></i>Tambah User Baru
        </button>
    </div>

    <!-- Search Container -->
    <div class="search-container">
        <div class="search-form">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" 
                       wire:model.live="search" 
                       placeholder="Cari User berdasarkan nama atau email" 
                       class="search-input"
                       style="padding-left: 40px;">
            </div>
            @if($search)
                <button wire:click="$set('search', '')" class="reset-btn">Reset</button>
            @endif
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem; border: 1px solid #c3e6cb; position: relative;">
            {{ session('message') }}
            <span style="position: absolute; top: 5px; right: 10px; cursor: pointer; font-size: 18px;" onclick="this.parentElement.style.display='none';">
                <i class="fas fa-times"></i>
            </span>
        </div>
    @endif

    <!-- Table Container -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #4B0082; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 10px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <button wire:click="editUser({{ $user->id }})" 
                                        class="btn-edit" 
                                        title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="deleteUser({{ $user->id }})" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                        class="btn-delete" 
                                        title="Hapus User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 2rem; color: #666;">
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <i class="fas fa-users" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                                <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">Tidak ada user ditemukan</p>
                                <p style="font-size: 0.9rem; color: #999;">Mulai dengan menambahkan user baru</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($users->onFirstPage())
                <span class="disabled">« Sebelumnya</span>
            @else
                <button wire:click="previousPage" class="pagination-btn">« Sebelumnya</button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if ($page == $users->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="pagination-btn">{{ $page }}</button>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($users->hasMorePages())
                <button wire:click="nextPage" class="pagination-btn">Selanjutnya »</button>
            @else
                <span class="disabled">Selanjutnya »</span>
            @endif
        </div>

        <!-- Pagination Info -->
        <div style="text-align: center; margin-top: 1rem; color: #666; font-size: 0.9rem;">
            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data
        </div>
    @endif

    <!-- Modal -->
    @if($showModal)
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
            <div style="background: white; border-radius: 10px; padding: 2rem; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto;">
                <!-- Modal Header -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #eee;">
                    <h3 style="font-size: 1.5rem; font-weight: 600; color: #333; margin: 0;">
                        {{ $editMode ? 'Edit User' : 'Tambah User Baru' }}
                    </h3>
                    <button wire:click="closeModal" 
                            style="background: none; border: none; font-size: 1.5rem; color: #999; cursor: pointer; padding: 5px;"
                            onmouseover="this.style.color='#666'" 
                            onmouseout="this.style.color='#999'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Modal Form -->
                <form wire:submit.prevent="save">
                    <!-- Name Field -->
                    <div style="margin-bottom: 1rem;">
                        <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #333;">Nama</label>
                        <input type="text" 
                               wire:model="name" 
                               id="name"
                               class="@if($errors->has('name')) input-error @else input-normal @endif"
                               placeholder="Masukkan nama user">
                        @if($errors->has('name'))
                            <p style="margin-top: 0.25rem; color: #dc3545; font-size: 0.875rem;">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <!-- Email Field -->
                    <div style="margin-bottom: 1rem;">
                        <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #333;">Email</label>
                        <input type="email" 
                               wire:model="email" 
                               id="email"
                               class="@if($errors->has('email')) input-error @else input-normal @endif"
                               placeholder="Masukkan email user">
                        @if($errors->has('email'))
                            <p style="margin-top: 0.25rem; color: #dc3545; font-size: 0.875rem;">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #333;">
                            Password {{ $editMode ? '(kosongkan jika tidak ingin mengubah)' : '' }}
                        </label>
                        <input type="password" 
                               wire:model="password" 
                               id="password"
                               class="@if($errors->has('password')) input-error @else input-normal @endif"
                               placeholder="Masukkan password">
                        @if($errors->has('password'))
                            <p style="margin-top: 0.25rem; color: #dc3545; font-size: 0.875rem;">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <!-- Modal Footer -->
                    <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                        <button type="button" 
                                wire:click="closeModal"
                                style="padding: 0.75rem 1.5rem; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: 500; transition: all 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#5a6268'" 
                                onmouseout="this.style.backgroundColor='#6c757d'">
                            Batal
                        </button>
                        <button type="submit" 
                                wire:loading.attr="disabled"
                                style="padding: 0.75rem 1.5rem; background-color: #FF5722; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: 500; transition: all 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#f4511e'" 
                                onmouseout="this.style.backgroundColor='#FF5722'">
                            <span wire:loading.remove>{{ $editMode ? 'Update' : 'Simpan' }}</span>
                            <span wire:loading>Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <style>
        .search-container {
            margin-bottom: 1rem;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-box {
            position: relative;
            flex: 1;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 1rem;
        }

        .search-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #FF5722;
            box-shadow: 0 0 5px rgba(255, 87, 34, 0.3);
        }

        .reset-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .reset-btn:hover {
            background-color: #5a6268;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .data-table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: top;
        }

        .data-table tr:hover {
            background-color: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background-color: #4B0082;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #6a0dad;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .input-normal {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .input-error {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #dc3545;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Pagination Styles */
        .pagination {
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
            background-color: white;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .pagination-btn:hover {
            background-color: #f5f5f5;
        }

        .pagination .current {
            padding: 0.5rem 0.75rem;
            background-color: #4B0082;
            color: white;
            border: 1px solid #4B0082;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .pagination .disabled {
            padding: 0.5rem 0.75rem;
            color: #ccc;
            cursor: not-allowed;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</div>
