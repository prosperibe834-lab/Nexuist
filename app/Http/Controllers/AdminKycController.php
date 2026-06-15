<?php
namespace App\Http\Controllers;

use App\Models\KycVerification;
use App\Models\User;
use Illuminate\Http\Request;

class AdminKycController extends Controller
{
    public function index()
    {
        $kycs = KycVerification::latest()->get();

        return view('AdminDashboard.kyc', compact('kycs'));
    }

    public function approve($id)
    {
        $kyc = KycVerification::findOrFail($id);

        $kyc->update([
            'status' => 'approved',
        ]);

        User::find($kyc->user_id)
            ->update([
                'kyc_status' => 'approved',
            ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function reject($id)
    {
        $kyc = KycVerification::findOrFail($id);

        $kyc->update([
            'status' => 'rejected',
        ]);

        User::find($kyc->user_id)
            ->update([
                'kyc_status' => 'rejected',
            ]);

        return response()->json([
            'success' => true,
        ]);
    }


    public function getKycData()
{
    return response()->json(
        KycVerification::latest()->get()
    );
}

public function updateStatus(Request $request, $id)
{
    $kyc = KycVerification::findOrFail($id);

    $kyc->status = $request->status;
    $kyc->save();

    User::where('id', $kyc->user_id)
        ->update([
            'kyc_status' => $request->status
        ]);

    return response()->json([
        'success' => true,
        'message' => 'Status updated successfully'
    ]);
}

}
