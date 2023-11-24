<?php

namespace App\Classes\Comment;

class Comment
{
    protected $commentID;
    protected $userID;
    protected $bookID;
    protected $comment;
    protected $dateCreated;
    protected $isApproved;
    protected $isDeclined;


    public function __construct($data)
    {
        $this->commentID = $data['id'];
        $this->bookID = $data['book_id'];
        $this->userID = $data['user_id'];
        $this->comment = $data['comment'];
        $this->dateCreated = $data['dateCreated'];
        $this->isApproved = $data['is_approved'];
        $this->isDeclined = $data['is_declined'];
    }

    public function getCommentID(): mixed
    {
        return $this->commentID;
    }

    public function getBookID(): mixed
    {
        return $this->bookID;
    }

    public function getUserID(): mixed
    {
        return $this->userID;
    }

    public function getComment(): mixed
    {
        return $this->comment;
    }

    public function getDateCreated(): mixed
    {
        return $this->dateCreated;
    }

    public function isApproved(): mixed
    {
        return $this->isApproved;
    }

    public function isDeclined(): mixed
    {
        return $this->isDeclined;
    }
}