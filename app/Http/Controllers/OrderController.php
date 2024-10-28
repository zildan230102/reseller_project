<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toko; // Jika Anda menggunakan model Toko
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()  
    {
        $orders = Order::with('toko')->get();
        $tokos = Toko::all(); // Ambil semua data toko untuk dropdown
        return view('orders.index', compact('orders', 'tokos'));
    }

    // Menampilkan form untuk membuat order baru
    public function create()
    {
        $tokos = Toko::all(); // Ambil semua data toko untuk dropdown
        return view('orders.create', compact('tokos')); // Ganti dengan nama view yang sesuai
    }

    // Menyimpan order baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_hp' => 'required|string',
            'toko_id' => 'required|exists:tokos,id',
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

        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit order yang sudah ada
    public function edit(Order $order)
    {
        $tokos = Toko::all(); // Ambil semua data toko untuk dropdown
        return view('orders.edit', compact('order', 'tokos'));
    }

    // Memperbarui data order yang sudah ada
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_hp' => 'required|string',
            'toko_id' => 'required|exists:tokos,id',
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

        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    // Menghapus order yang sudah ada
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus!');
    }
}
