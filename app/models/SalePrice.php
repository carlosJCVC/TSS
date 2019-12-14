<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SalePrice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'sales_price', 'number_days', 'probability', 'accumulate_probability',
    ];
}
