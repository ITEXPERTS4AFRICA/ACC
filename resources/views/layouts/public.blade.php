<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Atlantic Cocoa Corporation')</title>
    <meta name="description" content="@yield('meta-description', 'Atlantic Cocoa Corporation – Leader en transformation de cacao en Afrique de l\'Ouest.')">
    <meta property="og:title" content="@yield('page-title', 'Atlantic Cocoa Corporation')">
    <meta property="og:description" content="@yield('meta-description', '')">
    <meta property="og:image" content="@yield('og-image', asset('images/og-default.jpg'))">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body class="bg-white text-chocolate font-inter antialiased">

    {{-- ══════════════════ BARRE SECONDAIRE ══════════════════ --}}
    <div class="bg-gray-50 border-b border-gray-100 hidden lg:block">
        <div class="max-w-7xl mx-auto px-6 h-9 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route(app()->getLocale() . '.news') }}"
                    class="text-[11px] font-medium text-gray-500 hover:text-navy uppercase tracking-wider transition">
                    {{ app()->getLocale() === 'fr' ? 'Actualités / Médias' : 'News / Media' }}
                </a>
                <a href="{{ route(app()->getLocale() . '.partners') }}"
                    class="text-[11px] font-medium text-gray-500 hover:text-navy uppercase tracking-wider transition">
                    {{ app()->getLocale() === 'fr' ? 'Partenaires / Clients B2B' : 'Partners / B2B Clients' }}
                </a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.login') }}"
                    class="text-[11px] font-medium text-gray-500 hover:text-navy uppercase tracking-wider transition">
                    Login
                </a>
                <span class="text-gray-300">|</span>
                <div class="flex items-center gap-1 text-[11px] font-semibold">
                    <a href="{{ route('locale.switch', 'fr') }}"
                        class="px-1 transition {{ app()->getLocale() === 'fr' ? 'text-navy font-bold' : 'text-gray-400 hover:text-navy' }}">FR</a>
                    <span class="text-gray-300">/</span>
                    <a href="{{ route('locale.switch', 'en') }}"
                        class="px-1 transition {{ app()->getLocale() === 'en' ? 'text-navy font-bold' : 'text-gray-400 hover:text-navy' }}">EN</a>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════ NAVIGATION PRINCIPALE ══════════════════ --}}
    <header x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <nav class="max-w-7xl mx-auto px-6 h-[72px] flex items-center justify-between gap-6">

            {{-- Logo --}}
            <a href="{{ route(app()->getLocale() . '.home') }}" class="flex-shrink-0">
                <img src="{{ asset('images/logo-acc.png') }}" alt="Atlantic Cocoa Corporation"
                    class="h-11 w-auto object-contain"
                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="hidden items-center justify-center bg-bordeaux rounded-sm px-3 py-1.5">
                    <span class="text-white font-bold tracking-[3px] text-sm">ACC</span>
                </div>
            </a>

            {{-- Nav links desktop --}}
            @php
                $locale = app()->getLocale();
                $navItems = [
                    ['route' => $locale . '.home', 'label_fr' => 'Accueil', 'label_en' => 'Home'],
                    ['route' => $locale . '.about', 'label_fr' => 'À Propos', 'label_en' => 'About'],
                    ['route' => $locale . '.factories', 'label_fr' => 'Nos Usines', 'label_en' => 'Plants'],
                    ['route' => $locale . '.products', 'label_fr' => 'Produits', 'label_en' => 'Products'],
                    [
                        'route' => $locale . '.quality',
                        'label_fr' => 'Qualité & Certifications',
                        'label_en' => 'Quality',
                    ],
                    [
                        'route' => $locale . '.sustainability',
                        'label_fr' => 'Durabilité & RSE',
                        'label_en' => 'Sustainability',
                    ],
                    ['route' => $locale . '.contact', 'label_fr' => 'Contact', 'label_en' => 'Contact'],
                ];
            @endphp
            <ul class="hidden xl:flex items-center gap-6">
                @foreach ($navItems as $item)
                    @php $active = request()->routeIs($item['route']); @endphp
                    <li>
                        <a href="{{ route($item['route']) }}"
                            class="text-[13px] font-medium transition-colors whitespace-nowrap pb-0.5
                          {{ $active ? 'text-navy border-b-2 border-navy' : 'text-chocolate hover:text-navy' }}">
                            {{ $locale === 'fr' ? $item['label_fr'] : $item['label_en'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- CTA + mobile --}}
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route(app()->getLocale() . '.contact') }}" class="btn-navy hidden sm:inline-block">
                    {{ app()->getLocale() === 'fr' ? 'Contact Sales' : 'Contact Sales' }}
                </a>

                {{-- Hamburger --}}
                <button @click="open = !open" class="xl:hidden text-chocolate p-2" aria-label="Menu">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </nav>

        {{-- Menu mobile --}}
        <div x-show="open" x-transition class="xl:hidden bg-white border-t border-gray-100 px-6 py-5 shadow-lg">
            <ul class="flex flex-col gap-4 mb-5">
                @foreach ($navItems as $item)
                    <li>
                        <a href="{{ route($item['route']) }}" @click="open=false"
                            class="text-sm font-medium text-chocolate hover:text-navy transition block">
                            {{ $locale === 'fr' ? $item['label_fr'] : $item['label_en'] }}
                        </a>
                    </li>
                @endforeach
                <li><a href="{{ route(app()->getLocale() . '.news') }}" @click="open=false"
                        class="text-sm text-gray-500 hover:text-navy block">{{ app()->getLocale() === 'fr' ? 'Actualités / Médias' : 'News / Media' }}</a>
                </li>
                <li><a href="{{ route(app()->getLocale() . '.partners') }}" @click="open=false"
                        class="text-sm text-gray-500 hover:text-navy block">{{ app()->getLocale() === 'fr' ? 'Partenaires B2B' : 'B2B Partners' }}</a>
                </li>
            </ul>
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('locale.switch', 'fr') }}"
                    class="text-xs font-bold {{ app()->getLocale() === 'fr' ? 'text-navy' : 'text-gray-400' }}">FR</a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('locale.switch', 'en') }}"
                    class="text-xs font-bold {{ app()->getLocale() === 'en' ? 'text-navy' : 'text-gray-400' }}">EN</a>
                <a href="{{ route('admin.login') }}" class="ml-auto text-xs text-gray-400 hover:text-navy">Login</a>
            </div>
        </div>
    </header>

    {{-- CONTENU --}}
    @yield('content')

    {{-- ══════════════════ FOOTER ══════════════════ --}}
    <footer class="bg-slate text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            {{-- Colonne 1 : Logo + tagline --}}
            <div class="lg:col-span-1">
                <img src="{{ asset('images/logo-acc.png') }}" alt="Atlantic Cocoa Corporation"
                    class="h-10 w-auto mb-4 brightness-0 invert"
                    onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                <div class="hidden mb-4">
                    <span class="text-white font-bold text-xl tracking-[3px]">ACC</span>
                </div>
                <p class="text-white/60 text-sm leading-relaxed max-w-xs">
                    Leading industrial cocoa processing in West Africa, delivering global quality standards to the
                    international market through excellence and technical precision.
                </p>
            </div>

            {{-- Colonne 2 : Global Offices --}}
            <div>
                <h4 class="text-[11px] font-bold uppercase tracking-[3px] text-white/40 mb-5">Global Offices</h4>
                <ul class="space-y-3">
                    @foreach (['Cameroon — Kribi', 'Côte d\'Ivoire — Abidjan', 'Côte d\'Ivoire — San Pedro'] as $office)
                        <li class="flex items-start gap-2 text-sm text-white/70">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-amber" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $office }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Colonne 3 : Navigation & Legal --}}
            <div>
                <h4 class="text-[11px] font-bold uppercase tracking-[3px] text-white/40 mb-5">Navigation & Legal</h4>
                <ul class="space-y-2.5">
                    @php
                        $footerLinks = [
                            [
                                route(app()->getLocale() . '.about'),
                                app()->getLocale() === 'fr' ? 'À Propos' : 'About Us',
                            ],
                            [
                                route(app()->getLocale() . '.products'),
                                app()->getLocale() === 'fr' ? 'Nos Produits' : 'Our Products',
                            ],
                            [
                                route(app()->getLocale() . '.sustainability'),
                                app()->getLocale() === 'fr' ? 'Durabilité & RSE' : 'Sustainability',
                            ],
                            ['#', 'Privacy Policy'],
                            ['#', 'Terms of Service'],
                        ];
                    @endphp
                    @foreach ($footerLinks as [$href, $label])
                        <li><a href="{{ $href }}"
                                class="text-sm text-white/70 hover:text-white transition">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Colonne 4 : Contact & Support --}}
            <div>
                <h4 class="text-[11px] font-bold uppercase tracking-[3px] text-white/40 mb-5">Contact & Support</h4>
                <p class="text-xs text-white/40 uppercase tracking-wider mb-2">General Inquiries</p>
                <a href="mailto:infos@atlantic-cocoacorporation.net"
                    class="text-sm text-white/80 hover:text-white transition block mb-5">
                    infos@atlantic-cocoacorporation.net
                </a>
                <div class="flex gap-3">
                    <a href="mailto:infos@atlantic-cocoacorporation.net"
                        class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:border-white/60 hover:bg-white/5 transition">
                        <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:border-white/60 hover:bg-white/5 transition">
                        <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                <p class="text-[11px] text-white/40 uppercase tracking-widest text-center">
                    © {{ date('Y') }} Atlantic Cocoa Corporation. All rights reserved.
                </p>
                <p class="text-[11px] text-white/30 uppercase tracking-widest text-center">
                    Industrial Excellence from West Africa to the World.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
