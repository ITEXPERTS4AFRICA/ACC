@extends('layouts.admin')
@section('title', 'Certifications')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $certifications->count() }} certification(s)</p>
    <a href="{{ route('admin.certifications.create') }}" class="btn-primary text-sm py-2 px-5">+ Ajouter</a>
</div>
<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200"><tr>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nom</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Logo</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">PDF</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ordre</th>
            <th class="px-6 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($certifications as $cert)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $cert->name }}</td>
                <td class="px-6 py-4 text-center">{{ $cert->logo ? '✓' : '—' }}</td>
                <td class="px-6 py-4 text-center">{{ $cert->pdf ? '✓' : '—' }}</td>
                <td class="px-6 py-4 text-center text-gray-500">{{ $cert->order }}</td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.certifications.edit', $cert) }}" class="text-xs text-industrial hover:underline mr-3">Modifier</a>
                    <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Aucune certification.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
