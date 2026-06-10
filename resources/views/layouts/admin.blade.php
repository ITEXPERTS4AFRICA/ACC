<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') — ACC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('head')
</head>
<body class="h-full bg-[#F5EFE6] font-inter text-chocolate antialiased" x-data="{ sidebarOpen: false }">

{{-- ═══════════════ SIDEBAR ═══════════════ --}}
<aside
    class="fixed inset-y-0 left-0 z-50 flex flex-col transition-transform duration-300"
    style="width:175px; background:#0F0806;"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>
    {{-- Logo --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10 flex-shrink-0" style="min-height:64px;">
        <img src="{{ asset('images/logo-acc.png') }}" alt="ACC"
             class="h-8 w-auto brightness-0 invert object-contain"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="hidden items-center justify-center bg-bordeaux rounded-sm px-2 py-1">
            <span class="text-white font-bold text-xs tracking-[3px]">ACC</span>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
        @php
        $locale = app()->getLocale();
        $user   = auth()->user();
        $navGroups = [
            'Contenu' => [
                ['route' => 'admin.dashboard',            'label' => 'Tableau de bord', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'exact' => true],
                ['route' => 'admin.pages.index',          'label' => 'Pages',            'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route' => 'admin.products.index',       'label' => 'Produits',         'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                ['route' => 'admin.factories.index',      'label' => 'Usines',           'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['route' => 'admin.articles.index',       'label' => 'Actualités',       'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['route' => 'admin.certifications.index', 'label' => 'Certifications',   'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['route' => 'admin.partners.index',       'label' => 'Partenaires',      'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ],
            'Médias & SEO' => [
                ['route' => 'admin.media.index',    'label' => 'Médiathèque', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route' => 'admin.seo.index',      'label' => 'SEO',         'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                ['route' => 'admin.messages.index', 'label' => 'Messages',    'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ],
        ];
        if ($user->canManageUsers()) {
            $navGroups['Administration'] = [
                ['route' => 'admin.users.index',    'label' => 'Utilisateurs', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['route' => 'admin.settings.index', 'label' => 'Paramètres',  'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ];
        }
        @endphp

        @foreach($navGroups as $groupLabel => $items)
        <div class="mb-4">
            <p class="text-white/30 text-[10px] uppercase tracking-widest font-semibold px-3 py-2">{{ $groupLabel }}</p>
            @foreach($items as $item)
            @php
                $isActive = isset($item['exact'])
                    ? request()->routeIs($item['route'])
                    : request()->routeIs(Str::beforeLast($item['route'], '.index').'*');
            @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-sm text-[13px] font-medium transition-all duration-150 group relative
                      {{ $isActive
                          ? 'bg-bordeaux/20 text-white border-l-2 border-bordeaux pl-[10px]'
                          : 'text-white/60 hover:text-white hover:bg-white/5 border-l-2 border-transparent pl-[10px]' }}">
                <svg class="w-4 h-4 flex-shrink-0 {{ $isActive ? 'text-bordeaux' : 'text-white/40 group-hover:text-white/70' }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                </svg>
                <span class="truncate">{{ $item['label'] }}</span>
                @if($item['route'] === 'admin.messages.index')
                @php $unread = \App\Models\ContactMessage::where('read', false)->count(); @endphp
                @if($unread > 0)
                <span class="ml-auto bg-bordeaux text-white text-[10px] font-bold rounded-sm px-1.5 py-0.5 leading-none">{{ $unread }}</span>
                @endif
                @endif
            </a>
            @endforeach
        </div>
        @endforeach
    </nav>

    {{-- User + Logout --}}
    <div class="flex-shrink-0 border-t border-white/10 px-3 py-4">
        <div class="flex items-center gap-2 mb-3 px-2">
            <div class="w-7 h-7 rounded-full bg-bordeaux flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            </div>
            <div class="min-w-0">
                <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-white/40 text-[10px] capitalize">{{ auth()->user()->role }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-2 px-3 py-2 text-[12px] text-white/50 hover:text-white hover:bg-white/5 rounded-sm transition border-l-2 border-transparent pl-[10px]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- Overlay mobile --}}
<div x-show="sidebarOpen" @click="sidebarOpen=false"
     class="fixed inset-0 z-40 bg-black/60 lg:hidden" x-transition.opacity></div>

{{-- ═══════════════ MAIN CONTENT ═══════════════ --}}
<div class="lg:pl-[175px] flex flex-col min-h-screen">

    {{-- TOPBAR --}}
    <header class="sticky top-0 z-30 bg-white border-b border-gray-200 h-16 flex items-center px-6 gap-4">
        {{-- Mobile menu toggle --}}
        <button @click="sidebarOpen=true" class="lg:hidden text-gray-500 hover:text-gray-900 p-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Breadcrumb --}}
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">Admin</a>
                @hasSection('breadcrumb')
                <span class="text-gray-300">/</span>
                @yield('breadcrumb')
                @endif
            </div>
            <h1 class="font-semibold text-gray-900 text-base leading-tight mt-0.5">@yield('title', 'Tableau de bord')</h1>
        </div>

        {{-- Actions topbar --}}
        <div class="flex items-center gap-3 flex-shrink-0">
            {{-- Bouton contextuel "Nouvelle entrée" --}}
            @hasSection('topbar-action')
            @yield('topbar-action')
            @endif

            {{-- Switcher FR/EN --}}
            <div class="flex rounded-sm border border-gray-200 overflow-hidden">
                <a href="{{ route('locale.switch', 'fr') }}"
                   class="px-2.5 py-1.5 text-xs font-semibold transition {{ app()->getLocale() === 'fr' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50' }}">FR</a>
                <a href="{{ route('locale.switch', 'en') }}"
                   class="px-2.5 py-1.5 text-xs font-semibold transition {{ app()->getLocale() === 'en' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50' }}">EN</a>
            </div>

            {{-- Lien site public --}}
            <a href="{{ route('fr.home') }}" target="_blank"
               class="hidden md:flex items-center gap-1.5 text-xs text-gray-400 hover:text-gray-700 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Voir le site
            </a>
        </div>
    </header>

    {{-- CONTENU --}}
    <main class="flex-1 p-6 lg:p-8">
        {{-- Alertes flash --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-sm text-sm"
             x-data x-init="setTimeout(() => $el.remove(), 5000)">
            <svg class="w-4 h-4 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-sm text-sm">
            <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        @yield('admin-content')
    </main>
</div>

@stack('scripts')
</body>
</html>
