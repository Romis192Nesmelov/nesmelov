<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixTax extends Model
{
    protected $fillable = [
        'value',
        'year'
    ];

    public $timestamps = false;
}