<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toko;
use App\Models\Ekspedisi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()  
    {
        $orders = Order::with('toko','ekspedisi')->get(); // Mengambil data order beserta toko terkait
        $tokos = Toko::where('is_active', 1)->get(); // Ambil hanya toko yang aktif untuk dropdown atau referensi
        $ekspedisis = Ekspedisi::all();
        return view('orders.index', compact('orders', 'tokos','ekspedisis'));
    }

    // Menampilkan form untuk membuat order baru
    public function create()
    {
        $tokos = Toko::where('is_active', 1)->get(); // Hanya ambil toko yang aktif
        $ekspedisis = Ekspedisi::all();
        return view('orders.create', compact('tokos','ekspedisis'));
    }

    // Menyimpan order baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_hp' => 'required|string',
            'kode_booking' => 'nullable|string|max:255|unique:orders,kode_booking', // Validasi untuk kode_booking, pastikan unik
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
        ]);

        // Memeriksa apakah toko yang dipilih aktif
        $toko = Toko::find($request->toko_id);
        if (!$toko || !$toko->is_active) {
            return redirect()->back()->withErrors(['toko_id' => 'Toko yang dipilih tidak aktif.']);
        }

        // Menyimpan order baru
        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit order yang sudah ada
    public function edit(Order $order)
    {
        $tokos = Toko::where('is_active', 1)->get(); // Hanya ambil toko yang aktif
        $ekspedisis = Ekspedisi::all();
        return view('orders.edit', compact('order', 'tokos','ekspedisis'));
    }

    // Memperbarui data order yang sudah ada
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_hp' => 'required|string',
            'kode_booking' => 'nullable|string|max:255|unique:orders,kode_booking,' . $order->id, // Validasi untuk kode_booking, pastikan unik kecuali untuk yang sedang diupdate
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
        ]);

        // Memeriksa apakah toko yang dipilih aktif
        $toko = Toko::find($request->toko_id);
        if (!$toko || !$toko->is_active) {
            return redirect()->back()->withErrors(['toko_id' => 'Toko yang dipilih tidak aktif.']);
        }

        // Memperbarui order
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    // Menghapus order yang sudah ada
    public function destroy($id)
    {
        $order = Order::find($id); // Mencari order berdasarkan ID
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order tidak ditemukan.');
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus!');
    }
}
