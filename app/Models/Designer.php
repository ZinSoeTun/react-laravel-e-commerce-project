<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

      /**
     * Get the designer for the product.
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }

      /**
     * Get the product that owns the category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
