<?php

namespace App\Repositories;

use App\Models\User as UserModel;
use App\Exceptions\NotFoundException;
use App\Exceptions\InvalidException;

class User extends BaseRepository
{
    protected $searchable = [
        'name',
        'email',
    ];

    function __construct()
    {
        parent::__construct(new UserModel);
    }

    public function list(string $search = null): array
    {
        $users = parent::list($search);

        foreach ($users as $user) {
            $user = $this->removePassword($user);
        }

        return $users;
    }

    public function create(array $resource): array
    {
        $this->assertEmailIsUnique($resource['email'], null);
        $resource['password'] = $this->generate_hash($resource['password']);
        $user = parent::create($resource);
        return $this->removePassword($user);
    }

    public function update(int $id, array $data): array
    {
        $old = $this->find($id);
        
        if ($data['email'] != $old['email']) {
            $this->assertEmailIsUnique($data['email'], $id);
        }
        
        if (!empty($data['password'])) {
            $data['password'] = $this->generate_hash($data['password']);
        } else {
            $data = $this->removePassword($data);
        }
        $user = parent::update($id, $data);
        $user = $this->removePassword($user);
        return $user;
    }

    public function find(int $id): array
    {
        $user = parent::find($id);
        $user = $this->removePassword($user);
        return $user;
    }

    public function findByEmail(string $email, $id = null): array
    {
        $user = $this->model->where('email', $email);

        if ($id !== null) {
            $user->where('id', '<>', $id);
        }

        if (!$user->first()) {
            throw new NotFoundException();
        }

        return $user->first()->toArray();
    }

    private function generate_hash(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function removePassword(array $user)
    {
        unset($user['password']);
        return $user;
    }

    private function assertEmailIsUnique(string $email, $id = null)
    {
        if(!empty($this->model->where('email', $email)->first())){
            throw new InvalidException("Este e-mail já está sendo usado com Usuário");
        }
        return true;
    }
}
