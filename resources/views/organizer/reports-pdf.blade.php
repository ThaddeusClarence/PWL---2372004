<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Organizer Financial Report - {{ $user->name }}</title>
    <style>
        @page { margin: 1cm; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #1e293b; 
            margin: 0; 
            padding: 0;
            line-height: 1.5;
        }
        .header { 
            padding-bottom: 30px; 
            border-bottom: 4px solid #4f46e5; 
            margin-bottom: 40px;
        }
        .header table { width: 100%; border: none; }
        .header h1 { 
            margin: 0; 
            color: #4f46e5; 
            font-size: 28px; 
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: -1px;
        }
        .header .meta { text-align: right; color: #64748b; font-size: 11px; }

        .summary-grid { width: 100%; margin-bottom: 40px; }
        .summary-card { 
            background: #ffffff; 
            padding: 20px; 
            border-radius: 20px; 
            border: 1px solid #e2e8f0;
            text-align: center;
        }
        .summary-card h4 { 
            margin: 0; 
            font-size: 10px; 
            text-transform: uppercase; 
            color: #94a3b8; 
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .summary-card .value { 
            font-size: 24px; 
            font-weight: 800; 
            color: #0f172a; 
        }

        .section-title { 
            font-size: 14px; 
            font-weight: 800; 
            color: #1e293b; 
            text-transform: uppercase; 
            letter-spacing: 1px;
            margin-bottom: 20px;
            padding-left: 10px;
            border-left: 4px solid #4f46e5;
        }

        table.data-table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0;
            margin-bottom: 40px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }
        .data-table th { 
            background-color: #f8fafc; 
            color: #64748b; 
            text-transform: uppercase; 
            font-size: 10px; 
            font-weight: 800;
            padding: 15px; 
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .data-table td { 
            padding: 15px; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 12px; 
            font-weight: 500;
        }
        .data-table tr:last-child td { border-bottom: none; }
        
        .revenue-cell { font-weight: 800; color: #059669; }
        .sold-cell { font-weight: 800; color: #4f46e5; }

        .grand-total { 
            background-color: #4f46e5; 
            color: #ffffff; 
            font-weight: 800; 
        }
        .grand-total td { padding: 20px; border: none; font-size: 14px; }

        .footer { 
            position: fixed; 
            bottom: 0; 
            width: 100%; 
            text-align: center; 
            font-size: 9px; 
            color: #94a3b8; 
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td>
                    <h1>Financial Report</h1>
                    <p style="margin: 5px 0 0; color: #64748b; font-size: 13px; font-weight: 600;">Organizer Performance Analytics</p>
                </td>
                <td class="meta">
                    <strong>Organizer:</strong> {{ $user->name }}<br>
                    <strong>Email:</strong> {{ $user->email }}<br>
                    <strong>Issued:</strong> {{ now()->format('d M Y | H:i') }}
                </td>
            </tr>
        </table>
    </div>

    <table class="summary-grid">
        <tr>
            <td width="33%" style="padding-right: 15px;">
                <div class="summary-card">
                    <h4>Gross Revenue</h4>
                    <div class="value" style="color: #059669;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </td>
            <td width="33%" style="padding: 0 7px;">
                <div class="summary-card">
                    <h4>Events Managed</h4>
                    <div class="value">{{ $totalEvents }}</div>
                </div>
            </td>
            <td width="33%" style="padding-left: 15px;">
                <div class="summary-card">
                    <h4>Avg Revenue/Event</h4>
                    <div class="value" style="font-size: 18px; padding-top: 5px;">
                        Rp {{ number_format($totalEvents > 0 ? $totalRevenue / $totalEvents : 0, 0, ',', '.') }}
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Breakdown Per Event</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Event Details</th>
                <th>Category</th>
                <th style="text-align: center;">Ticket Sold</th>
                <th style="text-align: right;">Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventPerformance as $event)
            <tr>
                <td>
                    <div style="font-weight: 800; font-size: 13px;">{{ $event->title }}</div>
                    <div style="font-size: 10px; color: #94a3b8; font-weight: bold;">ID: #EVT-{{ $event->id }}</div>
                </td>
                <td><span style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px;">{{ $event->category }}</span></td>
                <td style="text-align: center;" class="sold-cell">{{ $event->tickets_count }} Tickets</td>
                <td style="text-align: right;" class="revenue-cell">Rp {{ number_format($event->orders_sum_total_price ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="grand-total">
                <td colspan="3" style="text-align: right;">OVERALL NET REVENUE</td>
                <td style="text-align: right;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Generated automatically by EventMaster System. This document is a valid financial record for organizer performance evaluation.
    </div>
</body>
</html>
