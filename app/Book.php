<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Book extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = [
        'author',
        'title',
        'isbn',
        'publisher',
        'available',
        'code',
        'pages',
        'price',
        'language',
        'edition',
        'description',
        'user_id'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
