<?php
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ─── Redirect racine ───────────────────────────────────────────────────────
Route::get('/', fn() => redirect('/fr'));

// ─── Switcher de locale ────────────────────────────────────────────────────
Route::get('/locale/{locale}', [PublicController::class, 'setLocale'])->name('locale.switch');

// ─── Site public (FR / EN) ─────────────────────────────────────────────────
foreach (['fr', 'en'] as $lang) {
    Route::prefix($lang)->name($lang.'.')->group(function () use ($lang) {
        Route::get('/',                                                             [PublicController::class, 'home'])->name('home');
        Route::get($lang === 'fr' ? 'a-propos'    : 'about',                      [PublicController::class, 'about'])->name('about');
        Route::get($lang === 'fr' ? 'usines'      : 'factories',                  [PublicController::class, 'factories'])->name('factories');
        Route::get($lang === 'fr' ? 'produits'    : 'products',                   [PublicController::class, 'products'])->name('products');
        Route::get(($lang === 'fr' ? 'produits'   : 'products').'/{slug}',        [PublicController::class, 'productDetail'])->name('product.detail');
        Route::get($lang === 'fr' ? 'qualite'     : 'quality',                    [PublicController::class, 'quality'])->name('quality');
        Route::get($lang === 'fr' ? 'durabilite'  : 'sustainability',             [PublicController::class, 'sustainability'])->name('sustainability');
        Route::get($lang === 'fr' ? 'actualites'  : 'news',                       [PublicController::class, 'news'])->name('news');
        Route::get(($lang === 'fr' ? 'actualites' : 'news').'/{slug}',            [PublicController::class, 'newsDetail'])->name('news.detail');
        Route::get($lang === 'fr' ? 'partenaires' : 'partners',                   [PublicController::class, 'partners'])->name('partners');
        Route::get('contact',                                                       [PublicController::class, 'contact'])->name('contact');
        Route::post('contact',                                                      [ContactController::class, 'submit'])->name('contact.submit');
    });
}

// ─── Sitemap ───────────────────────────────────────────────────────────────
Route::get('/sitemap.xml', fn() => response()->file(public_path('sitemap.xml')))->name('sitemap');

// ─── Admin ─────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth publique
    Route::get('login',  [Admin\DashboardController::class, 'loginForm'])->name('login');
    Route::post('login', [Admin\DashboardController::class, 'login'])->name('login.submit');
    Route::post('logout',[Admin\DashboardController::class, 'logout'])->name('logout');

    // Zone protégée (tous rôles)
    Route::middleware('admin')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Pages CMS
        Route::resource('pages', Admin\PageController::class)->except(['show']);

        // Produits
        Route::resource('products', Admin\ProductController::class);
        Route::post('products/{product}/variants',        [Admin\ProductController::class, 'storeVariant'])->name('products.variants.store');
        Route::delete('products/{product}/variants/{idx}',[Admin\ProductController::class, 'destroyVariant'])->name('products.variants.destroy');

        // Usines
        Route::resource('factories', Admin\FactoryController::class);

        // Actualités
        Route::resource('articles', Admin\ArticleController::class);
        Route::post('articles/{article}/gallery',         [Admin\ArticleController::class, 'uploadGallery'])->name('articles.gallery.upload');
        Route::delete('articles/{article}/gallery/{photo}',[Admin\ArticleController::class, 'deleteGallery'])->name('articles.gallery.delete');

        // Certifications
        Route::resource('certifications', Admin\CertificationController::class);

        // Partenaires
        Route::resource('partners', Admin\PartnerController::class);

        // Médiathèque
        Route::get('media',              [Admin\MediaController::class, 'index'])->name('media.index');
        Route::post('media',             [Admin\MediaController::class, 'store'])->name('media.store');
        Route::delete('media/{media}',   [Admin\MediaController::class, 'destroy'])->name('media.destroy');
        Route::patch('media/{media}/alt',[Admin\MediaController::class, 'updateAlt'])->name('media.alt');

        // Messages
        Route::get('messages',                            [Admin\SettingsController::class, 'messages'])->name('messages.index');
        Route::get('messages/{message}',                  [Admin\SettingsController::class, 'showMessage'])->name('messages.show');
        Route::patch('messages/{message}/read',           [Admin\SettingsController::class, 'markRead'])->name('messages.read');
        Route::delete('messages/{message}',               [Admin\SettingsController::class, 'deleteMessage'])->name('messages.delete');

        // SEO
        Route::get('seo',                [Admin\SettingsController::class, 'seo'])->name('seo.index');
        Route::put('seo/{setting}',      [Admin\SettingsController::class, 'updateSeo'])->name('seo.update');
        Route::post('seo',               [Admin\SettingsController::class, 'createSeo'])->name('seo.create');
    });

    // Zone admin uniquement
    Route::middleware('admin:admin')->group(function () {
        Route::resource('users', Admin\UserController::class)->except(['show']);
        Route::patch('users/{user}/toggle', [Admin\UserController::class, 'toggle'])->name('users.toggle');

        Route::get('settings',            [Admin\GeneralSettingsController::class, 'index'])->name('settings.index');
        Route::post('settings',           [Admin\GeneralSettingsController::class, 'update'])->name('settings.update');
        Route::post('settings/test-smtp', [Admin\GeneralSettingsController::class, 'testSmtp'])->name('settings.test-smtp');
    });
});
