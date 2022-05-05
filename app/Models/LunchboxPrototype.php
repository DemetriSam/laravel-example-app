<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchboxPrototype extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fats',
        'carbs',
        'proteins',
        'fiber',
        'ccal',
        'description',
        'image'
    ];

    /**
     * Numeric values of ingredient, component, recipe, luchcbox etc. that can be summarized
     */
    protected $countable = [
        'fats',
        'carbs',
        'proteins',
        'fiber',
        'ccal',
    ];

    /**
     * Postfix after fields name like ccal/100gr
     */
    protected $nutPostfix = '/100gr';
}
