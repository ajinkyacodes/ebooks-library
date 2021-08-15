<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'featured_image',
        'category_id',
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
