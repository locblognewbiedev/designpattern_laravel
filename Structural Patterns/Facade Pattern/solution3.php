Bối cảnh:
Bạn có một hệ thống quản lý thư viện bao gồm các thành phần như hệ thống quản lý sách, hệ thống quản lý thành viên và hệ thống quản lý mượn trả sách

<?php

class BookCatalog
{
    public function findBook($title)
    {
        echo "Finding book: $title.\n";
    }

    public function addBook($title, $author)
    {
        echo "Adding book: $title by $author.\n";
    }
}

class MemberManagement
{
    public function addMember($name)
    {
        echo "Adding member: $name.\n";
    }

    public function findMember($name)
    {
        echo "Finding member: $name.\n";
    }
}

class BorrowingSystem
{
    public function borrowBook($title, $memberName)
    {
        echo "$memberName is borrowing $title.\n";
    }

    public function returnBook($title, $memberName)
    {
        echo "$memberName is returning $title.\n";
    }
}
class LibraryFacade
{
    protected $bookCatalog;
    protected $memberManagement;
    protected $borrowingSystem;

    public function __construct()
    {
        $this->bookCatalog = new BookCatalog();
        $this->memberManagement = new MemberManagement();
        $this->borrowingSystem = new BorrowingSystem();
    }

    public function registerMemberAndBorrowBook($memberName, $bookTitle)
    {
        $this->memberManagement->addMember($memberName);
        $this->bookCatalog->findBook($bookTitle);
        $this->borrowingSystem->borrowBook($bookTitle, $memberName);
    }
}
$libraryFacade = new LibraryFacade();
$libraryFacade->registerMemberAndBorrowBook('John Doe', 'The Great Gatsby');

