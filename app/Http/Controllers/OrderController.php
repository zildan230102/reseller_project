<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toko;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar order
    public function index()
    {
        $orders = Order::with('toko')->get(); // Mengambil semua order dengan relasi toko
        $tokos = Toko::all(); // Mengambil semua toko untuk dropdown

        return view('orders.index', compact('orders', 'tokos')); // Mengembalikan tampilan dengan data
    }

    // Menyimpan data order
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'toko_id' => 'required|exists:tokos,id',
            'no_hp' => 'required|string|max:15',
            'asal_penjualan' => 'required|string',
            'kode_booking' => 'required|string',
            'ekspedisi' => 'required|string',
            'penerima' => 'required|string',
            'no_hp_penerima' => 'required|string|max:15',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'alamat_kirim' => 'required|string',
            'total_berat' => 'required|numeric',
            'grand_total' => 'required|numeric',
        ]);

        // Menyimpan data order
        Order::create([
            'tanggal' => $request->tanggal,
            'no_invc' => Order::generateInvoiceNumber(), // Menghasilkan nomor invoice otomatis
            'toko_id' => $request->toko_id,
            'no_hp' => $request->no_hp,
            'asal_penjualan' => $request->asal_penjualan,
            'kode_booking' => $request->kode_booking,
            'ekspedisi' => $request->ekspedisi,
            'penerima' => $request->penerima,
            'no_hp_penerima' => $request->no_hp_penerima,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'alamat_kirim' => $request->alamat_kirim,
            'catatan' => $request->catatan,
            'total_berat' => $request->total_berat,
            'grand_total' => $request->grand_total,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil disimpan.');
    }

    // Tambahkan metode lain seperti edit dan destroy sesuai kebutuhan
}
