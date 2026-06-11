@extends('layouts.admin')
@section('title', 'Message de '.$message->name)
@section('breadcrumb')
<a href="{{ route('admin.messages.index') }}" class="text-gray-400 hover:text-gray-600">Messages</a>
<span class="text-gray-300 mx-1">/</span><span class="text-gray-700">{{ Str::limit($message->name, 30) }}</span>
@endsection

@section('admin-content')
<div class="max-w-3xl">
    <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-8">
        {{-- Header --}}
        <div class="flex items-start justify-between mb-6 pb-6 border-b border-gray-100">
            <div>
                <h2 class="font-playfair text-xl font-bold text-chocolate">{{ $message->subject }}</h2>
                <p class="text-gray-500 text-sm mt-1">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
            </div>
            <div class="flex gap-3">
                <form action="{{ route('admin.messages.read', $message) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="text-xs text-gray-500 hover:text-gray-800 border border-gray-300 rounded-sm px-3 py-1.5 hover:bg-gray-50 transition">
                        {{ $message->read ? 'Marquer non lu' : 'Marquer lu' }}
                    </button>
                </form>
                <form action="{{ route('admin.messages.delete', $message) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 border border-red-200 rounded-sm px-3 py-1.5 hover:bg-red-50 transition">Supprimer</button>
                </form>
            </div>
        </div>

        {{-- Infos expéditeur --}}
        <div class="grid sm:grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-100">
            <div class="space-y-3">
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-0.5">Nom</p>
                    <p class="text-gray-900 font-medium">{{ $message->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-0.5">Email</p>
                    <a href="mailto:{{ $message->email }}" class="text-industrial hover:underline">{{ $message->email }}</a>
                </div>
            </div>
            <div class="space-y-3">
                @if($message->company)
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-0.5">Société</p>
                    <p class="text-gray-900">{{ $message->company }}</p>
                </div>
                @endif
                @if($message->country)
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-0.5">Pays</p>
                    <p class="text-gray-900">{{ $message->country }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Corps du message --}}
        <div>
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-3">Message</p>
            <div class="bg-surface border-l-4 border-bordeaux rounded-sm p-5 text-gray-700 leading-relaxed whitespace-pre-wrap text-sm">{{ $message->message }}</div>
        </div>

        {{-- Répondre --}}
        <div class="mt-8 pt-6 border-t border-gray-100">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}"
               class="btn-primary inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                Répondre par email
            </a>
        </div>
    </div>
</div>
@endsection
