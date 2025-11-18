<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'nama_pelanggan',
        'ulasan',
        'komen',
    ];

    /**
     * Get the product that this review belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}