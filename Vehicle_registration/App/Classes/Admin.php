<?php
declare(strict_types=1);

namespace App\Classes;

class Admin
{
    private int $id;
    private string $username;
    private string $password;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}