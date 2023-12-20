<?php 
class Genre{
    private $id;
    private $name;
 

    private $conn = null;
    public function __construct($db)
    {
        if($db != null){
            $this->conn = $db->getConn();
        }
    }
    

    function all(){
        $arrRes = [];
        $stmt = $this->conn->prepare('select genreID, genreName from geners');
        $stmt->execute();
        $arr = $stmt->fetchAll();
        if($stmt->rowCount())
        foreach($arr as $obj){
            $genre = new Genre(new Database());
            // $customer->setConn($this->conn);
            $genre->setData($obj['genreID'], $obj['genreName']);
            $arrRes[] = $genre;
        }
        return $arrRes;
    }
    // function find($id){
    //     $stmt = $this->conn->prepare("select * from books where bookID = :id");
    //     $stmt->execute(['id' => $id]);
    //     $res = $stmt->fetch();
    //     if($res){
    //         $book = new Book(new Database());
    //         // $customer->setConn($this->conn);
    //         $book->setData($res['bookID'], $res['title'], $res['author'], $res['publicationYear'], $res['genres']);
    //         return $book;
    //     } 
    //     return null;
    // }
    // function save(){
    //     $stmt = $this->conn->prepare("insert into khach_hang values(0,'".$this->name."', '".$this->describes."', '".$this->import."')");
    //     $stmt->execute();
    // }
    // function update(){
    //     $stmt = $this->conn->prepare("update khach_hang set name = :name, describes = :describes, import = :import where id = :id");
    //     $stmt->execute(['name' => $this->name, 'describes' => $this->describes, 'import' => $this->import, 'id' => $this->id]);
    // }
    // function delete(){
    //     // echo $this->id;
    //     $stmt = $this->conn->prepare('delete from khach_hang where id=:id');
    //     $stmt->execute(['id' => $this->id]);
    // }



    public function setData($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
    function getName(){
        return $this->name;
    }
    function getId(){
        return $this->id;
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