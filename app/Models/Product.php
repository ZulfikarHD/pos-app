<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'category_id',
    ];

    /**
     * Define a relationship with the Category model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Define a one-to-many relationship with the OrderItem model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems() : HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
