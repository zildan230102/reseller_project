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
    public function index()
    {
        $orders = Order::with('toko', 'ekspedisi', 'bukus')->get();
        $tokos = Toko::where('is_active', 1)->get();
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all();
        $provinces = Province::all();
        return view('orders.index', compact('orders', 'tokos', 'ekspedisis', 'bukus','provinces'));
    }

    public function create()
    {
        $tokos = Toko::where('is_active', 1)->get();
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all();
        $provinces = Province::all();
        return view('orders.create', compact('tokos', 'ekspedisis', 'bukus','provinces'));
    }

    public function getKabupaten(Request $request)
    {
        $kota = Regency::where('province_id', $request->id_provinsi)->get();
        $options = '<option value="" disabled selected>Pilih Kabupaten</option>';
        foreach ($kota as $data) {
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
            'kelurahan' => 'required|exists:villages,id',
            'kecamatan' => 'required|exists:districts,id',
            'kota' => 'required|exists:regencies,id',
            'provinsi' => 'required|exists:provinces,id',
            'catatan' => 'nullable|string',
            'total_berat' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'bukus' => 'required|array',
            'bukus.*.id' => 'required|exists:bukus,id',
            'bukus.*.jumlah' => 'required|numeric|min:1',
        ]);
    
        $provinceName = Province::find($request->provinsi)->name;
        $regencyName = Regency::find($request->kota)->name;
        $districtName = District::find($request->kecamatan)->name;
        $villageName = Village::find($request->kelurahan)->name;
    
        $toko = Toko::find($request->toko_id);
        if (!$toko || !$toko->is_active) {
            return redirect()->back()->withErrors(['toko_id' => 'Toko yang dipilih tidak aktif.']);
        }
    
        $order = new Order();
        $order->tanggal = $request->tanggal;
        $order->no_hp = $request->no_hp;
        $order->kode_booking = $request->kode_booking;
        $order->toko_id = $request->toko_id;
        $order->ekspedisi_id = $request->ekspedisi_id;
        $order->asal_penjualan = $request->asal_penjualan;
        $order->penerima = $request->penerima;
        $order->no_hp_penerima = $request->no_hp_penerima;
        $order->alamat_kirim = $request->alamat_kirim;
        $order->provinsi = $provinceName; 
        $order->kota = $regencyName;      
        $order->kecamatan = $districtName;
        $order->kelurahan = $villageName; 
        $order->catatan = $request->catatan;
        $order->total_berat = $request->total_berat;
        $order->grand_total = $request->grand_total;
        $order->save();
    
        foreach ($request->bukus as $buku) {
            $order->bukus()->attach($buku['id'], ['jumlah' => $buku['jumlah']]);
        }
    
        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }
    
    public function edit(Order $order)
    {
        if ($order->status === 'confirmed') {
            return redirect()->route('orders.index')->with('error', 'Pesanan sudah terkonfirmasi dan tidak bisa diedit.');
        }

        $tokos = Toko::where('is_active', 1)->get();
        $ekspedisis = Ekspedisi::all();
        $bukus = Buku::all();
        $selectedBukus = $order->bukus->map(function ($buku) {
            return [
                'id' => $buku->id,
                'jumlah' => $buku->pivot->jumlah,
            ];
        });

        return view('orders.edit', compact('order', 'tokos', 'ekspedisis', 'bukus', 'selectedBukus'));
    }

    public function update(Request $request, Order $order)
    {
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
            'kelurahan' => 'required|exists:villages,id',
            'kecamatan' => 'required|exists:districts,id',
            'kota' => 'required|exists:regencies,id',
            'provinsi' => 'required|exists:provinces,id',
            'catatan' => 'nullable|string',
            'total_berat' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'bukus' => 'required|array',
            'bukus.*.id' => 'required|exists:bukus,id',
            'bukus.*.jumlah' => 'required|numeric|min:1',
        ]);

        $toko = Toko::find($request->toko_id);
        if (!$toko || !$toko->is_active) {
            return redirect()->back()->withErrors(['toko_id' => 'Toko yang dipilih tidak aktif.']);
        }

        $order->update($request->except('bukus'));
        $order->bukus()->detach();
        foreach ($request->bukus as $buku) {
            $order->bukus()->attach($buku['id'], ['jumlah' => $buku['jumlah']]);
        }

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'confirmed') {
            return redirect()->route('orders.index')->with('error', 'Pesanan sudah terkonfirmasi.');
        }

        $order->status = 'confirmed';
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function riwayat()
    {
        $orders = Order::where('status', 'confirmed')->get(); // Ambil order dengan status 'confirmed'
        return view('orders.riwayat', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'canceled') {
            return redirect()->route('riwayat.pesanan')->with('error', 'Pesanan sudah dibatalkan.');
        }

        $order->status = 'canceled';
        $order->save();
        return redirect()->route('riwayat.pesanan')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function destroy($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus');
    }

    public function riwayatPesanan()
    {
        $orders = Order::where('status', 'confirmed')->get();
        return view('orders.riwayat', compact('orders'));
    }
    
    public function confirmOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = 'confirmed';
            $order->save();
            return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi dan dipindahkan ke halaman riwayat pesanan.');
        }
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }
}
