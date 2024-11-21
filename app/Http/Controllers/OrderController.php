<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toko;
use App\Models\Ekspedisi;
use App\Models\Buku;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()
    {
        $orders = Order::with('toko', 'ekspedisi', 'bukus')->get(); // Mengambil data order beserta toko dan buku terkait
        $tokos = Toko::where('is_active', 1)->get(); // Ambil hanya toko yang aktif
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all();
        return view('orders.index', compact('orders', 'tokos', 'ekspedisis', 'bukus'));
    }

    // Menampilkan form untuk membuat order baru
    public function create()
    {
        $tokos = Toko::where('is_active', 1)->get();
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all(); // Mengambil semua buku untuk pilihan
        return view('orders.create', compact('tokos', 'ekspedisis', 'bukus'));
    }

    // Menyimpan order baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_hp' => 'required|string',
            'kode_booking' => 'nullable|string|max:255|unique:orders,kode_booking',
            'toko_id' => 'required|exists:tokos,id',
            'ekspedisi_id' => 'required|exists:ekspedisis,id',
            'asal_penjualan' => 'required|string',
            'penerima' => 'required|string',
            'no_hp_penerima' => 'required|string',
            'alamat_kirim' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'catatan' => 'nullable|string',
            'total_berat' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'bukus' => 'required|array', // Validasi untuk daftar buku
            'bukus.*.id' => 'required|exists:bukus,id', // Validasi untuk setiap buku
            'bukus.*.jumlah' => 'required|numeric|min:1', // Jumlah minimal 1
        ]);

        // Periksa apakah toko yang dipilih aktif
        $toko = Toko::find($request->toko_id);
        if (!$toko || !$toko->is_active) {
            return redirect()->back()->withErrors(['toko_id' => 'Toko yang dipilih tidak aktif.']);
        }

        // Simpan order
        $order = Order::create($request->except('bukus')); // Simpan order tanpa data buku

        // Simpan data buku ke tabel pivot
        foreach ($request->bukus as $buku) {
            $order->bukus()->attach($buku['id'], ['jumlah' => $buku['jumlah']]);
        }

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

      // Menampilkan form untuk mengedit order yang sudah ada
    public function edit(Order $order)
    {
        $tokos = Toko::where('is_active', 1)->get();
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all(); // Ambil semua buku untuk pilihan

        // Ambil buku yang sudah dipilih beserta jumlahnya
        $selectedBukus = $order->bukus->map(function ($buku) {
            return [
                'id' => $buku->id,
                'jumlah' => $buku->pivot->jumlah,  // mengambil jumlah dari pivot
            ];
        });

        return view('orders.edit', compact('order', 'tokos', 'ekspedisis', 'bukus', 'selectedBukus'));
    }

    // Memperbarui data order yang sudah ada
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_hp' => 'required|string',
            'kode_booking' => 'nullable|string|max:255|unique:orders,kode_booking,' . $order->id,
            'toko_id' => 'required|exists:tokos,id',
            'ekspedisi_id' => 'required|exists:ekspedisis,id',
            'asal_penjualan' => 'required|string',
            'penerima' => 'required|string',
            'no_hp_penerima' => 'required|string',
            'alamat_kirim' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'catatan' => 'nullable|string',
            'total_berat' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'bukus' => 'required|array',
            'bukus.*.id' => 'required|exists:bukus,id',
            'bukus.*.jumlah' => 'required|numeric|min:1',
        ]);

        // Periksa apakah toko yang dipilih aktif
        $toko = Toko::find($request->toko_id);
        if (!$toko || !$toko->is_active) {
            return redirect()->back()->withErrors(['toko_id' => 'Toko yang dipilih tidak aktif.']);
        }

        // Perbarui order
        $order->update($request->except('bukus'));

        // Hapus relasi buku lama dan simpan yang baru
        $order->bukus()->detach(); // Menghapus semua buku terkait sebelumnya
        foreach ($request->bukus as $buku) {
            $order->bukus()->attach($buku['id'], ['jumlah' => $buku['jumlah']]);
        }

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    // Menghapus order yang sudah ada
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order tidak ditemukan.');
        }

        $order->bukus()->detach(); // Hapus data buku dari tabel pivot
        $order->delete(); // Hapus order

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus!');
    }
}
