<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleMake extends Model
{
    protected $table    = "vehiclemake";

    protected $fillable = [
        'id', 'vehiclemake', 'remarks'
    ];

    public function MakeInfo()
    {
        return $this->hasMany(Claims::class, 'id');
    }
}
