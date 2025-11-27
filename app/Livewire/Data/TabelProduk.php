<?php

namespace App\Livewire\Data;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Makanan;
use Illuminate\Support\Facades\Log;

class TabelProduk extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'semua';

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteMakanan' => 'deleteMakanan'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filter = 'semua';
        $this->resetPage();
    }

    public function confirmDelete($id, $nama)
    {
        $this->dispatch('confirm-delete', 
            title: 'Konfirmasi Hapus',
            message: "Apakah Anda yakin ingin menghapus data '{$nama}'?",
            id: $id
        );
    }

    #[On('deleteMakanan')]
    public function deleteMakanan($id)
    {
        try {
            $makanan = Makanan::findOrFail($id);
            $nama = $makanan->nama_barang;
            $makanan->delete();
            $this->dispatch('item-deleted', message: "Data '{$nama}' berhasil dihapus!");
            $this->resetPage();
        } catch (\Exception $e) {
            Log::error('Error deleting makanan: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function render()
    {
        $query = Makanan::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama_barang', 'like', '%' . $this->search . '%')
                  ->orWhere('jenis_barang', 'like', '%' . $this->search . '%');
            });
        }

        switch ($this->filter) {
            case 'makanan':
                $query->where('jenis_barang', 'makanan');
                break;
            case 'minuman':
                $query->where('jenis_barang', 'minuman');
                break;
            case 'stok_sedikit':
                $query->orderBy('stok', 'asc');
                break;
            case 'kadaluarsa_dekat':
                $query->orderBy('tanggal_kadaluarsa', 'asc');
                break;
            case 'harga_murah':
                $query->orderBy('harga_jual', 'asc');
                break;
            case 'semua':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $makanan = $query->paginate(5);

        return view('livewire.data.tabelproduk', compact('makanan'));
    }
}
