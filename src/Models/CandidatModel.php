<?php

namespace App\Models;
use App\Config\Database;
use \DateTime;


class CandidatModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function insertToCandidatOffre($offreId, $candidatId)
    {
        try {
            date_default_timezone_set('Africa/Casablanca');
            $currentDate = date('Y-m-d'); 
            $query = "INSERT INTO candidats_offres (offre_id, `date`, candidat_id)
            VALUES (:offre_id, :date, :candidat_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':offre_id', $offreId);
            $stmt->bindParam(':date', $currentDate);
            $stmt->bindParam(':candidat_id', $candidatId);
            return $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }

    }

    public function getNumOfOffresFromDB($candidatId)
    {
        try {
            $query = "SELECT COUNT(*) as num FROM candidats_offres WHERE candidat_id = :candidat_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':candidat_id', $candidatId);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['num'];
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
?>