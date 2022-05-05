<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\LunchboxPrototype;

class Ingredient extends LunchboxPrototype
{
    use HasFactory;

    function __construct() {
        parent::__construct();
        $this->fillable[] = 'type';
    }

    public function recipes() {
        return $this->belongsToMany(Recipe::class);
    }
}
