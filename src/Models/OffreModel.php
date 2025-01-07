<?php

namespace App\Models;

use App\Config\Database;
use App\Classes\Offre;

class OffreModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function createNewOffre($offre)
    {
        try {
            $post = $offre->getPost();
            $description = $offre->getDescription();
            $salary = $offre->getSalary();
            $qualification = $offre->getQualification();
            $location = $offre->getLocation();
            $recruteur_id = $offre->getRecruiterId();
            $category_id = $offre->getCategoryId();
            $query = "INSERT INTO offres (post , description , salary , qualification, location, recruteur_id, category_id)
        VALUES (:post, :description, :salary, :qualification, :location, :recruteur_id, :category_id)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':post', $post);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':salary', $salary);
            $stmt->bindParam(':qualification', $qualification);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':recruteur_id', $recruteur_id);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->execute();
            $offreID = $this->conn->lastInsertId();
            if ($offreID) {
                $query = "SELECT * FROM offres
                where id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $offreID);
                $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return new Offre($row['id'], $row['post'], $row['description'], $row['salary'], $row['qualification'], $row['location'], $row['recruteur_id'], $row['category_id']);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return 'Registration error: ' . $e->getMessage();
        }
    }

    public function insertTagsToOffre($id_Offre, $selectedTags)
    {
        try {
            foreach ($selectedTags as $tag) {
                $query = "INSERT INTO offres_tags (offre_id , tag_id)
                VALUES (:offre_id, :tag_id)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':offre_id', $id_Offre);
                $stmt->bindParam(':tag_id', $tag);
                $stmt->execute();
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getAllOffres()
    {
        $query = "SELECT offres.id, post, description, salary, qualification, location, category_name, categories.id as categoryId, categories.category_name,   GROUP_CONCAT(tags.tag_name) as tags, GROUP_CONCAT(tags.id) as tagID FROM offres
        INNER JOIN categories ON categories.id = offres.category_id
        INNER JOIN offres_tags ON offres.id = offres_tags.offre_id
        INNER JOIN tags ON offres_tags.tag_id = tags.id
        GROUP BY offres.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  
    }

}
?>