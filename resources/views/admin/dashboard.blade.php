@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('admin-content')
@php
$greeting = now()->hour < 12 ? 'Bonjour' : (now()->hour < 18 ? 'Bon après-midi' : 'Bonsoir');
@endphp
<p class="text-gray-500 text-sm mb-6">{{ $greeting }}, <strong class="text-chocolate">{{ auth()->user()->name }}</strong> — {{ now()->isoFormat('dddd D MMMM YYYY') }}</p>

{{-- Stat cards --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @foreach([
        ['label' => 'Produits actifs',     'value' => $stats['products'],       'route' => 'admin.products.index',       'color' => 'border-bordeaux',   'icon' => '📦'],
        ['label' => 'Usines',              'value' => $stats['factories'],      'route' => 'admin.factories.index',      'color' => 'border-chocolate',  'icon' => '🏭'],
        ['label' => 'Articles publiés',    'value' => $stats['articles'],       'route' => 'admin.articles.index',       'color' => 'border-industrial', 'icon' => '📰'],
        ['label' => 'Certifications',      'value' => $stats['certifications'], 'route' => 'admin.certifications.index', 'color' => 'border-green-600',  'icon' => '🏅'],
        ['label' => 'Messages non lus',    'value' => $stats['messages'],       'route' => 'admin.messages.index',       'color' => 'border-amber-500',  'icon' => '✉️'],
    ] as $card)
    <a href="{{ route($card['route']) }}"
       class="bg-white border-l-4 {{ $card['color'] }} border border-gray-200 rounded-sm shadow-sm p-5 hover:shadow-md transition group">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs text-gray-400 font-medium">{{ $card['label'] }}</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $card['value'] }}</p>
            </div>
            <span class="text-2xl opacity-60 group-hover:opacity-100 transition">{{ $card['icon'] }}</span>
        </div>
    </a>
    @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-6">
    {{-- Derniers messages --}}
    <div class="bg-white border border-gray-200 rounded-sm shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-900 text-sm">Derniers messages reçus</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-bordeaux hover:underline">Voir tous →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($latestMessages as $msg)
            <a href="{{ route('admin.messages.show', $msg) }}"
               class="flex items-start justify-between px-6 py-3 hover:bg-gray-50 transition">
                <div class="min-w-0">
                    <div class="flex items-center gap-2 mb-0.5">
                        @if(!$msg->read)
                        <span class="w-1.5 h-1.5 rounded-full bg-bordeaux flex-shrink-0"></span>
                        @endif
                        <p class="text-sm font-medium text-gray-900 {{ !$msg->read ? '' : 'text-gray-600' }} truncate">{{ $msg->name }}</p>
                        @if($msg->company)<span class="text-xs text-gray-400 flex-shrink-0">— {{ $msg->company }}</span>@endif
                    </div>
                    <p class="text-xs text-gray-500 truncate">{{ $msg->subject }}</p>
                </div>
                <span class="text-xs text-gray-400 flex-shrink-0 ml-3">{{ $msg->created_at->diffForHumans() }}</span>
            </a>
            @empty
            <p class="px-6 py-8 text-center text-gray-400 text-sm">Aucun message pour l'instant.</p>
            @endforelse
        </div>
    </div>

    {{-- Activité récente --}}
    <div class="bg-white border border-gray-200 rounded-sm shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900 text-sm">Activité récente</h2>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentActivity as $item)
            <div class="flex items-center gap-3 px-6 py-3">
                <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 text-sm">
                    {{ $item['icon'] }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-700 truncate">{{ $item['label'] }}</p>
                    <p class="text-xs text-gray-400">{{ $item['time']->diffForHumans() }}</p>
                </div>
                @if(isset($item['badge']))
                <span class="text-[10px] {{ $item['badge_class'] }} px-2 py-0.5 rounded-sm flex-shrink-0">{{ $item['badge'] }}</span>
                @endif
            </div>
            @empty
            <p class="px-6 py-8 text-center text-gray-400 text-sm">Aucune activité récente.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
