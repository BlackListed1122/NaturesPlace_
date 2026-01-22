<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'quantity',
        'price',
        'subtotal',
        'total',
        'active'
    ];

    protected $casts = [
        'product_id' => 'array',
        'name' => 'array',
        'quantity' => 'array',
        'price' => 'array',
        'subtotal' => 'array',
        'total',

        // Laravel automatically converts JSON to array
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
