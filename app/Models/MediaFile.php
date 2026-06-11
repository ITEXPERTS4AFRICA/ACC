<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model {
    protected $fillable = ['name','path','disk','mime_type','type','size','alt','uploaded_by'];

    public function getPublicUrlAttribute(): string {
        return asset('storage/'.$this->path);
    }
    public function getFormattedSizeAttribute(): string {
        if ($this->size < 1024) return $this->size.' B';
        if ($this->size < 1048576) return round($this->size / 1024, 1).' KB';
        return round($this->size / 1048576, 1).' MB';
    }
    public function uploader() {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    public function scopeImages($q) { return $q->where('type', 'image'); }
    public function scopePdfs($q) { return $q->where('type', 'pdf'); }
}
