<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackingList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'packing_date',
        'shipped_date',
        'shipping_status',
        'tracking_details'
    ];

    /**
     * Define a relationship with the Order model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    // public function items() : HasMany
    // {
    //     return $this->hasMany(PackingListItem::class);
    // }
}
