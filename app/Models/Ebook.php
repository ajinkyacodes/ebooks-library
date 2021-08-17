<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'author',
        'description',
        'ebook_file',
        'featured_image',
        'category_id',
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
