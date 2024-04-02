<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'designer_id',
        'category_id',
        'image',
        'name',
        'description',
        'price',
    ];

      /**
     * Get the product that owns the designer.
     */
    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

     /**
     * Get the product that owns the category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

      /**
     * Get the like for the product.
     */
    public function like()
    {
        return $this->hasMany(Like::class);
    }

     /**
     * Get the comment for the product.
     */
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
