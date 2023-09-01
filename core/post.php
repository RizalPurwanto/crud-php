<?php 

class Post {
    private $comn;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $create_at;


    public function __construct($db) 
    {
        $this-> comn =$db;
    }

    public function read() {

        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.create_at
        FROM
        '
        .$this->table . ' p
        LEFT JOIN
            categories c ON p.category_id = c.id
            ORDERED BY p.created_ay DESC';
        
        $stmt = $this->comn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
};

?>