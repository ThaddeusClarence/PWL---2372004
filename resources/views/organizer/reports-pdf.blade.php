<!DOCTYPE html>
<html>
<head>
    <title>Organizer Financial Report</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4f46e5; padding-bottom: 20px; }
        .header h1 { margin: 0; color: #1a1a1a; font-size: 24px; }
        .header p { margin: 5px 0 0; color: #666; font-size: 12px; }
        
        .summary-box { width: 100%; margin-bottom: 30px; }
        .summary-card { background: #f8fafc; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; }
        .summary-card h4 { margin: 0; font-size: 10px; text-transform: uppercase; color: #64748b; }
        .summary-card h2 { margin: 5px 0 0; font-size: 20px; color: #0f172a; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f1f5f9; color: #475569; text-transform: uppercase; font-size: 10px; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }
        .total-row { background-color: #f8fafc; font-weight: bold; }
        
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Organizer Performance Report</h1>
        <p>Generated for: <strong>{{ $user->name }}</strong> | Date: {{ now()->format('d F Y, H:i') }}</p>
    </div>

    <table class="summary-box">
        <tr>
            <td width="50%" style="border-bottom: none; padding: 0 10px 0 0;">
                <div class="summary-card">
                    <h4>Total Revenue</h4>
                    <h2>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                </div>
            </td>
            <td width="50%" style="border-bottom: none; padding: 0 0 0 10px;">
                <div class="summary-card">
                    <h4>Active Events</h4>
                    <h2>{{ $totalEvents }} Events</h2>
                </div>
            </td>
        </tr>
    </table>

    <h3>Event Performance Breakdown</h3>
    <table>
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Category</th>
                <th>Sold</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventPerformance as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->category }}</td>
                <td>{{ $event->tickets_count }} Tickets</td>
                <td>Rp {{ number_format($event->orders_sum_total_price ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">GRAND TOTAL</td>
                <td>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        EventMaster Ticketing Platform - Official Organizer Financial Document
    </div>
</body>
</html>
