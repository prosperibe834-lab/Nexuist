<?php

namespace App\Http\Controllers;

use App\Models\RealEstateProperty;
use Illuminate\Http\Request;

class RealEstatePropertyController extends Controller
{
    public function index(Request $request)
    {
        RealEstateProperty::seedDemoProperties();

        $properties = RealEstateProperty::query()
            ->active()
            ->with('galleries')
            ->filter($request)
            ->latest()
            ->paginate(12);

        return response()->json($properties);
    }

    public function show($slug)
    {
        $property = RealEstateProperty::with(['galleries', 'investments.user'])
            ->where('slug', $slug)
            ->where('property_status', 'Active')
            ->firstOrFail();

        return response()->json($property);
    }
}
