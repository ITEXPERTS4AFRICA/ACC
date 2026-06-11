@extends('layouts.admin')
@section('title', 'Messages')
@section('admin-content')
<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <div class="divide-y divide-gray-100">
        @forelse($messages as $msg)
        <div class="p-6 {{ !$msg->read ? 'bg-blue-50/30' : '' }}">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        @if(!$msg->read)<span class="text-xs bg-bordeaux text-white px-2 py-0.5 rounded-sm">Nouveau</span>@endif
                        <span class="text-xs text-gray-400">{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <p class="font-semibold text-gray-900">{{ $msg->name }} <span class="text-gray-400 font-normal text-sm">— {{ $msg->email }}</span></p>
                    @if($msg->company)<p class="text-gray-500 text-sm">{{ $msg->company }}@if($msg->country) · {{ $msg->country }}@endif</p>@endif
                    <p class="text-gray-700 text-sm font-medium mt-2">{{ $msg->subject }}</p>
                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">{{ $msg->message }}</p>
                </div>
                <div class="flex flex-col gap-2 flex-shrink-0">
                    @if(!$msg->read)
                    <form action="{{ route('admin.messages.read', $msg) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="text-xs text-green-700 hover:underline">Marquer lu</button>
                    </form>
                    @endif
                    <a href="mailto:{{ $msg->email }}" class="text-xs text-industrial hover:underline">Répondre</a>
                    <form action="{{ route('admin.messages.delete', $msg) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:underline">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="px-6 py-16 text-center text-gray-400">Aucun message.</div>
        @endforelse
    </div>
</div>
{{ $messages->links() }}
@endsection
