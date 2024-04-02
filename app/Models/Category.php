<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'description'
    ];

     /**
     * Get the product for the category.
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }

     /**
     * Get the product for the category.
     */
    public function designer()
    {
        return $this->hasMany(Designer::class);
    }
}
