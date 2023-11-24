<?php
require_once("importAll.php");

use App\Classes\Author\Author;
use App\Classes\Book\Book;
use App\Classes\Category\Category;
use App\Classes\Comment\Comment;
use App\Classes\User\User;
use App\Database\SQLQuery;

function updateBooks()
{
    $books = [];
    $conn = new SQLQuery();
    $bookData = $conn->getBooksData();

    if (is_array($bookData)) {
        foreach ($bookData as $book) {
            $books[] = new Book($book);
        }
    }
    return $books;
}

function getBookByID($books, $id)
{
    foreach ($books as $book) {
        if ($book->getBookID() == $id) {
            return $book;
        }
    }
}

function requestBookByID($bookID)
{
    $conn = new SQLQuery();
    $bookData = $conn->requestBookByID($bookID);
    return $bookData;
}

function getBooksByAuthor($books, $id)
{
    $booksBySameAuthor = [];
    foreach ($books as $book) {
        if ($book->getAuthorID() == $id) {
            $booksBySameAuthor [] = $book;
        }
    }
    return $booksBySameAuthor;
}

function modifyBook($newData)
{
    $conn = new SQLQuery();
    $bookData = $conn->modifyBook($newData);
}

function addNewBook($newBook)
{
    $conn = new SQLQuery();
    $bookData = $conn->addNewBook($newBook);
}

function updateAuthors()
{
    $authors = [];
    $conn = new SQLQuery();
    $authorData = $conn->getAuthorData();

    if (is_array($authorData)) {
        foreach ($authorData as $author) {
            $authors[] = new Author($author);
        }
    }
    return $authors;
}

function getAuthorByID($authors, $id)
{
    foreach ($authors as $author) {
        if ($author->getID() == $id && !$author->isDeleted()) {
            return $author;
        }
    }
    return null;
}

function updateComments()
{
    $comments = [];
    $conn = new SQLQuery();
    $commentsData = $conn->getComments();

    if (is_array($commentsData)) {
        foreach ($commentsData as $comment) {
            $comments[] = new Comment($comment);
        }
    }
    return $comments;
}

function unApprovedComments($comments)
{
    $unApprovedComments = [];
    foreach ($comments as $comment) {
        if (!$comment->isApproved()) {
            $unApprovedComments [] = $comment;
        }
    }
    return $unApprovedComments;
}

function declinedComments($comments)
{
    $unApprovedComments = [];
    foreach ($comments as $comment) {
        if ($comment->isDeclined()) {
            $unApprovedComments [] = $comment;
        }
    }
    return $unApprovedComments;
}


function updateCategories()
{
    $categories = [];
    $conn = new SQLQuery();
    $categoriesData = $conn->getCategories();

    if (is_array($categoriesData)) {
        foreach ($categoriesData as $category) {
            $categories[] = new Category($category);
        }
    }
    return $categories;
}

function getBooksByCategory($books, $categoryID)
{
    $booksByCategory = [];

    foreach ($books as $book) {
        if ($book->getCategoryID() == $categoryID) {
            $booksByCategory[] = $book;
        }
    }
    return $booksByCategory;
}

function getCategoryByID($categories, $categoryID)
{
    foreach ($categories as $category) {
        if ($category->getCategoryID() == $categoryID && !$category->isDeleted()) {
            return $category;
        }
    }
    return null;
}

function getActiveData($data)
{
    $activeData = [];
    foreach ($data as $value) {
        if (!$value->IsDeleted()) {
            $activeData[] = $value;
        }
    }
    return $activeData;
}

function updateUsers()
{
    $users = [];

    $conn = new SQLQuery();
    $usersData = $conn->getUsers();

    if (is_array($usersData)) {
        foreach ($usersData as $user) {
            $users[] = new User($user);
        }
    }
    return $users;
}

function getUserByID($users, $id)
{
    foreach ($users as $user) {
        if ($user->getUserID() == $id) {
            return $user;
        }
    }
}

function approveComment($id, $comment = null)
{
    $conn = new SQLQuery();
    $conn->approveComment($id, $comment);
}

function declineComment($id)
{
    $conn = new SQLQuery();
    $conn->declineComment($id);
}

function search($keyword, $flag)
{
    $books = updateBooks();
    $result = [];
    $keyword = strtolower($keyword);

    switch ($flag) {
        case 'books':
            $authors = updateAuthors();
            $result = [];
            foreach ($authors as $author) {
                $bookMatched = false;
                $authorFound = false;
                if (str_contains(strtolower($author->getFullName()), strtolower($keyword))) {
                    $result['authors'][] = $author;
                    $authorFound = true;
                }
                foreach ($books as $book) {
                    if ($book->getAuthorID() == $author->getID() && $authorFound) {
                        $result['books'][] = $book;
                        continue;
                    }
                    if ((str_contains(strtolower($book->getTitle()), $keyword)) && $book->getAuthorID() == $author->getID()) {
                        $result['books'][] = $book;
                        $bookMatched = true;
                    }
                }
                if (!$authorFound && $bookMatched) {
                    $result['authors'][] = $author;
                }
            }
            return $result;

        case 'comments':
            $users = updateUsers();
            $comments = updateComments();
            $result = [];
            foreach ($books as $book) {
                $bookMatched = false;
                $userFound = false;
                if (str_contains(strtolower($book->getTitle()), strtolower($keyword))) {
                    $result['books'][] = $book;
                    $bookMatched = true;
                }
                foreach ($comments as $comment) {
                    $user = getUserByID($users, $comment->getUserID());
                    if ($comment->getBookID() == $book->getBookID() && $bookMatched) {
                        $result['comments'][] = $comment;
                        continue;
                    }
                    if ((str_contains(strtolower($user->getUsername()), $keyword)) && $comment->getBookID() == $book->getBookID()) {
                        $result['comments'][] = $comment;
                        $userFound = true;
                    }
                }
                if (!$bookMatched && $userFound) {
                    $result['books'][] = $book;
                }
            }
            return $result;


        case 'authors':
            $authors = updateAuthors();
            $result = [];
            foreach ($authors as $author) {
                if (str_contains(strtolower($author->getFullName()), strtolower($keyword))) {
                    $result['authors'][] = $author;
                }
            }
            return $result;

        case 'categories':
            $categories = updateCategories();
            $result = [];
            foreach ($categories as $category) {
                if (str_contains(strtolower($category->getCategoryName()), strtolower($keyword))) {
                    $result['categories'][] = $category;
                }
            }
            return $result;

    }
}

function countApprovedComments($comments)
{
    $counter = 0;
    foreach ($comments as $comment) {
        if ($comment->isApproved()) $counter++;
    }
    return $counter;
}

function countCommentsByBookID($comments, $bookID)
{
    $counter = 0;
    foreach ($comments as $comment) {
        if ($comment->getBookID() == $bookID && $comment->isApproved()) $counter++;
    }
    return $counter;
}

function getCommentsByBookID($bookID)
{
    $conn = new SQLQuery();
    $data = $conn->getCommentsByBookID($bookID);
    return $data;
}


function deleteBook($bookID)
{
    $conn = new SQLQuery();
    $conn->deleteBook($bookID);
}

function deleteComment($bookID)
{
    $conn = new SQLQuery();
    $conn->deleteComment($bookID);
}


function validateInputData($data)
{
    $validateStatus = [];
    foreach ($data as $index => $input) {
        if ($input == '' || $input == 0) {
            $validateStatus['errors'][$index] = 'Empty input not allowed';
        }
        if ($index == 'authorBiography' && strlen($input) < 20) {
            $validateStatus['errors'][$index] = 'Author biography must be at least 20 characters';
        }

        if ($index == 'password') {
//            $passwordRegexStrong = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
            $passwordRegexNormal = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";

            if (!preg_match($passwordRegexNormal, $input)) {
                $validateStatus['errors'][$index] = 'At least 8 chars (1 UPPER, 1 lower, 1 number)';
            }
        }

    }
    if (empty($validateStatus)) {
        $validateStatus['success'] = true;
    }
    return $validateStatus;
}


function deleteAuthor($authorID)
{
    $conn = new SQLQuery();
    $conn->deleteAuthor($authorID);
}

function modifyAuthor($authorID)
{
    $conn = new SQLQuery();
    $conn->modifyAuthor($authorID);
}


function addNewAuthor($data)
{
    $conn = new SQLQuery();
    $conn->addNewAuthor($data);
}

function addNewCategory($data)
{
    $conn = new SQLQuery();
    $conn->addNewCategory($data);
}

function deleteCategory($categoryID)
{
    $conn = new SQLQuery();
    $conn->deleteCategory($categoryID);
}

function modifyCategory($data)
{
    $conn = new SQLQuery();
    $conn->modifyCategory($data);
}

function getUserByName($name)
{
    $conn = new SQLQuery();
    return $conn->getUserByName($name);
}

function isUsernameExists($user)
{
    $validateResult = [];
    $checkForUser = getUserByName($user);
    if (!empty($checkForUser)) {
        $validateResult['errors']['username'] = 'username is taken!';
    } else {
        $validateResult['success'] = true;
    }
    return $validateResult;
}

function getLoginInfo()
{
    if (isset($_SESSION['loginStatus'])) {
        if (isset($_SESSION['loggedUser'])) {
            if (isset($_SESSION['userRole']) && $_SESSION['userRole'] = 777) {
                return "<span class='loggedUser'>Hello, " . $_SESSION['loggedUser'] . "</span>
                    <a href='./App/dashboard.php' class='btn btn-approve mr-10'>Admin Dashboard</a>
                    <a href='./App/Processing/logout.php' class='btn btn-danger'>Log out</a>";
            }
            return "<span class='loggedUser'>Hello, " . $_SESSION['loggedUser'] . "</span>
                    <a href='./App/Processing/logout.php' class='btn btn-danger'>Log out</a>";
        }
    }
    return '<button id="BTN-Login" class="btn btn-approve">Log in</button>';
}

function getLoggedUser()
{

}

function isAdmin()
{
    if (isset($_SESSION['userRole']) && $_SESSION['userRole'] = 777) {
        return true;
    }
    return false;
}

function createNewUser($data)
{
    $conn = new SQLQuery();
    $conn->createNewUser($data);
}

function getLastCreatedUserID()
{
    $conn = new SQLQuery();
    $lastUSerID = $conn->getLastCreatedUserID();
    return $lastUSerID;
}

function validateLogin($credentials)
{
    $username = $credentials['username'];
    $password = $credentials['password'];
    $getUser = getUserByName($username);

    if (!empty($getUser) && password_verify($password, $getUser['password'])) {
        $loginStatus['success'] = true;
        $loginStatus['userLogged'] = $getUser;
    } else {
        $loginStatus['errors']['username'] = 'Wrong Credentials';
        $loginStatus['errors']['password'] = 'Wrong Credentials';
    }
    return $loginStatus;
}

function createNewComment($data)
{
    $conn = new SQLQuery();
    $conn->createNewComment($data);
}

