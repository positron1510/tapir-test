<?php

namespace App\Models;

use App\Repositories\AdvertisementRepository;


class Advertisement extends BaseModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->repository = new AdvertisementRepository(__CLASS__);
    }

    protected $fillable = [
        'title', 'description', 'price',
    ];

    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }
}
