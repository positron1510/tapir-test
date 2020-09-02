<?php

namespace App\Models;


class Photo extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'advertisement_id', 'url',
    ];
}
