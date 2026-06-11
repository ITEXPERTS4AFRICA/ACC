@extends('layouts.public')
@section('page-title', $page->getTitleLocaleAttribute() . ' — ACC')
@section('meta-description', $page->meta_description_locale ?? '')

@section('content')

    {{-- HERO --}}
    <section class="relative h-[400px] flex items-end bg-dark overflow-hidden">
        @if($page->hero_image)
            <img src="{{ asset('storage/' . $page->hero_image) }}" alt="{{ $page->title_locale }}"
                class="absolute inset-0 w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/40 to-transparent"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full">
            <h1 class="font-playfair text-5xl font-bold text-white leading-tight max-w-3xl">
                {{ $page->title_locale }}
            </h1>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="prose prose-lg prose-chocolate max-w-none">
                {!! $page->content_locale !!}
            </div>
        </div>
    </section>

@endsection