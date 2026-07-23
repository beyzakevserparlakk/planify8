<?php

namespace App\Http\Controllers;

use App\Models\Etkinlik;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->get();

        $latestEtkinlikler = Etkinlik::approved()
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('sliders', 'latestEtkinlikler'));
    }
}
