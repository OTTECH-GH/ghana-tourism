<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Region;
use App\Models\TourismCategory;
use App\Models\TourismSite;
use Illuminate\Http\Request;

class TourismSiteController extends Controller
{
    public function index(Request $request)
    {
        $query = TourismSite::where('is_active', true)->with(['category', 'region']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('region')) {
            $query->where('region_id', $request->region);
        }

        $sites = $query->orderBy('is_featured', 'desc')->paginate(12);
        $categories = TourismCategory::all();
        $regions = Region::all();

        return view('tourism.index', compact('sites', 'categories', 'regions'));
    }

    public function show(TourismSite $tourismSite)
    {
        $tourismSite->load(['category', 'region', 'district', 'images', 'reviews.user', 'hotels.rooms']);

        $nearbyHotels = Hotel::where('status', 'approved')
            ->where('region_id', $tourismSite->region_id)
            ->with('rooms')
            ->take(4)
            ->get();

        $relatedSites = TourismSite::where('is_active', true)
            ->where('id', '!=', $tourismSite->id)
            ->where(function ($q) use ($tourismSite) {
                $q->where('category_id', $tourismSite->category_id)
                    ->orWhere('region_id', $tourismSite->region_id);
            })
            ->take(4)
            ->get();

        return view('tourism.show', compact('tourismSite', 'nearbyHotels', 'relatedSites'));
    }

    public function byRegion(Region $region)
    {
        $sites = TourismSite::where('region_id', $region->id)
            ->where('is_active', true)
            ->with(['category'])
            ->paginate(12);

        return view('tourism.region', compact('region', 'sites'));
    }

    public function byCategory(TourismCategory $category)
    {
        $sites = TourismSite::where('category_id', $category->id)
            ->where('is_active', true)
            ->with(['region'])
            ->paginate(12);

        return view('tourism.category', compact('category', 'sites'));
    }
}
