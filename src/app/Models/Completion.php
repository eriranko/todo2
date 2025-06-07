<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'category_id',
        'point_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function point() {
        return $this->belongsTo(Point::class);
    }
}
