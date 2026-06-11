<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }
    public function create() {
        return view('admin.users.form', ['user' => new User]);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)],
            'role'     => 'required|in:admin,editor',
            'active'   => 'boolean',
        ]);
        $data['is_admin'] = $data['role'] === 'admin';
        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé.');
    }
    public function edit(User $user) {
        return view('admin.users.form', compact('user'));
    }
    public function update(Request $request, User $user) {
        $data = $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'password' => ['nullable', Password::min(8)],
            'role'     => 'required|in:admin,editor',
            'active'   => 'boolean',
        ]);
        if (empty($data['password'])) unset($data['password']);
        $data['is_admin'] = $data['role'] === 'admin';
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour.');
    }
    public function destroy(User $user) {
        if ($user->id === auth()->id()) return back()->with('error', 'Impossible de supprimer votre propre compte.');
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }
    public function toggle(User $user) {
        if ($user->id === auth()->id()) return back()->with('error', 'Impossible de désactiver votre propre compte.');
        $user->update(['active' => !$user->active]);
        return back()->with('success', 'Statut mis à jour.');
    }
}
