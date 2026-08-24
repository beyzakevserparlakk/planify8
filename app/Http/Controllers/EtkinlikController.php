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

        $query = Etkinlik::approved();

        // Filtreler
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('source_type')) {
            $query->where('source_type', $request->source_type);
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('district')) {
            $query->where('district', $request->district);
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
        $cities       = City::orderBy('name')->pluck('name', 'id');
        $allDistricts = District::orderBy('name')->get();

        return view('etkinlikler.create', compact('cities', 'allDistricts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'location'    => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
            'cost'        => 'nullable|string|max:100',
            'date'        => 'nullable|date',
            'city_id'     => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
        ]);

        $data = [
            'title'       => $validated['title'],
            'content'     => $validated['description'] ?? $validated['content'] ?? null,
            'location'    => $validated['location'] ?? null,
            'category'    => $validated['category'] ?? null,
            'cost'        => $validated['cost'] ?? null,
            'date'        => $validated['date'] ?? null,
            'user_id'     => auth()->id(),
            'source_type' => 'user',
            'is_active'   => true,
        ];

        $isAdmin = auth()->user() && (auth()->user()->is_admin || auth()->user()->role === 'admin');
        $data['status'] = $isAdmin ? 'approved' : 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('etkinlikler', 'public');
        }

        if (!empty($validated['city_id'])) {
            $city = City::find($validated['city_id']);
            $data['city'] = $city ? $city->name : null;
        }

        if (!empty($validated['district_id'])) {
            $district = District::find($validated['district_id']);
            $data['district'] = $district ? $district->name : null;
        }

        $etkinlik = Etkinlik::create($data);

        if ($data['status'] === 'approved') {
            return redirect()->route('etkinlikler.show', $etkinlik->slug)
                ->with('success', 'Planınız başarıyla yayınlandı!');
        }

        return redirect()->route('etkinlikler.index')
            ->with('success', 'Harika! Etkinlik veya mekan öneriniz başarıyla oluşturuldu ve yönetici onayına gönderildi. Onaylandıktan sonra ana sayfada listelenecektir.');
    }

    public function show(string $slug)
    {
        $etkinlik = Etkinlik::where('slug', $slug)->firstOrFail();
        $etkinlik->increment('views');

        $relatedEtkinlikler = Etkinlik::approved()
            ->where('id', '!=', $etkinlik->id)
            ->where(function ($q) use ($etkinlik) {
                if ($etkinlik->category) {
                    $q->where('category', $etkinlik->category);
                }
                if ($etkinlik->city) {
                    $q->orWhere('city', $etkinlik->city);
                }
            })
            ->latest()
            ->take(3)
            ->get();

        if ($relatedEtkinlikler->isEmpty()) {
            $relatedEtkinlikler = Etkinlik::approved()
                ->where('id', '!=', $etkinlik->id)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('etkinlikler.show', compact('etkinlik', 'relatedEtkinlikler'));
    }
}
