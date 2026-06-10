<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $fillable = ['title','title_en','slug','tag','tag_en','excerpt','excerpt_en','content','content_en','image','published','published_at'];
    protected $casts = ['published' => 'boolean', 'published_at' => 'datetime'];

    public function getTitleLocaleAttribute(): string {
        return app()->getLocale() === 'en' && $this->title_en ? $this->title_en : $this->title;
    }
    public function getExcerptLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->excerpt_en ? $this->excerpt_en : $this->excerpt;
    }
    public function getContentLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->content_en ? $this->content_en : $this->content;
    }
    public function getTagLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->tag_en ? $this->tag_en : $this->tag;
    }
    public function scopePublished($q) { return $q->where('published', true)->orderByDesc('published_at'); }
}
