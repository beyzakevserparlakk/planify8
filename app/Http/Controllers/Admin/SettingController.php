<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings management view.
     */
    public function index()
    {
        $settings = Setting::getAll();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update site and contact/social settings.
     */
    public function update(Request $request)
    {
        $fields = [
            // İletişim Bilgileri
            'contact_email'         => 'contact',
            'contact_phone'         => 'contact',
            'contact_whatsapp'      => 'contact',
            'contact_address'       => 'contact',
            'contact_working_hours' => 'contact',
            'contact_description'   => 'contact',
            'contact_map_iframe'    => 'contact',

            // Sosyal Medya Hesapları
            'social_instagram'      => 'social',
            'social_twitter'        => 'social',
            'social_youtube'        => 'social',
            'social_linkedin'       => 'social',
            'social_facebook'       => 'social',
            'social_tiktok'         => 'social',
            'social_telegram'       => 'social',

            // Site Genel
            'site_title'            => 'general',
            'site_tagline'          => 'general',
            'footer_about'          => 'general',
        ];

        foreach ($fields as $field => $group) {
            Setting::set($field, $request->input($field, ''), $group);
        }

        Setting::clearCache();

        return back()->with('success', 'İletişim ve sosyal medya ayarları başarıyla kaydedildi.');
    }
}
