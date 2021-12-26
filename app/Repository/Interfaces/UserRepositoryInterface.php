<?php

namespace App\Repository\Interfaces;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function create(array $attributes) : Model;
}
