<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRealEstatePropertyRequest;
use App\Http\Requests\UpdateRealEstatePropertyRequest;
use App\Models\PropertyGallery;
use App\Models\RealEstateInvestment;
use App\Models\RealEstateProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RealEstatePropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = RealEstateProperty::query();

        if ($request->filled('search')) {
            $term = '%' . $request->input('search') . '%';
            $query->where(function ($subQuery) use ($term) {
                $subQuery->where('property_name', 'LIKE', $term)
                    ->orWhere('city', 'LIKE', $term)
                    ->orWhere('state', 'LIKE', $term)
                    ->orWhere('country', 'LIKE', $term);
            });
        }

        if ($request->filled('property_type')) {
            $query->where('property_type', $request->input('property_type'));
        }

        if ($request->filled('status')) {
            $query->where('property_status', $request->input('status'));
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }

        if ($request->filled('apy_min')) {
            $query->where('estimated_apy', '>=', $request->input('apy_min'));
        }

        if ($request->filled('apy_max')) {
            $query->where('estimated_apy', '<=', $request->input('apy_max'));
        }

        if ($request->filled('investment_min')) {
            $query->where('minimum_investment', '>=', $request->input('investment_min'));
        }

        if ($request->filled('investment_max')) {
            $query->where('maximum_investment', '<=', $request->input('investment_max'));
        }

        $properties = $query->with('galleries')->latest()->paginate(20);

        return response()->json($properties);
    }

    public function stats()
    {
        $properties = RealEstateProperty::with('investments')->get();

        $totalProperties = $properties->count();
        $activeProperties = $properties->where('property_status', 'Active')->count();
        $totalInvestors = RealEstateInvestment::distinct('user_id')->count('user_id');
        $totalCapitalRaised = RealEstateInvestment::sum('investment_amount');
        $totalTokensSold = RealEstateInvestment::sum('tokens_purchased');
        $totalTokensAvailable = RealEstateProperty::sum('available_tokens');
        $averageApy = $properties->count() ? round($properties->avg('estimated_apy'), 2) : 0;
        $recentInvestments = RealEstateInvestment::with(['user', 'property'])->latest()->take(10)->get();

        return response()->json([
            'total_properties' => $totalProperties,
            'active_properties' => $activeProperties,
            'total_investors' => $totalInvestors,
            'total_capital_raised' => $totalCapitalRaised,
            'total_tokens_sold' => $totalTokensSold,
            'total_tokens_available' => $totalTokensAvailable,
            'average_apy' => $averageApy,
            'recent_investments' => $recentInvestments,
        ]);
    }

    public function investments(Request $request)
    {
        $query = RealEstateInvestment::with(['user', 'property'])->latest();

        if ($request->filled('status')) {
            $query->where('investment_status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $term = '%' . $request->input('search') . '%';
            $query->where(function ($subQuery) use ($term) {
                $subQuery->whereHas('user', function ($q) use ($term) {
                    $q->where('name', 'LIKE', $term)
                        ->orWhere('email', 'LIKE', $term);
                })
                ->orWhereHas('property', function ($q) use ($term) {
                    $q->where('property_name', 'LIKE', $term);
                });
            });
        }

        $investments = $query->get();

        return response()->json($investments);
    }

    public function store(StoreRealEstatePropertyRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $slug = Str::slug($data['property_name']);
            $slugCount = RealEstateProperty::where('slug', 'LIKE', "$slug%")->count();
            if ($slugCount) {
                $slug = $slug . '-' . ($slugCount + 1);
            }

            $property = RealEstateProperty::create([
                'property_name' => $data['property_name'],
                'slug' => $slug,
                'property_type' => $data['property_type'],
                'description' => $data['description'],
                'country' => $data['country'],
                'state' => $data['state'],
                'city' => $data['city'],
                'address' => $data['address'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'living_rooms' => $data['living_rooms'],
                'kitchens' => $data['kitchens'],
                'parking_spaces' => $data['parking_spaces'],
                'property_size' => $data['property_size'],
                'year_built' => $data['year_built'],
                'market_value' => $data['market_value'],
                'token_price' => $data['token_price'],
                'total_tokens' => $data['total_tokens'],
                'available_tokens' => $data['total_tokens'],
                'sold_tokens' => 0,
                'minimum_investment' => $data['minimum_investment'],
                'maximum_investment' => $data['maximum_investment'],
                'estimated_apy' => $data['estimated_apy'],
                'expected_annual_return' => $data['expected_annual_return'] ?? round($data['market_value'] * ($data['estimated_apy'] / 100), 2),
                'property_status' => $data['property_status'],
                'featured_property' => $data['featured_property'] ?? false,
                'main_image' => $this->uploadMainImage($request),
            ]);

            $this->saveGalleryImages($property, $request);

            DB::commit();

            return response()->json(['success' => true, 'property' => $property]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('RealEstateProperty store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Could not create property.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $property = RealEstateProperty::with(['galleries', 'investments.user'])->findOrFail($id);

        return response()->json($property);
    }

    public function update(UpdateRealEstatePropertyRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $property = RealEstateProperty::findOrFail($id);
            $data = $request->validated();

            $property->fill([
                'property_name' => $data['property_name'],
                'property_type' => $data['property_type'],
                'description' => $data['description'],
                'country' => $data['country'],
                'state' => $data['state'],
                'city' => $data['city'],
                'address' => $data['address'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'living_rooms' => $data['living_rooms'],
                'kitchens' => $data['kitchens'],
                'parking_spaces' => $data['parking_spaces'],
                'property_size' => $data['property_size'],
                'year_built' => $data['year_built'],
                'market_value' => $data['market_value'],
                'token_price' => $data['token_price'],
                'total_tokens' => $data['total_tokens'],
                'minimum_investment' => $data['minimum_investment'],
                'maximum_investment' => $data['maximum_investment'],
                'estimated_apy' => $data['estimated_apy'],
                'expected_annual_return' => $data['expected_annual_return'] ?? round($data['market_value'] * ($data['estimated_apy'] / 100), 2),
                'property_status' => $data['property_status'],
                'featured_property' => $data['featured_property'] ?? false,
            ]);

            if ($request->hasFile('main_image_file')) {
                $property->main_image = $this->uploadMainImage($request);
            } elseif (! empty($data['main_image'])) {
                $property->main_image = $data['main_image'];
            }

            $property->available_tokens = max(0, $data['total_tokens'] - $property->sold_tokens);
            if ($property->available_tokens <= 0) {
                $property->available_tokens = 0;
                $property->property_status = 'Sold Out';
            }

            $property->save();
            $this->saveGalleryImages($property, $request, true);

            DB::commit();

            return response()->json(['success' => true, 'property' => $property]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('RealEstateProperty update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Could not update property.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $property = RealEstateProperty::findOrFail($id);
            $property->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not delete property.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $property = RealEstateProperty::findOrFail($id);
        $newStatus = $request->input('status');

        if ($newStatus && in_array($newStatus, ['Active', 'Upcoming', 'Under Review', 'Suspended', 'Sold Out'])) {
            $property->property_status = $newStatus;
        } else {
            $property->property_status = $property->property_status === 'Active' ? 'Suspended' : 'Active';
        }

        if ($property->available_tokens <= 0) {
            $property->property_status = 'Sold Out';
        }

        $property->save();

        return response()->json(['success' => true, 'property' => $property]);
    }

    private function uploadMainImage(Request $request)
    {
        if ($request->hasFile('main_image_file')) {
            $destination = public_path('uploads/realestate');
            if (! is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            $file = $request->file('main_image_file');
            $name = time() . '_' . preg_replace('/[^A-Za-z0-9_\.-]/', '_', $file->getClientOriginalName());
            $file->move($destination, $name);

            return 'uploads/realestate/' . $name;
        }

        return $request->input('main_image');
    }

    private function saveGalleryImages(RealEstateProperty $property, Request $request, bool $replaceExisting = false): void
    {
        if ($replaceExisting && ($request->has('gallery_urls') || $request->hasFile('gallery_images'))) {
            $property->galleries()->delete();
        }

        if ($request->filled('gallery_urls')) {
            $urls = collect(explode(',', $request->input('gallery_urls')))
                ->map(fn ($value) => trim($value))
                ->filter();

            foreach ($urls as $url) {
                $property->galleries()->create(['image' => $url]);
            }
        }

        if ($request->hasFile('gallery_images')) {
            $destination = public_path('uploads/realestate/gallery');
            if (! is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            foreach ($request->file('gallery_images') as $file) {
                $name = time() . '_' . preg_replace('/[^A-Za-z0-9_\.-]/', '_', $file->getClientOriginalName());
                $file->move($destination, $name);
                $property->galleries()->create(['image' => 'uploads/realestate/gallery/' . $name]);
            }
        }
    }
}
