<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toko;
use App\Models\Ekspedisi;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;


class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()
    {
        $orders = Order::with('toko', 'ekspedisi', 'bukus')->get(); // Mengambil data order beserta toko dan buku terkait
        $tokos = Toko::where('is_active', 1)->get(); // Ambil hanya toko yang aktif
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all();
        $provinces = Province::all();
        return view('orders.index', compact('orders', 'tokos', 'ekspedisis', 'bukus','provinces'));
    }

    // Menampilkan form untuk membuat order baru
    public function create()
    {
        $tokos = Toko::where('is_active', 1)->get();
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all(); // Mengambil semua buku untuk pilihan
        $provinces = Province::all();
        return view('orders.create', compact('tokos', 'ekspedisis', 'bukus','provinces'));
    }

    public function getKabupaten(Request $request)
{
    $kabupaten = Regency::where('province_id', $request->id_provinsi)->get();
    $options = '<option value="" disabled selected>Pilih Kabupaten</option>';
    foreach ($kabupaten as $data) {
        $options .= '<option value="' . $data->id . '">' . $data->name . '</option>';
    }
    return response()->json($options);
}

public function getKecamatan(Request $request)
{
    $kecamatan = District::where('regency_id', $request->id_kabupaten)->get();
    $options = '<option value="" disabled selected>Pilih Kecamatan</option>';
    foreach ($kecamatan as $data) {
        $options .= '<option value="' . $data->id . '">' . $data->name . '</option>';
    }
    return response()->json($options);
}

public function getKelurahan(Request $request)
{
    $kelurahan = Village::where('district_id', $request->id_kecamatan)->get();
    $options = '<option value="" disabled selected>Pilih Kelurahan</option>';
    foreach ($kelurahan as $data) {
        $options .= '<option value="' . $data->id . '">' . $data->name . '</option>';
    }
    return response()->json($options);
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
            'village_id' => 'required|exists:villages,id',
            'district_id' => 'required|exists:districts,id',
            'regency_id' => 'required|exists:regencies,id',
            'province_id' => 'required|exists:provinces,id',
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
        // Cek jika order sudah terkonfirmasi, maka tidak bisa diedit
        if ($order->status === 'confirmed') {
            return redirect()->route('orders.index')->with('error', 'Pesanan sudah terkonfirmasi dan tidak bisa diedit.');
        }

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
        // Cek jika order sudah terkonfirmasi, maka tidak bisa diperbarui
        if ($order->status === 'confirmed') {
            return redirect()->route('orders.index')->with('error', 'Pesanan sudah terkonfirmasi dan tidak bisa diperbarui.');
        }

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
            'village_id' => 'required|exists:villages,id',
            'district_id' => 'required|exists:districts,id',
            'regency_id' => 'required|exists:regencies,id',
            'province_id' => 'required|exists:provinces,id',
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

    // Fungsi untuk mengonfirmasi pesanan
    public function confirm($id)
    {
        $order = Order::findOrFail($id);

        // Periksa apakah pesanan sudah terkonfirmasi
        if ($order->status === 'confirmed') {
            return redirect()->route('orders.index')->with('error', 'Pesanan sudah terkonfirmasi.');
        }

        // Tandai pesanan sebagai terkonfirmasi
        $order->status = 'confirmed';
        $order->save();

        // Pindahkan order ke riwayat jika perlu
        // RiwayatPesanan::create($order->toArray()); // Jika ada tabel riwayat_pesanan

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    // Menampilkan daftar riwayat order yang sudah terkonfirmasi
    public function riwayat()
    {
        $orders = Order::where('status', 'confirmed')->get(); // Ambil order dengan status 'confirmed'
        return view('orders.riwayat', compact('orders'));
    }

    // Fungsi untuk membatalkan pesanan
    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        // Pastikan pesanan yang akan dibatalkan belum dibatalkan sebelumnya
        if ($order->status == 'canceled') {
            return redirect()->route('riwayat.pesanan')->with('error', 'Pesanan sudah dibatalkan.');
        }

        // Ubah status pesanan menjadi 'canceled'
        $order->status = 'canceled';
        $order->save();

        return redirect()->route('riwayat.pesanan')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Menghapus order yang sudah ada
    public function destroy($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();
    
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus');
    }

    //
    public function riwayatPesanan()
    {
        // Ambil hanya pesanan yang sudah dikonfirmasi
        $orders = Order::where('status', 'confirmed')->get();
    
        return view('orders.riwayat', compact('orders'));
    }
    
    
    public function confirmOrder($id)
{
    // Cari order berdasarkan ID
    $order = Order::find($id);

    if ($order) {
        // Update status menjadi "confirmed"
        $order->status = 'confirmed';
        $order->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi dan dipindahkan ke halaman riwayat pesanan.');
    }

    return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
}


}
