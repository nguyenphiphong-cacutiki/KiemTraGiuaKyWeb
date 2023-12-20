<?php 
class Book{
    private $id;
    private $title;
    private $author;
    private $public;
    private $genres; // ten the loai
    private $genresID;

    private $conn = null;
    public function __construct($db)
    {
        if($db != null){
            $this->conn = $db->getConn();
        }
    }
    

    function all(){
        $arrRes = [];
        $stmt = $this->conn->prepare("select b.bookID, b.title, b.author, b.publicationYear, g.genreName as genres from books b inner join geners g on b.genreID = g.GenreID order by b.bookId desc");
        $stmt->execute();
        $arr = $stmt->fetchAll();
        if($stmt->rowCount())
        foreach($arr as $obj){
            $book = new Book(new Database());
            // $customer->setConn($this->conn);
            $book->setData($obj['bookID'], $obj['title'], $obj['author'], $obj['publicationYear'], $obj['genres']);
            $arrRes[] = $book;
        }
        return $arrRes;
    }
    function find($id){
        $stmt = $this->conn->prepare("select bookid, title, author, publicationYear, genreid  from books where bookID = :id");
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch();
        if($res){
            $book = new Book(new Database());
            // $customer->setConn($this->conn);
            $book->setData($res['bookid'], $res['title'], $res['author'], $res['publicationYear'], $res['genreid']);
            // echo 'oke'; exit(1);
            return $book;
        } 
        echo 'null'; exit(1);
        return null;
    }
    function save(){
        $stmt = $this->conn->prepare("insert into books values(0,'".$this->title."', '".$this->author."', '".$this->public."', '".$this->genres."')");
        $stmt->execute();
    }
    // function update(){
    //     $stmt = $this->conn->prepare("update khach_hang set name = :name, describes = :describes, import = :import where id = :id");
    //     $stmt->execute(['name' => $this->name, 'describes' => $this->describes, 'import' => $this->import, 'id' => $this->id]);
    // }
    function delete(){
        // echo $this->id;
        $stmt = $this->conn->prepare('delete from books where BookID=:id');
        $stmt->execute(['id' => $this->id]);
    }



    public function setData($id, $title, $author, $public, $genres){
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->public = $public;
        $this->genres = $genres;
    }
    function getTitle(){
        return $this->title;
    }
    function getAuthor(){
        return $this->author;
    }
    function getId(){
        return $this->id;
    }
    function getPublic(){
        return $this->public;
    }
    function getGenres(){
        return $this->genres;
    }


    function setId($id){
        $this->id = $id;
    }

    // function setTitle($name){
    //     $this->name = $name;
    // }
    // function setDescripbes($describes){
    //     $this->describes = $describes;
    // }
    // function setImport($import){
    //     $this->import = $import;
    // }
    // function setConn($conn){
    //     $this->conn = $conn;
    // }
}