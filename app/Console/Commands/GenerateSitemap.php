<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\{Product, Article};

class GenerateSitemap extends Command
{
    protected $signature   = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml';

    public function handle(): void
    {
        $sitemap = Sitemap::create();

        foreach (['fr', 'en'] as $lang) {
            $sitemap->add(Url::create(url("/{$lang}"))->setPriority(1.0)->setChangeFrequency('weekly'));
            $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'a-propos' : 'about')))->setPriority(0.8));
            $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'usines' : 'factories')))->setPriority(0.8));
            $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'produits' : 'products')))->setPriority(0.9));
            $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'qualite' : 'quality')))->setPriority(0.7));
            $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'durabilite' : 'sustainability')))->setPriority(0.7));
            $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'actualites' : 'news')))->setPriority(0.8));
            $sitemap->add(Url::create(url("/{$lang}/contact"))->setPriority(0.6));

            Product::active()->each(function ($p) use ($sitemap, $lang) {
                $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'produits' : 'products')."/{$p->slug}"))->setPriority(0.8));
            });

            Article::published()->each(function ($a) use ($sitemap, $lang) {
                $sitemap->add(Url::create(url("/{$lang}/".($lang === 'fr' ? 'actualites' : 'news')."/{$a->slug}"))->setPriority(0.6)->setLastModificationDate($a->updated_at));
            });
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap generated.');
    }
}
