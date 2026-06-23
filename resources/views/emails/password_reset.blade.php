
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background:#f4f6fb; margin:0; padding:0; }
        .email-wrapper { max-width:600px; margin:28px auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 6px 24px rgba(20,31,66,0.08); }
        .email-header { background:linear-gradient(90deg,#0b5cff,#3b82f6); color:#fff; padding:20px; text-align:center }
        .brand-title { font-weight:700; letter-spacing:1px }
        .email-body { padding:24px; color:#111827; }
        .lead { font-size:16px; margin-bottom:18px }
        .btn { display:inline-block; padding:12px 20px; background:#0b5cff; color:#fff; text-decoration:none; border-radius:8px; font-weight:600 }
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
        <p class="lead">Hello {{ $user->name }},</p>

        <p>We received a request to reset the password for your account.</p>

        <p>If you initiated this request, click the button below to continue the password recovery process.</p>

        <p style="text-align:center; margin:22px 0">
            <a class="btn" href="{{ $url }}">Continue Password Reset</a>
        </p>

        <p>If you did not request a password reset, you can safely ignore this message — no changes will be made.</p>

        <p class="meta">For your security, this link will expire in 15 minutes.</p>

        <p style="margin-top:20px">Best Regards,<br>NexuistInvestment Security Team</p>
    </div>

    <div class="footer">
        <div>If you need help, contact our support at <a href="mailto:marinemilitary80@gmail.com">marinemilitary80@gmail.com</a></div>
        <div style="margin-top:8px">&copy; 2026 Nexuist. All rights reserved.</div>
    </div>
</div>

</body>
</html>
