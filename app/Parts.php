<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    protected $table    = "claims_parts";
    public $timestamps = false;

    protected $fillable = [
        'id', 'claims_id', 'part_description', 'part_number', 'part_image'
    ];

}
