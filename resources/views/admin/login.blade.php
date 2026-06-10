<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Administrateur — Atlantic Cocoa Corporation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="h-full bg-dark flex">

    {{-- Fond plein écran --}}
    <div class="fixed inset-0 bg-dark overflow-hidden">
        <div class="absolute inset-0 opacity-10"
             style="background-image: repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(255,255,255,0.03) 40px, rgba(255,255,255,0.03) 41px), repeating-linear-gradient(90deg, transparent, transparent 40px, rgba(255,255,255,0.03) 40px, rgba(255,255,255,0.03) 41px);">
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-dark to-transparent"></div>
    </div>

    {{-- Carte login centrée --}}
    <div class="relative z-10 w-full flex flex-col items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo-acc.png') }}" alt="Atlantic Cocoa Corporation"
                     class="h-14 w-auto mx-auto mb-4 brightness-0 invert"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                <div class="hidden">
                    <span class="text-white font-bold text-2xl tracking-[4px]">ACC</span>
                </div>
                <p class="text-white/30 text-[10px] uppercase tracking-[4px]">Atlantic Cocoa Corporation</p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-sm shadow-2xl p-10">
                <h1 class="font-playfair text-2xl font-bold text-navy text-center mb-2">Accès Administrateur</h1>
                <p class="text-gray-400 text-xs text-center uppercase tracking-widest mb-8">Interface de gestion sécurisée</p>

                @if($errors->has('email') || session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-sm mb-6">
                    {{ $errors->first('email') ?: session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="block text-[10px] font-bold text-navy uppercase tracking-widest mb-2">Adresse Email</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="w-full border border-gray-200 rounded-sm pl-11 pr-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-[10px] font-bold text-navy uppercase tracking-widest mb-2">Mot de passe</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </span>
                            <input type="password" name="password" required
                                   class="w-full border border-gray-200 rounded-sm pl-11 pr-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition">
                        </div>
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="remember" id="remember" value="1"
                               class="w-4 h-4 rounded-sm border-gray-300 text-navy focus:ring-navy">
                        <label for="remember" class="text-xs text-gray-500">Se souvenir pendant 30 jours</label>
                    </div>

                    <button type="submit"
                            class="w-full bg-navy text-white uppercase tracking-[3px] text-xs font-bold py-4 rounded-sm hover:bg-navy-dark transition-colors duration-200 mt-2">
                        Se Connecter
                    </button>
                </form>

                {{-- Notice sécurité --}}
                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-center gap-2 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span class="text-[10px] uppercase tracking-[3px]">Chiffrement de Bout en Bout</span>
                </div>
            </div>

            {{-- Lien retour site --}}
            <div class="text-center mt-6">
                <a href="{{ route('fr.home') }}" class="text-white/30 text-xs hover:text-white/60 transition uppercase tracking-widest">
                    ← Retour au site
                </a>
            </div>
        </div>
    </div>
</body>
</html>
