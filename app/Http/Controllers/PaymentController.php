<?php

namespace App\Http\Controllers;

use App\Models\Order; 
use PDF;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        $order->metode_pembayaran = $validated['metode_pembayaran'];
        $order->status = 'confirmed'; 
        $order->save();

        return redirect()->route('orders.history')->with('success', 'Pembayaran berhasil, pesanan sudah dikonfirmasi.');
    }
    
    public function history()
    {
        $payments = [
            ['date' => '2024-12-01', 'amount' => 50000, 'status' => 'Lunas'],
            ['date' => '2024-11-25', 'amount' => 75000, 'status' => 'Lunas'],
        ];

        return view('pembayaran.history', compact('payments'));
    }

    public function bills()
    {
        $orders = Order::where('status', 'confirmed')->get();
        if ($orders->isEmpty()) {
            $bills = [];
        } else {
            $bills = $orders->map(function ($order) {
                return [
                    'invoice' => $order->no_invoice,
                    'total_amount' => $order->grand_total,
                    'payment_status' => $order->status,
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

        return view('pembayaran.bills', compact('orders'));
    }

    public function selectOrderToPay()
    {
        $orders = Order::where('status', 'confirmed')
            ->orWhere('status_pembayaran', 'Belum Lunas')
            ->get();
        return view('pembayaran.select_order', compact('orders'));
    }

    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'order_ids' => 'required|array',
            'metode_pembayaran' => 'required|string',
        ]);
    
        $orderIds = $validated['order_ids'];
        $metodePembayaran = $validated['metode_pembayaran'];
        $orders = Order::whereIn('id', $orderIds)->get();
    
        foreach ($orders as $order) {
            $order->update([
                'status' => 'paid',
                'metode_pembayaran' => $metodePembayaran,
                'tanggal_pembayaran' => now(),
            ]);
        }
    
        return redirect()->route('payment.history')->with('success', 'Pembayaran berhasil diproses.');
    }

    public function paymentHistory()
    {
        $orders = Order::where('status', 'paid')->orderBy('tanggal_pembayaran', 'desc')->get();
        return view('Pembayaran.history', compact('orders'));
    }
}
