@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('admin-content')
@php
    $greeting = now()->hour < 12 ? 'Bonjour' : (now()->hour < 18 ? 'Bon après-midi' : 'Bonsoir');
@endphp

<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Tableau de bord</h1>
        <p class="text-gray-500 text-sm mt-1">{{ $greeting }}, <strong class="text-chocolate">{{ auth()->user()->name }}</strong> — {{ now()->isoFormat('dddd D MMMM YYYY') }}</p>
    </div>
    <div class="flex items-center gap-2 text-xs font-medium text-gray-500">
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-industrial"></span> Articles</span>
        <span class="flex items-center gap-1 ml-3"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Messages</span>
    </div>
</div>

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

<div class="grid lg:grid-cols-3 gap-8 mb-8">
    {{-- Graphique --}}
    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-sm shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-semibold text-gray-900 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Statistiques mensuelles
            </h2>
        </div>
        <div class="h-[280px]">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    {{-- Activité récente --}}
    <div class="bg-white border border-gray-200 rounded-sm shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900 text-sm">Activité récente</h2>
        </div>
        <div class="divide-y divide-gray-50 h-[300px] overflow-y-auto">
            @forelse($recentActivity as $item)
            <div class="flex items-center gap-3 px-6 py-3">
                <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 text-sm">
                    {{ $item['icon'] }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-900 truncate font-medium">{{ $item['label'] }}</p>
                    <p class="text-xs text-gray-400">{{ $item['time']->diffForHumans() }}</p>
                </div>
                @if(isset($item['badge']))
                <span class="text-[10px] {{ $item['badge_class'] }} px-2 py-0.5 rounded-sm flex-shrink-0 font-bold uppercase tracking-wider">{{ $item['badge'] }}</span>
                @endif
            </div>
            @empty
            <div class="px-6 py-12 text-center">
                <p class="text-gray-400 text-sm">Aucune activité récente.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-8">
    {{-- Calendrier --}}
    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-sm shadow-sm p-6">
        <h2 class="font-semibold text-gray-900 text-sm mb-6 flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Vue Périodique
        </h2>
        <div id="calendar"></div>
    </div>

    {{-- Derniers messages --}}
    <div class="bg-white border border-gray-200 rounded-sm shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-900 text-sm">Derniers messages</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-bordeaux hover:underline">Voir tout</a>
        </div>
        <div class="divide-y divide-gray-50 h-[480px] overflow-y-auto">
            @forelse($latestMessages as $msg)
            <a href="{{ route('admin.messages.show', $msg) }}"
               class="flex items-start justify-between px-6 py-4 hover:bg-gray-50 transition border-l-2 {{ !$msg->read ? 'border-bordeaux bg-bordeaux/5' : 'border-transparent' }}">
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $msg->name }}</p>
                    <p class="text-xs text-gray-500 truncate mt-0.5">{{ $msg->subject }}</p>
                    <p class="text-[10px] text-gray-400 mt-2">{{ $msg->created_at->isoFormat('D MMM, HH:mm') }}</p>
                </div>
            </a>
            @empty
            <div class="px-6 py-12 text-center text-gray-400 text-sm">
                Aucun message.
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<style>
    .fc .fc-toolbar-title { font-size: 1rem; font-weight: 700; color: #1f2937; }
    .fc .fc-button-primary { background-color: #581717; border-color: #581717; border-radius: 2px; padding: 4px 8px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; }
    .fc .fc-button-primary:hover { background-color: #4a1313; border-color: #4a1313; }
    .fc .fc-button-primary:disabled { background-color: #9ca3af; border-color: #9ca3af; }
    .fc-theme-standard td, .fc-theme-standard th { border-color: #f3f4f6; }
    .fc-event { border-radius: 2px; border: none; padding: 2px 4px; cursor: pointer; transition: opacity 0.2s; }
    .fc-event:hover { opacity: 0.8; }
    .fc-event-title { font-weight: 600; font-size: 0.75rem; }
    #calendar { font-family: inherit; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart
    const ctx = document.getElementById('dashboardChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartData['labels']),
                datasets: [
                    {
                        label: 'Articles',
                        data: @json($chartData['articles']),
                        backgroundColor: '#1e293b',
                        borderRadius: 2,
                    },
                    {
                        label: 'Messages',
                        data: @json($chartData['messages']),
                        backgroundColor: '#f59e0b',
                        borderRadius: 2,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { font: { size: 10 } } },
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    }

    // Calendar
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr',
            height: 520,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            events: @json($calendarEvents),
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault();
                }
            }
        });
        calendar.render();
    }
});
</script>
@endpush
@endsection
