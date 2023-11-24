<?php

namespace App\Classes\Category;

class Category
{
    protected $id;
    protected $categoryName;
    protected $isDeleted;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->categoryName = $data['categoryName'];
        $this->isDeleted = $data['is_deleted'];
    }

    public function getCategoryID(): mixed
    {
        return $this->id;
    }

    public function getCategoryName(): mixed
    {
        return $this->categoryName;
    }

    public function IsDeleted(): mixed
    {
        return $this->isDeleted;
    }
}