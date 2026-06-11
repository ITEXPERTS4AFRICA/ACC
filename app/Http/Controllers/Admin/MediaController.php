<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request) {
        $type  = $request->get('type', 'all');
        $query = MediaFile::latest();
        if ($type === 'image') $query->images();
        if ($type === 'pdf')   $query->pdfs();
        $files = $query->paginate(36)->withQueryString();
        return view('admin.media.index', compact('files', 'type'));
    }

    public function store(Request $request) {
        $request->validate([
            'files'   => 'required|array|min:1',
            'files.*' => 'file|max:20480|mimes:jpg,jpeg,png,webp,gif,pdf',
        ]);

        $uploaded = 0;
        foreach ($request->file('files') as $file) {
            $mime   = $file->getMimeType();
            $type   = str_starts_with($mime, 'image/') ? 'image' : ($mime === 'application/pdf' ? 'pdf' : 'other');
            $folder = $type === 'image' ? 'media/images' : 'media/pdfs';
            $path   = $file->store($folder, 'public');

            MediaFile::create([
                'name'        => $file->getClientOriginalName(),
                'path'        => $path,
                'mime_type'   => $mime,
                'type'        => $type,
                'size'        => $file->getSize(),
                'uploaded_by' => auth()->id(),
            ]);
            $uploaded++;
        }

        if ($request->wantsJson()) {
            return response()->json(['uploaded' => $uploaded]);
        }
        return back()->with('success', "{$uploaded} fichier(s) uploadé(s).");
    }

    public function destroy(MediaFile $media) {
        Storage::disk($media->disk)->delete($media->path);
        $media->delete();
        if (request()->wantsJson()) return response()->json(['ok' => true]);
        return back()->with('success', 'Fichier supprimé.');
    }

    public function updateAlt(Request $request, MediaFile $media) {
        $media->update(['alt' => $request->validate(['alt' => 'nullable|string|max:255'])['alt']]);
        return response()->json(['ok' => true]);
    }
}
