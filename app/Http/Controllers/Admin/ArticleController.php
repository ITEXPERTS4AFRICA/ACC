<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, GalleryPhoto};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index() {
        return view('admin.articles.index', ['articles' => Article::latest()->paginate(20)]);
    }
    public function create() {
        return view('admin.articles.form', ['article' => new Article]);
    }
    public function store(Request $request) {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title'].'-'.now()->format('YmdHis'));
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('articles','public');
        Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Article créé.');
    }
    public function edit(Article $article) {
        $gallery = GalleryPhoto::where('category', 'article-'.$article->id)->orderBy('order')->get();
        return view('admin.articles.form', compact('article', 'gallery'));
    }
    public function update(Request $request, Article $article) {
        $data = $this->validated($request);
        if ($request->hasFile('image')) { Storage::disk('public')->delete($article->image ?? ''); $data['image'] = $request->file('image')->store('articles','public'); }
        $article->update($data);
        return back()->with('success', 'Article mis à jour.');
    }
    public function destroy(Article $article) {
        Storage::disk('public')->delete($article->image ?? '');
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé.');
    }
    public function uploadGallery(Request $request, Article $article) {
        $request->validate(['photos.*' => 'required|image|max:6144']);
        $count = 0;
        foreach ($request->file('photos', []) as $file) {
            $path = $file->store('galleries/articles', 'public');
            GalleryPhoto::create(['path' => $path, 'category' => 'article-'.$article->id, 'order' => GalleryPhoto::where('category','article-'.$article->id)->count()]);
            $count++;
        }
        return back()->with('success', "{$count} photo(s) ajoutée(s).");
    }
    public function deleteGallery(Article $article, GalleryPhoto $photo) {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();
        return back()->with('success', 'Photo supprimée.');
    }

    private function validated(Request $request): array {
        return $request->validate([
            'title'          => 'required|string|max:300',
            'title_en'       => 'nullable|string|max:300',
            'tag'            => 'nullable|string|max:100',
            'tag_en'         => 'nullable|string|max:100',
            'excerpt'        => 'nullable|string',
            'excerpt_en'     => 'nullable|string',
            'content'        => 'nullable|string',
            'content_en'     => 'nullable|string',
            'image'          => 'nullable|image|max:6144',
            'published'      => 'boolean',
            'published_at'   => 'nullable|date',
        ]);
    }
}
