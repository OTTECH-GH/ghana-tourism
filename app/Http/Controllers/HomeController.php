<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Region;
use App\Models\TourismCategory;
use App\Models\TourismSite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredSites = TourismSite::where('is_featured', true)
            ->where('is_active', true)
            ->with(['category', 'region'])
            ->take(8)
            ->get();

        $categories = TourismCategory::withCount('tourismSites')->get();
        $regions = Region::withCount('tourismSites')->get();
        $featuredHotels = Hotel::where('status', 'approved')
            ->where('is_featured', true)
            ->with(['region', 'rooms'])
            ->take(4)
            ->get();

        return view('home', compact('featuredSites', 'categories', 'regions', 'featuredHotels'));
    }

    public function search(Request $request)
    {
        $query = TourismSite::where('is_active', true)->with(['category', 'region']);

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('region')) {
            $query->where('region_id', $request->region);
        }

        $sites = $query->paginate(12);
        $categories = TourismCategory::all();
        $regions = Region::all();

        return view('search', compact('sites', 'categories', 'regions'));
    }
}
