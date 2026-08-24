<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Etkinlik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Etkinlik::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('source_type')) {
            $query->where('source_type', $request->source_type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
            });
        }

        $events = $query->latest()->paginate(15)->withQueryString();

        $counts = [
            'all'      => Etkinlik::count(),
            'pending'  => Etkinlik::where('status', 'pending')->count(),
            'approved' => Etkinlik::where('status', 'approved')->count(),
            'rejected' => Etkinlik::where('status', 'rejected')->count(),
        ];

        return view('admin.events.index', compact('events', 'counts'));
    }

    public function create()
    {
        $cities       = City::orderBy('name')->pluck('name', 'id');
        $allDistricts = District::orderBy('name')->get();

        return view('admin.events.create', compact('cities', 'allDistricts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'location'    => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
            'cost'        => 'nullable|string|max:100',
            'date'        => 'nullable|date',
            'city_id'     => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'source_type' => 'required|in:user,official',
            'status'      => 'required|in:pending,approved,rejected',
        ]);

        $data = [
            'title'       => $validated['title'],
            'content'     => $validated['content'] ?? null,
            'location'    => $validated['location'] ?? null,
            'category'    => $validated['category'] ?? null,
            'cost'        => $validated['cost'] ?? null,
            'date'        => $validated['date'] ?? null,
            'user_id'     => auth()->id(),
            'source_type' => $validated['source_type'],
            'status'      => $validated['status'],
            'is_active'   => true,
        ];

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

        Etkinlik::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Etkinlik başarıyla oluşturuldu.');
    }

    public function edit(int $id)
    {
        $event        = Etkinlik::findOrFail($id);
        $cities       = City::orderBy('name')->pluck('name', 'id');
        $allDistricts = District::orderBy('name')->get();

        return view('admin.events.edit', compact('event', 'cities', 'allDistricts'));
    }

    public function update(Request $request, int $id)
    {
        $event = Etkinlik::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'location'    => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
            'cost'        => 'nullable|string|max:100',
            'date'        => 'nullable|date',
            'city'        => 'nullable|string|max:255',
            'district'    => 'nullable|string|max:255',
            'city_id'     => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'source_type' => 'required|in:user,official',
            'status'      => 'required|in:pending,approved,rejected',
        ]);

        $data = [
            'title'       => $validated['title'],
            'content'     => $validated['content'] ?? null,
            'location'    => $validated['location'] ?? null,
            'category'    => $validated['category'] ?? null,
            'cost'        => $validated['cost'] ?? null,
            'date'        => $validated['date'] ?? null,
            'source_type' => $validated['source_type'],
            'status'      => $validated['status'],
        ];

        if (!empty($validated['city_id'])) {
            $city = City::find($validated['city_id']);
            $data['city'] = $city ? $city->name : $event->city;
        } elseif ($request->has('city')) {
            $data['city'] = $request->city;
        }

        if (!empty($validated['district_id'])) {
            $district = District::find($validated['district_id']);
            $data['district'] = $district ? $district->name : $event->district;
        } elseif ($request->has('district')) {
            $data['district'] = $request->district;
        }

        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('etkinlikler', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Etkinlik başarıyla güncellendi.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $event = Etkinlik::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $event->update(['status' => $request->status]);

        return back()->with('success', "Etkinlik durumu '{$request->status}' olarak güncellendi.");
    }

    public function destroy(int $id)
    {
        $event = Etkinlik::findOrFail($id);

        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Etkinlik silindi.');
    }
}
