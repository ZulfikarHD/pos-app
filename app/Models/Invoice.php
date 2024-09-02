<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'invoice_date',
        'total_amount',
        'status',
    ];

    /**
     * Define a relationship with the Order model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id','order_id');
    }

    /**
     * Define a one-to-many relationship with the Payment model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }
}
