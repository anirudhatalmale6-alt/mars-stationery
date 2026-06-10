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
        .message-box { background: #f9f9f9; padding: 16px; border-radius: 8px; border-left: 4px solid #DC2626; margin: 16px 0; }
        .footer { background: #1a1a1a; color: #999; padding: 16px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Message</h1>
        </div>
        <div class="content">
            <p>A new message has been received through the contact form.</p>

            <table class="info-table">
                <tr><td>Name</td><td>{{ $contact->name }}</td></tr>
                <tr><td>Email</td><td>{{ $contact->email }}</td></tr>
                <tr><td>Phone</td><td>{{ $contact->phone ?? 'Not provided' }}</td></tr>
                <tr><td>Subject</td><td>{{ $contact->subject }}</td></tr>
                <tr><td>Date</td><td>{{ $contact->created_at->format('d M Y, h:i A') }}</td></tr>
            </table>

            <h3>Message:</h3>
            <div class="message-box">
                {!! nl2br(e($contact->message)) !!}
            </div>

            <p style="margin-top: 20px;">
                <a href="{{ config('app.url') }}/admin/contacts/{{ $contact->id }}" style="display: inline-block; background: #DC2626; color: #fff; padding: 10px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">View & Reply in Admin Panel</a>
            </p>
        </div>
        <div class="footer">Mars Stationery - Admin Notification</div>
    </div>
</body>
</html>
