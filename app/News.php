<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Sluggable;

    protected $fillable = [
        'slug',
        'image',
        'head',
        'short',
        'text',
        'time',
        'active',
        'important'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'head',
                'maxLength' => null,
                'maxLengthKeepWords' => true,
                'method' => null,
                'separator' => '-',
                'unique' => true,
                'uniqueSuffix' => null,
                'includeTrashed' => false,
                'reserved' => null,
                'onUpdate' => false
            ]
        ];
    }
    
    public $timestamps = false;
}