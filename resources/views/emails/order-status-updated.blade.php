<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background: #f5f5f5; }
        .container { max-width: 600px; margin: 20px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: #DC2626; color: #fff; padding: 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; }
        .content { padding: 24px; }
        .status-box { padding: 20px; border-radius: 8px; margin: 16px 0; text-align: center; }
        .status-change { display: flex; align-items: center; justify-content: center; gap: 12px; margin: 16px 0; }
        .badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: bold; }
        .badge-pending { background: #FEF3C7; color: #92400E; }
        .badge-processing { background: #DBEAFE; color: #1E40AF; }
        .badge-shipped { background: #E0E7FF; color: #3730A3; }
        .badge-delivered { background: #D1FAE5; color: #065F46; }
        .badge-cancelled { background: #FEE2E2; color: #991B1B; }
        .badge-paid { background: #D1FAE5; color: #065F46; }
        .badge-failed { background: #FEE2E2; color: #991B1B; }
        .badge-refunded { background: #F3E8FF; color: #6B21A8; }
        .badge-payment_pending { background: #FEF3C7; color: #92400E; }
        .arrow { font-size: 24px; color: #DC2626; }
        .info-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .info-table td { padding: 8px 0; border-bottom: 1px solid #f0f0f0; }
        .info-table td:first-child { color: #666; width: 40%; }
        .footer { background: #1a1a1a; color: #999; padding: 20px; text-align: center; font-size: 12px; }
        .footer a { color: #DC2626; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order {{ $changeType === 'payment' ? 'Payment' : 'Status' }} Updated</h1>
        </div>
        <div class="content">
            <p>Hi {{ $order->delivery_name }},</p>

            @if($changeType === 'order')
                <p>The status of your order <strong>{{ $order->order_number }}</strong> has been updated:</p>
            @else
                <p>The payment status of your order <strong>{{ $order->order_number }}</strong> has been updated:</p>
            @endif

            <div class="status-change">
                <span class="badge badge-{{ $oldStatus }}">{{ ucfirst(str_replace('_', ' ', $oldStatus)) }}</span>
                <span class="arrow">&#10140;</span>
                <span class="badge badge-{{ $newStatus }}">{{ ucfirst(str_replace('_', ' ', $newStatus)) }}</span>
            </div>

            @if($newStatus === 'shipped')
                <div style="padding: 16px; background: #EFF6FF; border-radius: 8px; margin: 16px 0;">
                    Your order has been shipped and is on its way to you!
                </div>
            @elseif($newStatus === 'delivered')
                <div style="padding: 16px; background: #ECFDF5; border-radius: 8px; margin: 16px 0;">
                    Your order has been delivered. We hope you enjoy your purchase!
                </div>
            @elseif($newStatus === 'cancelled')
                <div style="padding: 16px; background: #FEF2F2; border-radius: 8px; margin: 16px 0;">
                    Your order has been cancelled. If you have any questions, please contact us.
                </div>
            @elseif($newStatus === 'paid')
                <div style="padding: 16px; background: #ECFDF5; border-radius: 8px; margin: 16px 0;">
                    Your payment has been confirmed. Thank you!
                </div>
            @elseif($newStatus === 'refunded')
                <div style="padding: 16px; background: #F5F3FF; border-radius: 8px; margin: 16px 0;">
                    Your payment has been refunded. Please allow a few business days for the refund to reflect.
                </div>
            @endif

            <h3 style="margin-top: 24px; color: #1a1a1a;">Order Summary</h3>
            <table class="info-table">
                <tr><td>Order Number</td><td><strong>{{ $order->order_number }}</strong></td></tr>
                <tr><td>Order Status</td><td><span class="badge badge-{{ $order->order_status }}">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span></td></tr>
                <tr><td>Payment Status</td><td><span class="badge badge-{{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span></td></tr>
                <tr><td>Total</td><td><strong>LKR {{ number_format($order->total, 2) }}</strong></td></tr>
                <tr><td>Payment Method</td><td>{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</td></tr>
            </table>
        </div>
        <div class="footer">
            <p>Mars Stationery - Your One-Stop Stationery Shop</p>
            <p><a href="{{ config('app.url') }}">Visit our store</a></p>
        </div>
    </div>
</body>
</html>
