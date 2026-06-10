@extends('layouts.public')

@section('content')

<section class="bg-dark py-32">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route(app()->getLocale().'.news') }}" class="text-white/50 text-sm hover:text-white mb-6 inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ app()->getLocale() === 'fr' ? 'Toutes les actualités' : 'All news' }}
        </a>
        <div class="flex items-center gap-3 mt-4 mb-6">
            @if($article->tag)
            <span class="bg-industrial text-white text-xs px-2 py-1 rounded-sm">{{ $article->tag_locale }}</span>
            @endif
            <span class="text-white/40 text-xs">{{ $article->published_at?->format('d/m/Y') }}</span>
        </div>
        <h1 class="font-playfair text-4xl lg:text-5xl font-bold text-white max-w-3xl leading-tight">{{ $article->title_locale }}</h1>
    </div>
</section>

<section class="section-cream py-24">
    <div class="max-w-4xl mx-auto px-6">
        @if($article->image)
        <div class="aspect-[16/9] rounded-sm overflow-hidden mb-12">
            <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title_locale }}" class="w-full h-full object-cover">
        </div>
        @endif
        <div class="prose prose-lg max-w-none text-text-secondary prose-headings:font-playfair prose-headings:text-chocolate prose-a:text-bordeaux">
            {!! $article->content_locale !!}
        </div>
    </div>
</section>

@if($related->count())
<section class="section-surface py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="font-playfair text-2xl font-bold text-chocolate mb-8">{{ app()->getLocale() === 'fr' ? 'À lire aussi' : 'Related articles' }}</h2>
        <div class="grid sm:grid-cols-3 gap-6">
            @foreach($related as $rel)
            <a href="{{ route(app()->getLocale().'.news.detail', $rel->slug) }}"
               class="group bg-cream border border-border rounded-sm overflow-hidden card-accent hover:shadow-md transition-shadow">
                <div class="p-5">
                    <span class="text-text-secondary text-xs">{{ $rel->published_at?->format('d/m/Y') }}</span>
                    <h3 class="font-playfair font-bold text-chocolate mt-2 group-hover:text-bordeaux transition-colors line-clamp-2">{{ $rel->title_locale }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
