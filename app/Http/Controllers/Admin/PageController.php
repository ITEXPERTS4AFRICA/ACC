<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index() {
        $pages = Page::orderBy('key')->get();
        return view('admin.pages.index', compact('pages'));
    }
    public function edit(Page $page) {
        return view('admin.pages.form', compact('page'));
    }
    public function update(Request $request, Page $page) {
        $data = $request->validate([
            'title'            => 'required|string|max:300',
            'title_en'         => 'nullable|string|max:300',
            'content'          => 'nullable|string',
            'content_en'       => 'nullable|string',
            'hero_image'       => 'nullable|image|max:8192',
            'meta_title'       => 'nullable|string|max:200',
            'meta_title_en'    => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
            'status'           => 'in:published,draft',
        ]);
        if ($request->hasFile('hero_image')) {
            Storage::disk('public')->delete($page->hero_image ?? '');
            $data['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }
        $page->update($data);
        return back()->with('success', 'Page mise à jour.');
    }
    public function create() {
        return view('admin.pages.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'key'    => 'required|string|unique:pages,key',
            'title'  => 'required|string|max:300',
            'status' => 'in:published,draft',
        ]);
        Page::create($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page créée.');
    }
    public function destroy(Page $page) {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page supprimée.');
    }
}
