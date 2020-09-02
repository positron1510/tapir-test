<?php

namespace App\Repositories;


class BaseRepository
{
    public $model;

    public $request;

    public function __construct(string $model)
    {
        $this->model = sprintf('\\%s', $model);
    }

    public function setRequest(array $request)
    {
        $this->request = $request;
    }

    public function getRequest(): array
    {
        return $this->request;
    }
}
