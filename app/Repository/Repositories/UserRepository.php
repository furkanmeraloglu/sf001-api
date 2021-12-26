<?php

namespace App\Repository\Repositories;

use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $attributes) : Model
    {
        return User::create($attributes);
    }
}
