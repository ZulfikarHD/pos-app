<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'user_id',
        'order_date',
        'status',
    ];

    /**
     * Define a relationship with the Customer model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Define a relationship with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Define a one-to-many relationship with the OrderItem model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems() : HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id','order_id');
    }

    /**
     * Define a one-to-one relationship with the Invoice model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice() : HasOne
    {
        return $this->hasOne(Invoice::class, 'order_id','order_id');
    }

    /**
     * Define a one-to-one relationship with the PackingList model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function packingList() : HasOne
    {
        return $this->hasOne(PackingList::class, 'order_id', 'order_id');
    }

    public function logs() : HasMany
    {
        return $this->hasMany(OrderLog::class);
    }
}
