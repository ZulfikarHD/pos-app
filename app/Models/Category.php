<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Define a one-to-many relationship with the Product model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
