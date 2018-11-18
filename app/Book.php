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
        'isbn',
        'publisher',
        'available',
        'code',
        'pages',
        'price',
        'language',
        'edition',
        'description',
        'category_id',
        'user_id'
    ];

    public function category() {
        return $this->hasMany(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
