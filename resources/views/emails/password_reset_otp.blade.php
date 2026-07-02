<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery Code</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background:#f4f6fb; margin:0; padding:0; }
        .email-wrapper { max-width:600px; margin:28px auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 6px 24px rgba(20,31,66,0.08); }
        .email-header { background:linear-gradient(90deg,#0b5cff,#3b82f6); color:#fff; padding:20px; text-align:center }
        .brand-title { font-weight:700; letter-spacing:1px }
        .email-body { padding:24px; color:#111827; }
        .lead { font-size:16px; margin-bottom:18px }
        .otp-box { display:inline-block; padding:14px 22px; background:#eff6ff; color:#0b5cff; font-size:28px; letter-spacing:6px; font-weight:700; border-radius:8px; margin:12px 0 18px; }
        .meta { font-size:13px; color:#6b7280; margin-top:18px }
        .footer { padding:16px 24px; background:#fafafa; font-size:13px; color:#6b7280; text-align:center }
        @media (max-width:420px){ .email-wrapper{margin:12px} .email-body{padding:16px} }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-header">
        <div class="brand-title">NexuistInvestment — Security Team</div>
    </div>
    <div class="email-body">
        <p class="lead">Hello {{ $user->name ?? $user->email }},</p>
        <p>We received a request to reset the password for your Nexuist account.</p>
        <p><strong>Your verification code is:</strong></p>
        <div class="otp-box">{{ $otp }}</div>
        <p>Enter this code on the recovery page to continue changing your password.</p>
        <p class="meta">For security, this code expires in 10 minutes and should not be shared with anyone.</p>
        <p style="margin-top:20px">Best Regards,<br>NexuistInvestment Security Team</p>
    </div>
    <div class="footer">
        <div>If you need help, contact our support at <a href="mailto:nexuistinvestment@gmail.com">nexuistinvestment@gmail.com</a></div>
        <div style="margin-top:8px">&copy; 2026 Nexuist. All rights reserved.</div>
    </div>
</div>
</body>
</html>
