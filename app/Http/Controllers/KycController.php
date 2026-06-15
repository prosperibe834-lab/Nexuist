<?php

namespace App\Http\Controllers;

use App\Models\KycVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'document_type' => 'required',
            'front_document' => 'required|image',
            'back_document' => 'required|image',
        ]);

        $frontImage = $request->file('front_document')
            ->store('kyc/front', 'public');

        $backImage = $request->file('back_document')
            ->store('kyc/back', 'public');

        KycVerification::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,

            'address' => $request->street_address,

            'city' => $request->city,
            'state' => $request->state,

            'document_type' => $request->document_type,

            'front_image' => $frontImage,
            'back_image' => $backImage,

            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'KYC submitted successfully'
        ]);
    }
}