@extends('layouts.admin')
@section('title', 'Paramètres généraux')
@section('breadcrumb')<span class="text-gray-700">Paramètres</span>@endsection

@section('admin-content')
<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <div class="grid lg:grid-cols-2 gap-6">
        {{-- Infos site --}}
        <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-semibold text-gray-900 pb-3 border-b border-gray-100">Informations du site</h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom du site *</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Atlantic Cocoa Corporation' }}" required
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tagline (FR)</label>
                <input type="text" name="site_tagline_fr" value="{{ $settings['site_tagline_fr'] ?? '' }}"
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tagline (EN)</label>
                <input type="text" name="site_tagline_en" value="{{ $settings['site_tagline_en'] ?? '' }}"
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email de réception des formulaires *</label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'contact@atlantic-cocoacorporation.net' }}" required
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Google Analytics ID</label>
                <input type="text" name="ga_id" value="{{ $settings['ga_id'] ?? '' }}" placeholder="G-XXXXXXXXXX"
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
        </div>

        {{-- SMTP --}}
        <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-semibold text-gray-900 pb-3 border-b border-gray-100">Configuration SMTP</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Host SMTP</label>
                    <input type="text" name="smtp_host" value="{{ $settings['smtp_host'] ?? '' }}" placeholder="smtp.example.com"
                           class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Port</label>
                    <input type="number" name="smtp_port" value="{{ $settings['smtp_port'] ?? '587' }}"
                           class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Chiffrement</label>
                <select name="smtp_encryption" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
                    @foreach(['tls' => 'TLS (recommandé)', 'ssl' => 'SSL', 'none' => 'Aucun'] as $val => $label)
                    <option value="{{ $val }}" {{ ($settings['smtp_encryption'] ?? 'tls') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom d'utilisateur</label>
                <input type="text" name="smtp_username" value="{{ $settings['smtp_username'] ?? '' }}"
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="smtp_password" value="{{ $settings['smtp_password'] ?? '' }}" autocomplete="new-password"
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">From Name</label>
                    <input type="text" name="smtp_from_name" value="{{ $settings['smtp_from_name'] ?? 'Atlantic Cocoa Corporation' }}"
                           class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">From Email</label>
                    <input type="email" name="smtp_from_email" value="{{ $settings['smtp_from_email'] ?? '' }}"
                           class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4 mt-6">
        <button type="submit" class="btn-primary">Enregistrer les paramètres</button>
    </div>
</form>

{{-- Test SMTP --}}
<div class="mt-8 bg-white border border-gray-200 rounded-sm shadow-sm p-6">
    <h2 class="text-sm font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Tester la configuration SMTP</h2>
    <form action="{{ route('admin.settings.test-smtp') }}" method="POST" class="flex gap-3 items-end">
        @csrf
        <div class="flex-1 max-w-xs">
            <label class="block text-sm font-medium text-gray-700 mb-1">Envoyer un email de test à</label>
            <input type="email" name="to" value="{{ auth()->user()->email }}" required placeholder="test@example.com"
                   class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
        </div>
        <button type="submit" class="btn-secondary text-sm py-2 px-5">Envoyer le test</button>
    </form>
</div>
@endsection
