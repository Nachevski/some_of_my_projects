<?php

namespace App\Classes\User;

class User
{
    protected $userID;
    protected $username;
    protected $firstName;
    protected $lastName;

    public function __construct($data)
    {
        $this->userID = $data['id'];
        $this->username = $data['username'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
    }

    public function getUserID(): mixed
    {
        return $this->userID;
    }

    public function getLastName(): mixed
    {
        return $this->lastName;
    }

    public function getFirstName(): mixed
    {
        return $this->firstName;
    }

    public function getUsername(): mixed
    {
        return $this->username;
    }
}