<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PurchasePrice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchases_price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'purchases_price', 'number_days', 'probability', 'accumulate_probability',
    ];
}
