<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Deployments Feed</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/deploybot.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <header class="top-header">
        <a href="/" class="logo-area">
            <img src="{{ asset('assets/Frontend/image/mylog.jpeg') }}" alt="Nexuist Logo" class="logo-img">
            <div class="logo-text"><h2>Nexuist</h2></div>
        </a>
    </header>

    <main style="max-width:900px; margin:40px auto; padding:0 16px;">
        <h1 style="margin-bottom:12px;">Recent Bot Deployments</h1>
        <p style="color:#6b7280; margin-bottom:20px;">Live deployments by users — backend-driven feed.</p>

        <div class="inventory-list">
            @forelse($deploys as $d)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:12px; border-bottom:1px solid #e6e9ef;">
                    <div>
                        <strong>{{ $d->bot?->bot_name ?? 'AI Bot' }}</strong>
                        <div style="font-size:0.9rem; color:#6b7280;">Deployed by {{ $d->user?->name ?? 'User' }} &middot; ${{ number_format($d->investment_amount ?? $d->amount ?? 0, 2) }}</div>
                    </div>
                    <div style="text-align:right; color:#6b7280; font-size:0.9rem;">{{ $d->created_at?->diffForHumans() }}</div>
                </div>
            @empty
                <div style="padding:20px; text-align:center; color:#6b7280;">No deployments yet.</div>
            @endforelse
        </div>
    </main>
</body>
</html>
