<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\TourismCategory;
use App\Models\TourismSite;
use App\Models\TourismSiteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourismSiteController extends Controller
{
    public function index()
    {
        $sites = TourismSite::with(['category', 'region'])->latest()->paginate(15);
        return view('admin.tourism-sites.index', compact('sites'));
    }

    public function create()
    {
        $categories = TourismCategory::all();
        $regions = Region::all();
        return view('admin.tourism-sites.create', compact('categories', 'regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:tourism_categories,id',
            'region_id' => 'required|exists:regions,id',
            'description' => 'required|string',
            'history' => 'nullable|string',
            'entry_fee' => 'required|numeric|min:0',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'rules' => 'nullable|string',
            'safety_info' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;
        $validated['opening_days'] = $request->input('opening_days', []);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('tourism-sites', 'public');
        }

        TourismSite::create($validated);

        return redirect()->route('admin.tourism-sites.index')->with('success', 'Tourism site created successfully.');
    }

    public function edit(TourismSite $tourismSite)
    {
        $categories = TourismCategory::all();
        $regions = Region::all();
        return view('admin.tourism-sites.edit', compact('tourismSite', 'categories', 'regions'));
    }

    public function update(Request $request, TourismSite $tourismSite)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:tourism_categories,id',
            'region_id' => 'required|exists:regions,id',
            'description' => 'required|string',
            'history' => 'nullable|string',
            'entry_fee' => 'required|numeric|min:0',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'rules' => 'nullable|string',
            'safety_info' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['opening_days'] = $request->input('opening_days', []);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('tourism-sites', 'public');
        }

        $tourismSite->update($validated);

        return redirect()->route('admin.tourism-sites.index')->with('success', 'Tourism site updated successfully.');
    }

    public function destroy(TourismSite $tourismSite)
    {
        $tourismSite->delete();
        return redirect()->route('admin.tourism-sites.index')->with('success', 'Tourism site deleted.');
    }
}
