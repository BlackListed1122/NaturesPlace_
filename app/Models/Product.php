<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product_listings';

    protected $fillable = [
        'name',
        'description',
        'flavor',
        'category',
        'size',
        'price',
        'avatar',

    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
