<?php

namespace App\Classes\Book;

class Book
{
    protected $bookID;
    protected $authorID;
    protected $title;
    protected $categoryID;
    protected $pages;
    protected $imgURL;
    protected $releaseYear;

    public function __construct($data)
    {
        $this->bookID = $data['id'];
        $this->authorID = $data['author_id'];
        $this->categoryID = $data['category_id'];
        $this->title = $data['title'];
        $this->pages = $data['pages'];
        $this->imgURL = $data['imgUrl'];
        $this->releaseYear = $data['releaseYear'];
    }

    public function getBookID(): mixed
    {
        return $this->bookID;
    }

    public function getAuthorID(): mixed
    {
        return $this->authorID;
    }

    public function getCategoryID(): mixed
    {
        return $this->categoryID;
    }

    public function getTitle(): mixed
    {
        return $this->title;
    }

    public function getImgURL(): mixed
    {
        return $this->imgURL;
    }

    public function getPages(): mixed
    {
        return $this->pages;
    }

    public function getReleaseYear(): mixed
    {
        return $this->releaseYear;
    }


}