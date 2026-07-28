<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Request for {{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
        .button { display: inline-block; padding: 10px 20px; background-color: #6772e5; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Request</h1>
        <p>Hello {{ $order->full_name }},</p>
        <p>Your order #{{ $order->id }} is ready for payment. Please click the button below to complete your purchase via Stripe:</p>
        <p><a href="{{ $paymentUrl }}" class="button">Pay Now</a></p>
        <p>If you have any questions, please contact us.</p>
        <p>Thank you!</p>
    </div>
</body>
</html>
