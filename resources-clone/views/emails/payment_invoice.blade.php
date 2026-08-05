<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Request | May Harmony Find You</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; padding: 40px; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h1 { color: #6772e5; font-size: 24px; margin-bottom: 24px; }
        p { margin-bottom: 16px; font-size: 16px; color: #4a4a4a; }
        .button { display: inline-block; padding: 14px 28px; background-color: #6772e5; color: #ffffff !important; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px; }
        .footer { margin-top: 32px; padding-top: 24px; border-top: 1px solid #eeeeee; font-size: 14px; color: #888888; }
        .order-id { font-weight: bold; color: #6772e5; }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Payment Request: Order <span class="order-id">#{{ $order->id }}</span></h1>
        <p>Dear {{ $order->full_name }},</p>
        <p>We are pleased to inform you that your inquiry with <strong>May Harmony Find You</strong> has been reviewed and is now ready for the final payment stage.</p>
        <p>To proceed, please follow the secure link below to complete your transaction via our secure payment gateway:</p>
        <div style="text-align: center; margin: 32px 0;">
            <a href="{{ $paymentUrl }}" class="button">Complete Payment Securely</a>
        </div>
        <p>Once your payment is confirmed, our concierge team will finalize your request and coordinate the next steps. We are dedicated to ensuring your experience is seamless and exceptional.</p>
        <p>Should you have any questions or require further assistance, please do not hesitate to reply to this email.</p>
        <div class="footer">
            <p>Warm regards,<br><strong>The May Harmony Find You Concierge Team</strong></p>
        </div>
    </div>
</body>
</html>
