<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'point_id',
        'content',
        'deadline',
        'is_completed',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function point() {
        return $this->belongsTo(Point::class);
    }

    public function scopeKeywordSearch($query, $keyword) {
        if (!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
    }

    public function scopeCategorySearch($query, $category_id) {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopePointSearch($query, $point_id) {
        if(!empty($point_id)) {
            $query->where('point_id', $point_id);
        }
    }
}
