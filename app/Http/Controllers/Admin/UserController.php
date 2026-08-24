<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Kendi yönetici yetkinizi değiştiremezsiniz.');
        }

        $user->is_admin = !$user->is_admin;
        $user->role     = $user->is_admin ? 'admin' : 'user';
        $user->save();

        $statusText = $user->is_admin ? 'Yönetici (Admin)' : 'Normal Kullanıcı';

        return back()->with('success', "{$user->name} artık {$statusText} olarak ayarlandı.");
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Kendi hesabınızı silemezsiniz.');
        }

        $user->delete();

        return back()->with('success', 'Kullanıcı silindi.');
    }
}
