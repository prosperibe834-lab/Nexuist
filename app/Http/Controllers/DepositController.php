<?php
namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
public function index()
{
    $pendingVolume = Deposit::where('status', 'Pending')->sum('amount');

    $pendingCount = Deposit::where('status', 'Pending')->count();

    $successfulInflows = Deposit::where('status', 'Approved')
        ->where('created_at', '>=', now()->subDays(30))
        ->sum('amount');

    $mostUsedGateway = Deposit::selectRaw('method, COUNT(*) as total')
        ->groupBy('method')
        ->orderByDesc('total')
        ->first();

    $totalDeposits = Deposit::count();

    $gatewayPercentage = $mostUsedGateway && $totalDeposits > 0
        ? round(($mostUsedGateway->total / $totalDeposits) * 100)
        : 0;

    // Current month approved deposits
    $currentMonth = Deposit::where('status', 'Approved')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('amount');

    // Previous month approved deposits
    $previousMonth = Deposit::where('status', now()->subMonth()->month)
        ->whereMonth('created_at', now()->subMonth()->month)
        ->whereYear('created_at', now()->subMonth()->year)
        ->sum('amount');

    $growthPercentage = 0;

    if ($previousMonth > 0) {
        $growthPercentage = round(
            (($currentMonth - $previousMonth) / $previousMonth) * 100,
            1
        );
    }

    return view('AdminDashboard.deposits', [
        'deposits' => Deposit::with('user')->latest()->get(),
        'pendingVolume' => $pendingVolume,
        'pendingCount' => $pendingCount,
        'successfulInflows' => $successfulInflows,
        'mostUsedGateway' => $mostUsedGateway,
        'gatewayPercentage' => $gatewayPercentage,
        'growthPercentage' => $growthPercentage,
    ]);
}
    public function updateStatus(Request $request)
    {
        $request->validate([
            'txid'   => 'required',
            'status' => 'required|in:Approved,Rejected',
        ]);

        $deposit = Deposit::where('txid', $request->txid)->first();

        if (! $deposit) {
            return response()->json([
                'success' => false,
                'message' => 'Deposit not found',
            ], 404);
        }

        // APPROVE DEPOSIT
        if ($request->status === 'Approved') {

            // Prevent double approval
            if ($deposit->status === 'Approved') {
                return response()->json([
                    'success' => false,
                    'message' => 'Deposit already approved',
                ]);
            }

            $user = $deposit->user;

            if ($user) {
                $user->balance += $deposit->amount;
                $user->save();

                UserNotification::createForUser(
                    $user,
                    'Deposit Approved',
                    'Your deposit of $' . number_format($deposit->amount, 2) . ' has been approved and added to your account.'
                );
            }

            $deposit->status = 'Approved';
            $deposit->save();

            return response()->json([
                'success' => true,
                'message' => 'Deposit approved successfully',
            ]);
        }

        // REJECT DEPOSIT
        if ($request->status === 'Rejected') {
            $user = $deposit->user;

            // delete uploaded proof image
            if ($deposit->proof_image) {
                $filePath = public_path('storage/' . $deposit->proof_image);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            if ($user) {
                UserNotification::createForUser(
                    $user,
                    'Deposit Rejected',
                    'Your deposit request for $' . number_format($deposit->amount, 2) . ' has been rejected and removed.'
                );
            }

            $deposit->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deposit rejected and removed',
            ]);
        }
    }

    public function store(Request $request)
    {
        // Check authentication
        if (! Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // 1. Validate
        $request->validate([
            'amount'  => 'required|numeric|min:1',
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'method'  => 'required|string',
        ]);

        // 2. Handle File
        $path = null;
        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('deposits', 'public');
        }

        // 3. Create Record
        try {
            $deposit = Deposit::create([
                'user_id'     => Auth::id(),
                'txid'        => 'TXN-' . strtoupper(uniqid()),
                'amount'      => $request->amount,
                'method'      => $request->input('method'),
                'proof_image' => $path,
                'status'      => 'Pending',
            ]);

            UserNotification::createForUser(
                Auth::user(),
                'Deposit',
                'Your deposit request of $' . number_format($deposit->amount, 2) . ' has been received and is pending approval.'
            );

            return response()->json(['success' => true, 'message' => 'Deposit recorded!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Database error: ' . $e->getMessage()], 500);
        }
    }
}
