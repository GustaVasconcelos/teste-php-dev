<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Utils\Cryptography;
use Illuminate\Support\Facades\Hash;

class UserService {

    public function __construct
    (
        protected UserRepository $userRepository,
        protected Hash $hash,
        protected Cryptography $cryptography
    )
    {}

    public function create(array $data): User
    {
        $formatData = $this->formatData($data);

        return $this->userRepository->create($formatData);
    }

    private function formatData (array $data): array
    {
        $data['password'] = $this->cryptography->encrypt($data['password']);

        return $data;
    }

}