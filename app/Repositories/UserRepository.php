<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function getAll()
    {
        return User::all();
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function update($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function updateLastLogin($username)
    {
        $user = User::where('username', $username)->first();
        $user->last_login = date('Y/m/d H:i:s');
        $user->save();
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function is_Manager($id)
    {
        $user = User::findOrFail($id);
        if ($user->role == 'manager')
        {
            return true;
        }
        return false;
    }
}