<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background: #f5f5f5; }
        .container { max-width: 600px; margin: 20px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: #DC2626; color: #fff; padding: 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; }
        .header p { margin: 4px 0 0; opacity: 0.9; font-size: 14px; }
        .content { padding: 24px; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; }
        .badge-pending { background: #FEF3C7; color: #92400E; }
        .badge-paid { background: #D1FAE5; color: #065F46; }
        .info-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .info-table td { padding: 8px 0; border-bottom: 1px solid #f0f0f0; }
        .info-table td:first-child { color: #666; width: 40%; }
        .items-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .items-table th { background: #f9f9f9; padding: 10px 8px; text-align: left; font-size: 13px; color: #666; border-bottom: 2px solid #eee; }
        .items-table td { padding: 10px 8px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .total-row td { font-weight: bold; border-top: 2px solid #DC2626; }
        .footer { background: #1a1a1a; color: #999; padding: 20px; text-align: center; font-size: 12px; }
        .footer a { color: #DC2626; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed!</h1>
            <p>Thank you for your order</p>
        </div>
        <div class="content">
            <p>Hi {{ $order->delivery_name }},</p>
            <p>Your order has been placed successfully. Here are the details:</p>

            <table class="info-table">
                <tr><td>Order Number</td><td><strong>{{ $order->order_number }}</strong></td></tr>
                <tr><td>Order Status</td><td><span class="badge badge-pending">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span></td></tr>
                <tr><td>Payment Method</td><td>{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</td></tr>
                <tr><td>Payment Status</td><td><span class="badge badge-pending">{{ ucfirst($order->payment_status) }}</span></td></tr>
            </table>

            <h3 style="margin-top: 24px; color: #1a1a1a;">Order Items</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th style="text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align: right;">LKR {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Subtotal</td>
                        <td style="text-align: right;">LKR {{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Delivery</td>
                        <td style="text-align: right;">LKR {{ number_format($order->delivery_charge, 2) }}</td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="2">Total</td>
                        <td style="text-align: right;">LKR {{ number_format($order->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <h3 style="margin-top: 24px; color: #1a1a1a;">Delivery Address</h3>
            <p style="margin: 4px 0;">
                {{ $order->delivery_name }}<br>
                {{ $order->delivery_address }}<br>
                {{ $order->delivery_city }}, {{ $order->delivery_state }} {{ $order->delivery_postal_code }}<br>
                Phone: {{ $order->delivery_phone }}
            </p>

            @if($order->payment_method === 'bank_transfer')
            <div style="margin-top: 24px; padding: 16px; background: #FEF3C7; border-radius: 8px;">
                <strong>Bank Transfer Instructions:</strong><br>
                Please transfer the total amount and upload your receipt on the order confirmation page.
            </div>
            @endif
        </div>
        <div class="footer">
            <p>Mars Stationery - Your One-Stop Stationery Shop</p>
            <p><a href="{{ config('app.url') }}">Visit our store</a></p>
        </div>
    </div>
</body>
</html>
