<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {
    protected $fillable = ['key','title','title_en','content','content_en','hero_image','meta_title','meta_title_en','meta_description','meta_description_en','og_image','status'];

    public function getTitleLocaleAttribute(): string {
        return app()->getLocale() === 'en' && $this->title_en ? $this->title_en : $this->title;
    }
    public function getContentLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->content_en ? $this->content_en : $this->content;
    }
    public static function forKey(string $key): ?self {
        return static::where('key', $key)->first();
    }
    public function isPublished(): bool { return $this->status === 'published'; }
}
