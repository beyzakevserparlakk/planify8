<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Handle incoming contact form submission.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:5', 'max:3000'],
        ], [
            'name.required'    => 'Lütfen adınızı ve soyadınızı belirtin.',
            'email.required'   => 'Lütfen e-posta adresinizi girin.',
            'email.email'      => 'Lütfen geçerli bir e-posta adresi girin.',
            'message.required' => 'Lütfen iletmek istediğiniz mesajı yazın.',
            'message.min'      => 'Mesajınız en az 5 karakter olmalıdır.',
        ]);

        $validated['ip_address'] = $request->ip();

        ContactMessage::create($validated);

        return back()->with('success', 'Mesajınız bize ulaştı! En kısa sürede sizinle iletişime geçeceğiz.');
    }
}
