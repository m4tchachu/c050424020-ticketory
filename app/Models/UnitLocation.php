<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitLocation extends Model
{
    //
    protected $fillable = ['name'];

    public function units()
    {
        return $this->hasMany(Unit::class, 'unit_location_id');
    }
}
