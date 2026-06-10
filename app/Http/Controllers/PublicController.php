<?php
namespace App\Http\Controllers;

use App\Models\{Factory, Product, Certification, Article, RsePillar, Partner, TeamMember, GalleryPhoto, SeoSetting};
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        $factories = Factory::active()->get();
        $products = Product::active()->get();
        $certifications = Certification::active()->get();
        $articles = Article::published()->limit(7)->get();
        $seo = SeoSetting::forPage('home');
        return view('public.home', compact('factories', 'products', 'certifications', 'articles', 'seo'));
    }

    public function about(): View
    {
        $director = TeamMember::where('is_director', true)->first();
        $team = TeamMember::where('is_director', false)->ordered()->get();
        $partners = \App\Models\Partner::active()->get();
        $seo = \App\Models\SeoSetting::forPage('about');
        return view('public.about', compact('director', 'team', 'seo', 'partners'));
    }

    public function factories(): View
    {
        $factories = Factory::active()->get();
        $seo = SeoSetting::forPage('factories');
        return view('public.factories', compact('factories', 'seo'));
    }

    public function products(): View
    {
        $products = Product::active()->get();
        $seo = SeoSetting::forPage('products');
        return view('public.products', compact('products', 'seo'));
    }

    public function productDetail(string $slug): View
    {
        $product = Product::where('slug', $slug)->where('active', true)->firstOrFail();
        $seo = SeoSetting::forPage('product.' . $slug);
        return view('public.product-detail', compact('product', 'seo'));
    }

    public function quality(): View
    {
        $certifications = Certification::active()->get();
        $seo = SeoSetting::forPage('quality');
        return view('public.quality', compact('certifications', 'seo'));
    }

    public function sustainability(): View
    {
        $pillars = RsePillar::ordered()->get();
        $seo = SeoSetting::forPage('sustainability');
        return view('public.sustainability', compact('pillars', 'seo'));
    }

    public function news(): View
    {
        $articles = Article::published()->paginate(9);
        $gallery = GalleryPhoto::active()->get();
        $seo = SeoSetting::forPage('news');
        return view('public.news', compact('articles', 'gallery', 'seo'));
    }

    public function newsDetail(string $slug): View
    {
        $article = Article::where('slug', $slug)->where('published', true)->firstOrFail();
        $related = Article::published()->where('id', '!=', $article->id)->limit(3)->get();
        return view('public.news-detail', compact('article', 'related'));
    }

    public function partners(): View
    {
        $partners = Partner::active()->get();
        $seo = SeoSetting::forPage('partners');
        return view('public.partners', compact('partners', 'seo'));
    }

    public function contact(): View
    {
        $seo = SeoSetting::forPage('contact');
        return view('public.contact', compact('seo'));
    }

    public function setLocale(string $locale)
    {
        if (!in_array($locale, ['fr', 'en']))
            abort(404);
        session(['locale' => $locale]);
        return redirect()->back();
    }
}
