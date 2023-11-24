<?php

namespace App\Database;

use PDO;

class SQLQuery
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function getBooksData()
    {
        $query = "SELECT * FROM books ORDER BY title ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        Database::terminateConnection();
        return $data;
    }


    public function getAuthorData()
    {
        $query = "SELECT * FROM authors WHERE is_deleted=0 ORDER BY firstname ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        Database::terminateConnection();
        return $data;
    }

    public function getAuthorByID($authorID)
    {
        $query = "SELECT * FROM authors WHERE is_deleted=0 AND id=$authorID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        Database::terminateConnection();
        return $data;
    }

    public function getComments()
    {
        $query = "SELECT * FROM comments ORDER BY dateCreated ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        Database::terminateConnection();
        return $data;
    }

    public function getCommentByID($commentID)
    {
        $query = "SELECT COMM.*, USER.username, BOOK.title FROM comments AS COMM 
                    JOIN users AS USER on COMM.user_id = USER.id
                    JOIN books AS BOOK on COMM.book_id = BOOK.id
                    WHERE COMM.id=$commentID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        Database::terminateConnection();
        return $data;
    }

    public function getCommentsByBookID($bookID)
    {
        $query = "SELECT comments.id AS commentID, comments.comment  AS comment, comments.dateCreated AS dateCreated,comments.is_approved AS is_approved, users.username FROM comments
                    JOIN users on comments.user_id = users.id
                    JOIN books on comments.book_id = books.id
                    WHERE comments.book_id=$bookID";
//        and comments.is_approved=1
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        Database::terminateConnection();
        return $data;
    }


    public function getCategories()
    {
        $query = "SELECT * FROM categories WHERE is_deleted=0 ORDER BY categoryName ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getCategoryByID($categoryID)
    {
        $query = "SELECT * FROM categories WHERE id = $categoryID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getUsers()
    {
//        WHERE is_admin = 0
        $query = "SELECT * FROM users";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function approveComment($id, $comment = null)
    {
        if (isset($comment)) {
            $query = "UPDATE comments
                    SET comment = '$comment', is_approved = 1, is_declined = 0
                    WHERE id = $id";
        } else {
            $query = "UPDATE comments
                    SET is_approved = 1, is_declined = 0
                    WHERE id = $id";
        }
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }

    public function declineComment($commentID)
    {
        $query = "UPDATE comments
                    SET is_declined = 1
                    WHERE id = $commentID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }

//    public function getAllData()
//    {
//        $query = "SELECT comment.id, COMMENT.comment, COMMENT.dateCreated, COMMENT.is_approved,
//                    USER.username, BOOK.title FROM `comments` as COMMENT
//                    JOIN books as BOOK on COMMENT.book_id = BOOK.id
//                    JOIN users as USER on COMMENT.user_id = USER.id
//                    ORDER BY COMMENT.dateCreated DESC";
//        $statement = $this->connection->prepare($query);
//        $statement->execute();
//        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
//        return $data;
//    }

    public function deleteComment($commentID)
    {
        $query = "DELETE FROM comments
                    WHERE id = $commentID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }

    public function getBookByID($id)
    {
        $query = "SELECT * FROM books WHERE id = $id";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function requestBookByID($id)
    {
        $query = "SELECT books.title AS title, books.imgUrl AS imgURL, books.pages AS pages, books.releaseYear AS releaseYear, 
                  authors.firstname AS authorFirstName, authors.lastname AS authorLastName, authors.shortBiography AS shortBiography, authors.is_deleted AS author_isDeleted,
                  categories.categoryName AS categoryName, categories.is_deleted AS category_isDeleted 
                  FROM books
                    JOIN authors ON author_id = authors.id
                    JOIN categories on category_id = categories.id
                    WHERE books.id = $id";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function modifyBook($bookData)
    {
        $query = "UPDATE books
         SET author_id = :authorID,
             title = :bookName,
             category_id = :bookCategory,
             releaseYear = :bookReleaseYear,
             imgUrl = :bookImageURL,
             pages = :bookPages
             WHERE id = :bookID";
        $statement = $this->connection->prepare($query);
        $statement->execute($bookData);
    }

    public function addNewBook($newBook)
    {
        $query = "INSERT INTO books (author_id, title, category_id, releaseYear, imgUrl, pages)
         values(:authorID,
             :bookName,
             :bookCategory,
             :bookReleaseYear,
             :bookImageURL,
             :bookPages)";
        $statement = $this->connection->prepare($query);
        $statement->execute($newBook);
    }

    public function deleteBook($bookID)
    {
        $query = "DELETE FROM books WHERE id = $bookID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }

    public function modifyAuthor($data)
    {
        $query = "UPDATE authors 
                    SET firstname = :authorFirstName,
                        lastname = :authorLastName,
                        shortBiography = :authorBiography
                    WHERE id = :authorID";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function deleteAuthor($authorID)
    {
        $query = "UPDATE authors SET is_deleted = 1 
                    WHERE id = $authorID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }

    public function addNewAuthor($data)
    {
        $query = "INSERT INTO authors (firstname, lastname, shortBiography) 
                    VALUES(:authorFirstName, :authorLastName, :authorBiography)";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function addNewCategory($data)
    {
        $query = "INSERT INTO categories (categoryName) 
                    VALUES(:categoryName)";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function deleteCategory($categoryID)
    {
        $query = "UPDATE categories SET is_deleted = 1 
                    WHERE id = $categoryID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }

    public function modifyCategory($data)
    {
        $query = "UPDATE categories 
                    SET categoryName = :categoryName
                    WHERE id = :categoryID";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function getUserByName($name)
    {
        $query = "SELECT * FROM users WHERE username = '$name'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createNewUser($data)
    {
        $query = "INSERT INTO users (firstName, lastName, username, password) 
                    VALUES(:firstName, :lastName, :username, :password)";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function getLastCreatedUserID()
    {
        $query = "SELECT MAX(Id) AS id FROM users";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createNewComment($data)
    {
        $query = "INSERT INTO comments (comment, user_id, book_id) 
                    VALUES(:comment, :userID, :bookID)";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function createNewNote($data)
    {
        $query = "INSERT INTO personal_notes (note, user_id, book_id) 
                    VALUES(:createNote, :userID, :bookID)";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function updateNotes($bookID, $userID)
    {
        $query = "SELECT * FROM personal_notes WHERE book_id = $bookID AND user_id=$userID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deleteNote($noteID)
    {
        $query = "DELETE FROM personal_notes WHERE id = $noteID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }

    public function getNoteByID($noteID)
    {
        $query = "SELECT * FROM personal_notes WHERE id = $noteID";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateNoteByID($noteID, $newNote)
    {
        $query = "UPDATE personal_notes
                    SET note = '$newNote'
                    WHERE id = $noteID";
        $statement = $this->connection->prepare($query);
        $statement->execute();

    }

}
