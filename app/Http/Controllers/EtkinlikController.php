<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Etkinlik;
use App\Models\Slider;
use Illuminate\Http\Request;

class EtkinlikController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::active()->get();

        $query = Etkinlik::approved()->with(['city', 'district']);

        // Filtreler
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('source_type')) {
            $query->where('source_type', $request->source_type);
        }

        if ($request->filled('city')) {
            $query->whereHas('city', fn($q) => $q->where('name', $request->city));
        }

        if ($request->filled('district')) {
            $query->whereHas('district', fn($q) => $q->where('name', $request->district));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $etkinlikler = $query->latest()->paginate(12)->withQueryString();

        $cities    = City::orderBy('name')->pluck('name', 'id');
        $districts = District::when($request->filled('city'), function ($q) use ($request) {
            $q->whereHas('city', fn($c) => $c->where('name', $request->city));
        })->orderBy('name')->pluck('name', 'id');

        $allDistricts = District::with('city')->get();

        return view('etkinlikler.index', compact(
            'sliders',
            'etkinlikler',
            'cities',
            'districts',
            'allDistricts'
        ));
    }

    public function create()
    {
        $cities = City::orderBy('name')->pluck('name', 'id');
        return view('etkinlikler.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'location'    => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
            'cost'        => 'nullable|string|max:100',
            'date'        => 'nullable|date',
            'city_id'     => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('etkinlikler', 'public');
        }

        $validated['user_id']     = auth()->id();
        $validated['source_type'] = 'user';
        $validated['status']      = 'pending';

        Etkinlik::create($validated);

        return redirect()->route('etkinlikler.index')
            ->with('success', 'Etkinliğiniz incelemeye alındı.');
    }

    public function show(string $slug)
    {
        $etkinlik = Etkinlik::where('slug', $slug)->firstOrFail();
        return view('etkinlikler.show', compact('etkinlik'));
    }
}
