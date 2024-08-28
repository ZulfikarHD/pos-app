<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * Define a one-to-many relationship with the Order model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
