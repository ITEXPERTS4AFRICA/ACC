<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ContactMessage, SeoSetting};
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function messages() {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function showMessage(ContactMessage $message) {
        $message->update(['read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function markRead(ContactMessage $message) {
        $message->update(['read' => !$message->read]);
        return back()->with('success', $message->read ? 'Marqué comme lu.' : 'Marqué comme non lu.');
    }

    public function deleteMessage(ContactMessage $message) {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé.');
    }

    public function seo() {
        $settings = SeoSetting::all()->keyBy('page_key');
        $pages    = ['home','about','factories','products','quality','sustainability','news','contact','partners'];
        return view('admin.seo.index', compact('settings', 'pages'));
    }

    public function updateSeo(Request $request, SeoSetting $setting) {
        $setting->update($request->validate([
            'meta_title'          => 'nullable|string|max:200',
            'meta_title_en'       => 'nullable|string|max:200',
            'meta_description'    => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
        ]));
        return back()->with('success', 'SEO mis à jour.');
    }

    public function createSeo(Request $request) {
        $data = $request->validate(['page_key' => 'required|string|unique:seo_settings,page_key']);
        SeoSetting::create($data);
        return back()->with('success', 'Entrée SEO créée.');
    }
}
