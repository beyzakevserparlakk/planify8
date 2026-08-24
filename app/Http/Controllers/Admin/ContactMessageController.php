<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = ContactMessage::query()->latest();

        if ($status === 'unread') {
            $query->unread();
        } elseif ($status === 'read') {
            $query->read();
        }

        $messages = $query->paginate(15)->withQueryString();

        $unreadCount = ContactMessage::unread()->count();
        $totalCount  = ContactMessage::count();

        return view('admin.messages.index', compact('messages', 'status', 'unreadCount', 'totalCount'));
    }

    /**
     * Display the specified contact message.
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Toggle read status of a message.
     */
    public function toggleRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => !$message->is_read]);

        return back()->with('success', 'Mesaj durumu güncellendi.');
    }

    /**
     * Remove the specified message.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Mesaj başarıyla silindi.');
    }
}
