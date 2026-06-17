<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CryptoPlan;

class CryptoController extends Controller
{
    public function storePlan(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'tier' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'minimum_investment' => 'required|numeric|min:0',
            'maximum_investment' => 'required|numeric|min:0',
            'daily_roi' => 'nullable|numeric',
            'duration_days' => 'nullable|integer',
            'bonus' => 'nullable|numeric',
        ]);

        $plan = CryptoPlan::create([
            'name' => $data['name'],
            'tier' => $data['tier'] ?? null,
            'description' => $data['description'] ?? null,
            'minimum_investment' => $data['minimum_investment'],
            'maximum_investment' => $data['maximum_investment'],
            'daily_roi' => $data['daily_roi'] ?? 0,
            'duration_days' => $data['duration_days'] ?? 30,
            'bonus' => $data['bonus'] ?? 0,
            'status' => 'Active',
        ]);

        return response()->json(['success' => true, 'plan' => $plan]);
    }

    public function toggleStatus(Request $request, $id)
    {
        $plan = CryptoPlan::findOrFail($id);
        $plan->status = $plan->status === 'Active' ? 'Inactive' : 'Active';
        $plan->save();

        return response()->json(['success' => true, 'plan' => $plan]);
    }

    public function destroy(Request $request, $id)
    {
        $plan = CryptoPlan::findOrFail($id);
        $plan->delete();
        return response()->json(['success' => true]);
    }
}
