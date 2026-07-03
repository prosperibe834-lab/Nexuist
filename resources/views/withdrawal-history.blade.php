<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal History</title>
    <style>
        body { font-family: Arial, sans-serif; background: #07111f; color: #f5f7fb; padding: 24px; }
        .card { background: #0f172a; border: 1px solid #233247; border-radius: 12px; padding: 20px; max-width: 960px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { padding: 12px; border-bottom: 1px solid #233247; text-align: left; }
        .status { text-transform: capitalize; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 999px; font-size: 12px; }
        .badge.pending { background: #f59e0b; color: #111827; }
        .badge.approved { background: #10b981; color: #052e16; }
        .badge.rejected { background: #ef4444; color: #fff1f2; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Withdrawal History</h2>
        <p>Here are your recent withdrawal requests.</p>
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($withdrawals as $withdrawal)
                    <tr>
                        <td>{{ $withdrawal->transaction_id }}</td>
                        <td>${{ number_format($withdrawal->amount, 2) }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $withdrawal->method)) }}</td>
                        <td><span class="badge {{ $withdrawal->status }}">{{ ucfirst($withdrawal->status) }}</span></td>
                        <td>{{ $withdrawal->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No withdrawals yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
