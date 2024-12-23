<?php

namespace App\Http\Controllers;

use App\Models\Order; 
use PDF; // Alias DOMPDF
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function update(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);

        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($validated['order_id']);

        // Perbarui metode pembayaran
        $order->metode_pembayaran = $validated['metode_pembayaran'];
        $order->status = 'confirmed';  // Update status pesanan menjadi 'confirmed' setelah dibayar
        $order->save();

        // Redirect ke halaman riwayat pesanan dengan pesan sukses
        return redirect()->route('orders.history')->with('success', 'Pembayaran berhasil, pesanan sudah dikonfirmasi.');
    }
    public function history()
    {
        // Contoh data riwayat pembayaran
        $payments = [
            ['date' => '2024-12-01', 'amount' => 50000, 'status' => 'Lunas'],
            ['date' => '2024-11-25', 'amount' => 75000, 'status' => 'Lunas'],
        ];

        // Mengarahkan ke view 'pembayaran.history' dengan data $payments
        return view('pembayaran.history', compact('payments'));
    }

    public function bills()
    {
    // Ambil pesanan yang sudah dikonfirmasi
    $orders = Order::where('status', 'confirmed')->get();

        // Jika tidak ada pesanan yang terkonfirmasi, set $bills menjadi array kosong
        if ($orders->isEmpty()) {
            $bills = [];
        } else {
            // Proses data pesanan untuk menjadi format tagihan
            $bills = $orders->map(function ($order) {
                return [
                    'invoice' => $order->no_invoice,
                    'total_amount' => $order->grand_total,
                    'payment_status' => $order->status,  // Asumsikan status di sini adalah 'Lunas' atau 'Belum Lunas'
                    'order_details' => $order->bukus->map(function ($buku) {
                        return [
                            'book_title' => $buku->judul_buku,
                            'quantity' => $buku->pivot->jumlah,
                        ];
                    }),
                    'shipping_address' => $order->alamat_kirim,
                ];
            });
        }

        // Mengarahkan ke view 'pembayaran.bills' dengan data $bills
        return view('pembayaran.bills', compact('orders'));
    }

    public function selectOrderToPay()
    {
        // Ambil daftar pesanan dengan status 'confirmed' atau 'Belum Lunas'
        $orders = Order::where('status', 'confirmed')
            ->orWhere('status_pembayaran', 'Belum Lunas')
            ->get();

        // Arahkan ke view dengan data pesanan
        return view('pembayaran.select_order', compact('orders'));
    }

    public function processPayment(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'order_ids' => 'required|array',
            'metode_pembayaran' => 'required|string',
        ]);
    
        $orderIds = $validated['order_ids'];
        $metodePembayaran = $validated['metode_pembayaran'];
    
        // Ambil pesanan yang dipilih
        $orders = Order::whereIn('id', $orderIds)->get();
    
        // Pindahkan pesanan ke riwayat pembayaran
        foreach ($orders as $order) {
            $order->update([
                'status' => 'paid', // Atur status menjadi "paid" atau sesuai kebutuhan
                'metode_pembayaran' => $metodePembayaran,
                'tanggal_pembayaran' => now(),
            ]);
        }
    
        // Redirect ke halaman riwayat pembayaran
        return redirect()->route('payment.history')->with('success', 'Pembayaran berhasil diproses.');
    }
    public function paymentHistory()
    {
        // Ambil data orders yang sudah dibayar
        $orders = Order::where('status', 'paid')->orderBy('tanggal_pembayaran', 'desc')->get();
    
        // Kirim data ke view 'Pembayaran.history'
        return view('Pembayaran.history', compact('orders'));
    }
    

}
