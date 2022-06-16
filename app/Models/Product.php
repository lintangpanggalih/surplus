<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'enable'];

    function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
    function images()
    {
        return $this->belongsToMany(Image::class, 'product_image');
    }
}
