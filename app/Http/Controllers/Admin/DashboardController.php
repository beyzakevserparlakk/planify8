<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Etkinlik;
use App\Models\Slider;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events'    => Etkinlik::count(),
            'approved_events' => Etkinlik::where('status', 'approved')->count(),
            'pending_events'  => Etkinlik::where('status', 'pending')->count(),
            'rejected_events' => Etkinlik::where('status', 'rejected')->count(),
            'total_users'     => User::count(),
            'total_sliders'   => Slider::count(),
            'total_views'     => Etkinlik::sum('views') ?? 0,
        ];

        $latestEvents = Etkinlik::latest()->take(7)->get();
        $latestUsers  = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestEvents', 'latestUsers'));
    }
}
