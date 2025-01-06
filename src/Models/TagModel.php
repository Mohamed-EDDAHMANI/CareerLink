<?php 

namespace App\Models;
use App\Classes\Tag;
use App\Config\Database;



class TagModel{
    
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function insertTag($tag)
    {
        $isExist = $this->searchTagExist($tag);
        if ($isExist instanceof Tag) {
            return false;
        } else {
            if ($tag->getId()) {
                $id = $tag->getId();
                $tag_name = $tag->getTagName();
                $query = "UPDATE tags SET tag_name = :tag_name WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':tag_name', $tag_name);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            }
            $tag_name = $tag->getTagName();
            $query = "INSERT INTO tags (tag_name) VALUES (:tag_name)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':tag_name', $tag_name);
            return $stmt->execute();
        }

    }

    public function searchTagExist($tag)
    {
        $tag_name = $tag->getTagName();
        $query = "SELECT * FROM tags 
        WHERE tag_name = :tag_name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return new Tag($result['id'], $result['tag_name']);
        } else {
            return false;
        }
    }

    public function getAllTags()
    {
        $query = "SELECT * FROM tags";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function dropTag($tag_id)
    {
        $query = "DELETE FROM tags WHERE id = :tag_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tag_id', $tag_id);
        return $stmt->execute();
    }

}
?>