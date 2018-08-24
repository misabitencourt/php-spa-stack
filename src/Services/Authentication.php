<?php

namespace App\Services;

use App\Helpers\Session as Session;
use App\Exceptions\UnauthorizedException;
use App\Repositories\User as UserRepository;

class Authentication
{
    private $session;
    private $userRepository;

    public function __construct()
    {
        $this->session = new Session();
        $this->userRepository = new UserRepository();
    }

    public function login($email, $password): array
    {
        $user = $this->userRepository->findByEmail($email);

        if (!password_verify($password, $user['password'])) {
            throw new UnauthorizedException();
        }

        $this->session->set('user.role', $user['role_id']);
        $this->session->set('user.id', $user['id']);
        $this->session->set('user.email', $user['email']);
        $this->session->set('user.name', $user['name']);

        return [
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }

    public function logoff()
    {
        $this->session->close();
    }

    public function isAuthenticated(): bool
    {
        return $this->session->get('user.id') !== null;
    }
}
