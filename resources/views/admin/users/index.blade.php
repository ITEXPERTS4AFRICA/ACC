@extends('layouts.admin')
@section('title', 'Utilisateurs')
@section('breadcrumb')<span class="text-gray-700">Utilisateurs</span>@endsection
@section('topbar-action')
<a href="{{ route('admin.users.create') }}" class="btn-primary text-xs py-2 px-4">+ Ajouter</a>
@endsection

@section('admin-content')
<div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Utilisateur</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Email</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Rôle</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-bordeaux/10 flex items-center justify-center flex-shrink-0">
                            <span class="text-bordeaux text-xs font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $user->name }}</p>
                            @if($user->id === auth()->id())
                            <span class="text-[10px] text-gray-400">(vous)</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500 hidden md:table-cell">{{ $user->email }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex text-xs font-semibold px-2 py-1 rounded-sm
                        {{ $user->role === 'admin' ? 'bg-bordeaux/10 text-bordeaux' : 'bg-gray-100 text-gray-600' }}">
                        {{ $user->role === 'admin' ? 'Administrateur' : 'Éditeur' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center gap-1 text-xs px-2 py-1 rounded-sm
                        {{ $user->active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $user->active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                        {{ $user->active ? 'Actif' : 'Désactivé' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-xs text-industrial hover:underline">Modifier</a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-xs text-amber-600 hover:underline">
                                {{ $user->active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:underline">Supprimer</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
