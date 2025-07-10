<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Surplus</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-hero-orange min-h-screen py-8">
    <div class="container mx-auto max-w-4xl px-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-white px-8 py-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Hero Logo" class="h-12 w-12 mr-4">
                        <h1 class="text-2xl font-semibold text-gray-700">Edit Data Surplus</h1>
                    </div>
                    <a href="{{ url('/daftardata') }}" class="bg-hero-green hover:bg-green-600 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-6">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('editdata.update', $makanan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="nama_surplus" class="block text-gray-700 text-sm font-medium mb-2">Nama Surplus:</label>
                        <input type="text" id="nama_surplus" name="nama_surplus" 
                               value="{{ old('nama_surplus', $makanan->nama_barang) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors" 
                               required>
                    </div>

                    <div>
                        <label for="jenis_surplus" class="block text-gray-700 text-sm font-medium mb-2">Jenis Surplus:</label>
                        <select id="jenis_surplus" name="jenis_surplus" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors appearance-none bg-white" 
                                required>
                            <option value="" disabled>Pilih jenis surplus</option>
                            <option value="makanan" {{ old('jenis_surplus', $makanan->jenis_barang) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="minuman" {{ old('jenis_surplus', $makanan->jenis_barang) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                        </select>
                    </div>

                    <div>
                        <label for="stok" class="block text-gray-700 text-sm font-medium mb-2">Stok:</label>
                        <input type="number" id="stok" name="stok" 
                               value="{{ old('stok', $makanan->stok) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors" 
                               required>
                    </div>

                    <div>
                        <label for="tanggal_kadaluarsa" class="block text-gray-700 text-sm font-medium mb-2">Tanggal Kadaluarsa:</label>
                        <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" 
                               value="{{ old('tanggal_kadaluarsa', $makanan->tanggal_kadaluarsa->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors" 
                               required>
                    </div>

                    <div>
                        <label for="harga_beli" class="block text-gray-700 text-sm font-medium mb-2">Harga Beli:</label>
                        <input type="number" id="harga_beli" name="harga_beli" step="0.01" 
                               value="{{ old('harga_beli', $makanan->harga_beli) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors" 
                               required>
                    </div>

                    <div>
                        <label for="harga_jual" class="block text-gray-700 text-sm font-medium mb-2">Harga Jual:</label>
                        <input type="number" id="harga_jual" name="harga_jual" step="0.01" 
                               value="{{ old('harga_jual', $makanan->harga_jual) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors" 
                               required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="bg-hero-green hover:bg-green-600 text-white font-medium py-3 px-8 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
