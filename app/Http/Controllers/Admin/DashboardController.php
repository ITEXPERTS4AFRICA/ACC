<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product, Factory, Article, ContactMessage, Certification, MediaFile};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function loginForm()
    {
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isEditor())) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            if (!$user->isAdmin() && !$user->isEditor()) {
                Auth::logout();
                return back()->withErrors(['email' => 'Accès non autorisé.']);
            }
            if (!$user->active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Compte désactivé.']);
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        $stats = [
            'products' => Product::where('active', true)->count(),
            'factories' => Factory::count(),
            'articles' => Article::where('published', true)->count(),
            'certifications' => Certification::count(),
            'messages' => ContactMessage::where('read', false)->count(),
        ];

        $latestMessages = ContactMessage::latest()->limit(5)->get();

        // Data for Chart.js (Monthly articles/messages)
        $chartData = [
            'labels' => [],
            'articles' => [],
            'messages' => [],
        ];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabel = $date->translatedFormat('M');
            $chartData['labels'][] = $monthLabel;
            $chartData['articles'][] = Article::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
            $chartData['messages'][] = ContactMessage::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
        }

        // Data for FullCalendar
        $calendarEvents = [];

        // Articles
        Article::all()->each(function ($a) use (&$calendarEvents) {
            $calendarEvents[] = [
                'title' => '📰 ' . Str::limit($a->title, 20),
                'start' => $a->created_at->toIso8601String(),
                'url' => route('admin.articles.edit', $a),
                'color' => '#1e293b', // Navy
            ];
        });

        // Messages
        ContactMessage::all()->each(function ($m) use (&$calendarEvents) {
            $calendarEvents[] = [
                'title' => '✉️ ' . Str::limit($m->name, 20),
                'start' => $m->created_at->toIso8601String(),
                'url' => route('admin.messages.show', $m),
                'color' => '#b45309', // Amber
            ];
        });

        // Activité récente
        $recentActivity = collect();
        Article::latest('updated_at')->limit(3)->get()->each(function ($a) use (&$recentActivity) {
            $recentActivity->push([
                'icon' => '📰',
                'label' => 'Article : ' . Str::limit($a->title, 45),
                'time' => $a->updated_at,
                'badge' => $a->published ? 'Publié' : 'Brouillon',
                'badge_class' => $a->published ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700',
            ]);
        });

        Product::latest('updated_at')->limit(2)->get()->each(function ($p) use (&$recentActivity) {
            $recentActivity->push([
                'icon' => '📦',
                'label' => 'Produit : ' . $p->name,
                'time' => $p->updated_at,
                'badge' => $p->active ? 'Actif' : 'Inactif',
                'badge_class' => $p->active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500',
            ]);
        });

        $recentActivity = $recentActivity->sortByDesc('time')->take(6)->values();

        return view('admin.dashboard', compact('stats', 'latestMessages', 'recentActivity', 'chartData', 'calendarEvents'));
    }
}
