<?php

namespace App\Classes\Author;

class Author
{
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $shortBiography;
    protected $isDeleted;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->firstName = $data['firstname'];
        $this->lastName = $data['lastname'];
        $this->shortBiography = $data['shortBiography'];
        $this->isDeleted = $data['is_deleted'];
    }

    public function getFullName()
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function getID(): mixed
    {
        return $this->id;
    }

    public function getFirstName(): mixed
    {
        return $this->firstName;
    }

    public function getLastName(): mixed
    {
        return $this->lastName;
    }

    public function getShortBiography(): mixed
    {
        return $this->shortBiography;
    }

    public function IsDeleted(): mixed
    {
        return $this->isDeleted;
    }
}