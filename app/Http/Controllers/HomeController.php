<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;

class HomeController extends Controller
{    /**
     * Display the data list page.
     *
     * @return \Illuminate\Contracts\View\View
     */    public function daftarData()
    {
        // The Livewire component will handle all data fetching, filtering, and pagination
        return view('daftardata');
    }

    /**
     * Store new food data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_surplus' => 'required|string|max:255',
            'jenis_surplus' => 'required|string|in:makanan,minuman',
            'stok' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date|after:today',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        Makanan::create([
            'nama_barang' => $request->nama_surplus,
            'jenis_barang' => $request->jenis_surplus,
            'stok' => $request->stok,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('daftardata')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified food data.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $makanan = Makanan::findOrFail($id);
        return view('editdata', compact('makanan'));
    }

    /**
     * Update the specified food data in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $makanan = Makanan::findOrFail($id);

        $request->validate([
            'nama_surplus' => 'required|string|max:255',
            'jenis_surplus' => 'required|string|in:makanan,minuman',
            'stok' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $makanan->update([
            'nama_barang' => $request->nama_surplus,
            'jenis_barang' => $request->jenis_surplus,
            'stok' => $request->stok,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('daftardata')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified food data from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $makanan = Makanan::findOrFail($id);
        $makanan->delete();        return redirect()->route('daftardata')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Display the grafik page with chart data.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function grafik()
    {
        // Get total stock by type
        $totalMakanan = Makanan::where('jenis_barang', 'makanan')->sum('stok');
        $totalMinuman = Makanan::where('jenis_barang', 'minuman')->sum('stok');
        
        // Get detailed breakdown for better visualization
        $detailMakanan = Makanan::where('jenis_barang', 'makanan')
                               ->selectRaw('nama_barang, stok')
                               ->orderBy('stok', 'desc')
                               ->get();
        
        $detailMinuman = Makanan::where('jenis_barang', 'minuman')
                               ->selectRaw('nama_barang, stok')
                               ->orderBy('stok', 'desc')
                               ->get();        return view('grafik', compact('totalMakanan', 'totalMinuman', 'detailMakanan', 'detailMinuman'));
    }

    /**
     * Display the resto page with available food items.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function resto($slug)
    {
        // Define available restaurants
        $restaurants = [
            'warteg-orens-bahari' => [
                'name' => 'Warteg Orens Bahari - Tenggilis',
                'description' => 'Warteg terbaik di Tenggilis dengan berbagai pilihan makanan dan minuman segar',
                'image' => '/images/restaurants/warteg.png',
                'location' => 'Tenggilis, Surabaya',
                'phone' => '+62 896-9722-7557',
                'rating' => 4.5
            ]
        ];

        // Check if restaurant exists
        if (!isset($restaurants[$slug])) {
            abort(404);
        }

        $restaurant = $restaurants[$slug];

        // Get available food items from database
        $makananItems = Makanan::where('jenis_barang', 'makanan')
                              ->where('stok', '>', 0)
                              ->orderBy('nama_barang')
                              ->get();

        $minumanItems = Makanan::where('jenis_barang', 'minuman')
                              ->where('stok', '>', 0)
                              ->orderBy('nama_barang')
                              ->get();

        return view('resto', compact('restaurant', 'makananItems', 'minumanItems'));
    }
}
