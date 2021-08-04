<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Repositories\EloquentRepository;

class Movie extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = \App\Models\Movie::class;

//    public function getGridColumns()
//    {
//        return ['id', 'title', 'director', 'rate', 'released', 'release_at'];
//    }
}
