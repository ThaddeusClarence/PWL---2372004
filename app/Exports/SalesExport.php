<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = auth()->user();
        $query = Order::with(['user', 'event'])->where('status', 'paid');
        
        if ($user->role === 'organizer') {
            $query->whereHas('event', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        
        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Pembeli',
            'Email',
            'Event',
            'Total Harga',
            'Status',
            'Tanggal Transaksi'
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->user->name,
            $order->user->email,
            $order->event->title,
            'Rp ' . number_format($order->total_price, 0, ',', '.'),
            strtoupper($order->status),
            $order->created_at->format('d M Y, H:i')
        ];
    }
}
