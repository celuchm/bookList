<?php

/**
 * Created by PhpStorm.
 * User: mc
 * Date: 14.05.17
 * Time: 20:45
 */
class Book implements JsonSerializable {
    private $id,
            $title,
            $author,
            $year,
            $publisher;

    public $db;

    public function __construct($id = null)
    {
        $this->db = db::getInstance();
        if( is_null($id) ){
            $this->setId(-1);
        } else {
            $this->loadBookById($id);
        }

    }

    private function loadBookById($id){
        $bookData = $this->db->query("select", "Book", array("columns" => "*", "where" => array(array("id", "=", $id))), null)->getFirstRow();
        //var_dump($bookData);
        $this->setId($bookData->id);
        $this->setAuthor($bookData->author);
        $this->setTitle($bookData->title);
        $this->setYear($bookData->year);
        $this->setPublisher($bookData->publisher);
    }

    public function saveBookToDb(){
        if( $this->getId() == -1 ){
            $this->db->query("insert", "Book", array("into"=> array(
                "author"    =>$this->getAuthor(),
                "title"     =>$this->getTitle(),
                "year"      =>$this->getYear(),
                "publisher" =>$this->getPublisher())), null);
            $this->setId($this->db->getLastId());
        } else {
            $this->db->query("update", "Book", array("set"=>array(
                "author"    =>$this->getAuthor(),
                "title"     =>$this->getTitle(),
                "year"      =>$this->getYear(),
                "publisher" =>$this->getPublisher()
            ),
                "where"     =>array(array("id", "=", $this->getId()))), null);
        }
    }

    public static function loadAllBooks(){
        $db = db::getInstance();
        $allBooksArray = [];
        if(  $allBooksId = $db->query("select", "Book", array("columns" => array("id")), null)->getResult() ){
            for( $i=0; $i<count($allBooksId); $i++ ){
                $allBooksArray[] = new Book($allBooksId[$i]->id);
            }
        } else {
            var_dump( $db->getErrors() );
            die();
        }
        return $allBooksArray;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Book
     */
    private function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     * @return Book
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }


    function jsonSerialize()
    {
        return[
            'title'=>$this->getTitle(),
            'author'=>$this->getAuthor(),
            'year'=>$this->getYear(),
            'publisher'=>$this->getPublisher(),
            'id'=>$this->getId()
        ];
    }
}