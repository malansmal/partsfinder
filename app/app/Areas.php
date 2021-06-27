<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table    = "areas";

    protected $fillable = [
        'id', 'areaname', 'remarks'
    ];

    public function AreaInfo()
    {
        return $this->hasMany(Claims::class, 'id');
    }
}
