<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GeneralSettingsController extends Controller
{
    private array $keys = [
        'site_name', 'site_tagline_fr', 'site_tagline_en',
        'contact_email', 'ga_id',
        'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password',
        'smtp_from_email', 'smtp_from_name', 'smtp_encryption',
    ];

    public function index() {
        $settings = SiteSetting::many($this->keys);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request) {
        $data = $request->validate([
            'site_name'        => 'required|string|max:200',
            'site_tagline_fr'  => 'nullable|string|max:300',
            'site_tagline_en'  => 'nullable|string|max:300',
            'contact_email'    => 'required|email',
            'ga_id'            => 'nullable|string|max:50',
            'smtp_host'        => 'nullable|string|max:200',
            'smtp_port'        => 'nullable|integer',
            'smtp_encryption'  => 'nullable|in:tls,ssl,none',
            'smtp_username'    => 'nullable|string|max:200',
            'smtp_password'    => 'nullable|string|max:500',
            'smtp_from_email'  => 'nullable|email',
            'smtp_from_name'   => 'nullable|string|max:200',
        ]);
        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value);
        }
        return back()->with('success', 'Paramètres enregistrés.');
    }

    public function testSmtp(Request $request) {
        $to = $request->validate(['to' => 'required|email'])['to'];
        try {
            Mail::raw('Ceci est un email de test ACC — configuration SMTP OK.', function ($msg) use ($to) {
                $msg->to($to)->subject('[ACC] Test SMTP');
            });
            return back()->with('success', "Email de test envoyé à {$to}.");
        } catch (\Throwable $e) {
            return back()->with('error', 'Erreur SMTP : '.$e->getMessage());
        }
    }
}
