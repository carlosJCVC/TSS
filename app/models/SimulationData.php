<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SimulationData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'simulation_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'product_id',
        'demand',
        'sale_price',
        'purchase_price',
        'purchase_cost',
        'excess_cost',
        'benefits',
        'excess_cost_18',
        'benefits_18',
        'excess_cost_19',
        'benefits_19',
        'excess_cost_20',
        'benefits_20',
        'excess_cost_21',
        'benefits_21',
        'excess_cost_22',
        'benefits_22',
        'excess_cost_23',
        'benefits_23',
        'excess_cost_24',
        'benefits_24',
        'excess_cost_25',
        'benefits_25',
        'excess_cost_26',
        'benefits_26',
    ];
}
