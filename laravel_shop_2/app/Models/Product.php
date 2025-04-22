<?php

namespace App\Models;

use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillables = 'brand_id';
    protected $guarded = [];

    public function brand() {
        return $this->belongsTo(
            Brand::class,
            'brand_id',
            'id'
        );
    }

    public function productCategory() {
        return $this->belongsTo(
            ProductCategory::class,
            'product_category_id',
            'id'
        );
    }

    public function productComments() {
        return $this->hasMany(
            ProductComment::class,
            'product_id',
            'id'
        );
    }

    public function productDetails() {
        return $this->hasMany(
            ProductDetail::class,
            'product_id',
            'id'
        );
    }

    public function productImages() {
        return $this->hasMany(
            ProductImage::class,
            'product_id',
            'id'
        );
    }

    public function orderDetails() {
        return $this->hasMany(
            OrderDetail::class,
            'product_id',
            'id'
        );
    }

    
}
