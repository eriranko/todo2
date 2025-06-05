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
        'deadline'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function point() {
        return $this->belongsTo(Point::class);
    }
}
