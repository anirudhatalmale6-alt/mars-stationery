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
        .reply-box { background: #f0fdf4; padding: 16px; border-radius: 8px; border-left: 4px solid #16a34a; margin: 16px 0; }
        .items-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .items-table th { background: #f9f9f9; padding: 8px; text-align: left; font-size: 13px; color: #666; border-bottom: 2px solid #eee; }
        .items-table td { padding: 8px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .original-box { background: #f9f9f9; padding: 16px; border-radius: 8px; border-left: 4px solid #d1d5db; margin: 16px 0; }
        .footer { background: #1a1a1a; color: #999; padding: 20px; text-align: center; font-size: 12px; }
        .footer a { color: #DC2626; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Response to Your Bulk Inquiry</h1>
        </div>
        <div class="content">
            <p>Hi {{ $inquiry->name }},</p>
            <p>Thank you for your bulk inquiry with Mars Stationery. Here is our response:</p>

            <div class="reply-box">
                {!! nl2br(e($inquiry->admin_reply)) !!}
            </div>

            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 24px 0;">

            <p style="color: #666; font-size: 13px;">Your inquiry items:</p>
            <table class="items-table">
                <thead><tr><th>Product</th><th>Quantity</th></tr></thead>
                <tbody>
                    @foreach($inquiry->items as $item)
                    <tr><td>{{ $item->product_name }}</td><td>{{ $item->quantity }}</td></tr>
                    @endforeach
                </tbody>
            </table>

            @if($inquiry->message)
            <p style="color: #666; font-size: 13px;">Your message:</p>
            <div class="original-box">
                <p style="margin: 0; color: #666; font-size: 13px;">{!! nl2br(e($inquiry->message)) !!}</p>
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
