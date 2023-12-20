<?php 
require_once 'models/Book.php';
require_once 'models/Genre.php';
class BookController{
    private $db;
    private $book = null;
    function __construct()
    {
        $this->db = new Database();
        $this->book = new Book($this->db);
    }
    function index(){
        $arr = $this->book->all();
        include 'views/index.php';
    }


    function create(){
        $genre = new Genre(new Database());
        $genreNames = $genre->all();
        include 'views/add.php';
    }
    function save(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $book = new book($this->db);
            // $date = DateTime::createFromFormat('d/m/Y', $_POST['import']);
            // echo $_POST['import'];
            // $formattedDate = $date->format('Y/m/d');
            $book->setData(0, $_POST['title'], $_POST['author'], $_POST['public'], $_POST['genre']);
            $book->save();
            header("Location:index.php?message=add-success");
            exit(1);
        }
        header("Location:index.php?message=add-fail");
        exit(1);

    }


    function edit(){
        $id = $_GET['id'];
        $book = $this->book->find($id);
        // echo $book;
        if($book !== null)
            require_once 'views/update.php';
        else echo 'find by id fail';
    }
    // function update(){
    //     if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //         $book = new book($this->db);
    //         $book->setData($_GET['id'], $_POST['name'], $_POST['describes'], $_POST['import']);
    //         $book->update();
    //         header('Location:index.php?message=Update success');
    //         exit(1);
    //     }
    // }


    // function show(){
    //     $id = $_GET['id'];
    //     $book = $this->book->find($id);
    //     require_once 'views/show.php';
    // }



    function delete(){
        $id = $_GET['id'];
        $book = $this->book->find($id);
        $book->delete();
        header('Location:index.php?message=Delete success!');
        exit(1);
    }
}