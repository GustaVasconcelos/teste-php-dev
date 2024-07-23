<?php

namespace App\Services\Auth;

use App\Exceptions\AuthenticationException;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Utils\Cryptography;

class AuthService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected Cryptography $cryptography
    )
    {}

    public function authenticate(array $data): User
    {
        $user = $this->userRepository->findByEmail($data['email']);
        
        if (!$user || !$this->cryptography->compare($data['password'], $user->password)) {
            throw new AuthenticationException('Credenciais inválidas.');
        }

        return $user;
    }
}
