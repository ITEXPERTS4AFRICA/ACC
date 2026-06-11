@extends('layouts.admin')
@section('title', 'SEO')
@section('admin-content')
<div class="space-y-4">
    @foreach($pages as $page)
    @php $setting = $settings[$page] ?? null; @endphp
    <div class="bg-white border border-gray-200 rounded-sm p-6" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between text-left">
            <h3 class="font-semibold text-gray-900 capitalize">{{ $page }}</h3>
            <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div x-show="open" x-transition class="mt-4 border-t pt-4">
            @if($setting)
            <form action="{{ route('admin.seo.update', $setting) }}" method="POST" class="grid sm:grid-cols-2 gap-4">
                @csrf @method('PUT')
                <div><label class="block text-xs font-medium text-gray-600 mb-1">Meta Title (FR)</label>
                    <input type="text" name="meta_title" value="{{ $setting->meta_title }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-xs font-medium text-gray-600 mb-1">Meta Title (EN)</label>
                    <input type="text" name="meta_title_en" value="{{ $setting->meta_title_en }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-xs font-medium text-gray-600 mb-1">Meta Description (FR)</label>
                    <textarea name="meta_description" rows="2" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux resize-none">{{ $setting->meta_description }}</textarea></div>
                <div><label class="block text-xs font-medium text-gray-600 mb-1">Meta Description (EN)</label>
                    <textarea name="meta_description_en" rows="2" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux resize-none">{{ $setting->meta_description_en }}</textarea></div>
                <div class="sm:col-span-2"><button type="submit" class="btn-primary text-sm py-2 px-5">Enregistrer</button></div>
            </form>
            @else
            <p class="text-gray-400 text-sm">Aucune configuration SEO pour cette page.</p>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
