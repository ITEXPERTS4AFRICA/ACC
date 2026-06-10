<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next, string ...$roles) {
        if (!Auth::check() || !Auth::user()->active) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // Doit être admin ou editor
        if (!$user->isAdmin() && !$user->isEditor()) {
            return redirect()->route('admin.login');
        }

        // Si un rôle spécifique est requis (ex: middleware('admin:admin'))
        if (!empty($roles) && !in_array($user->role, $roles) && !$user->is_admin) {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
