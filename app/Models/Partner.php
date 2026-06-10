<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model {
    protected $fillable = ['name','logo','website','order','active'];
    protected $casts = ['active' => 'boolean'];
    public function scopeActive($q) { return $q->where('active', true)->orderBy('order'); }
}
