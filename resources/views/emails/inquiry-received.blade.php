<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background: #f5f5f5; }
        .container { max-width: 600px; margin: 20px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: #DC2626; color: #fff; padding: 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 20px; }
        .content { padding: 24px; }
        .info-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .info-table td { padding: 8px 0; border-bottom: 1px solid #f0f0f0; vertical-align: top; }
        .info-table td:first-child { color: #666; width: 30%; font-weight: bold; }
        .items-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .items-table th { background: #f9f9f9; padding: 10px 8px; text-align: left; font-size: 13px; color: #666; border-bottom: 2px solid #eee; }
        .items-table td { padding: 10px 8px; border-bottom: 1px solid #f0f0f0; }
        .message-box { background: #f9f9f9; padding: 16px; border-radius: 8px; border-left: 4px solid #DC2626; margin: 16px 0; }
        .footer { background: #1a1a1a; color: #999; padding: 16px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Bulk Inquiry</h1>
        </div>
        <div class="content">
            <p>A new bulk inquiry has been submitted.</p>

            <table class="info-table">
                <tr><td>Name</td><td>{{ $inquiry->name }}</td></tr>
                <tr><td>Email</td><td>{{ $inquiry->email }}</td></tr>
                <tr><td>Phone</td><td>{{ $inquiry->phone }}</td></tr>
                <tr><td>Delivery To</td><td>{{ $inquiry->delivery_address }}</td></tr>
                <tr><td>Date</td><td>{{ $inquiry->created_at->format('d M Y, h:i A') }}</td></tr>
            </table>

            <h3>Requested Items:</h3>
            <table class="items-table">
                <thead><tr><th>Product</th><th>Quantity</th></tr></thead>
                <tbody>
                    @foreach($inquiry->items as $item)
                    <tr><td>{{ $item->product_name }}</td><td>{{ $item->quantity }}</td></tr>
                    @endforeach
                </tbody>
            </table>

            @if($inquiry->message)
            <h3>Additional Message:</h3>
            <div class="message-box">{!! nl2br(e($inquiry->message)) !!}</div>
            @endif

            <p style="margin-top: 20px;">
                <a href="{{ config('app.url') }}/admin/inquiries/{{ $inquiry->id }}" style="display: inline-block; background: #DC2626; color: #fff; padding: 10px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">View & Reply in Admin Panel</a>
            </p>
        </div>
        <div class="footer">Mars Stationery - Admin Notification</div>
    </div>
</body>
</html>
