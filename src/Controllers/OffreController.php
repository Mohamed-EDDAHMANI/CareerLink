<?php

namespace App\Controllers;
use App\Classes\Offre;
use App\Models\OffreModel;


class OffreController
{

    private OffreModel $offreModel;

    public function __construct()
    {
        $this->offreModel = new OffreModel();
    }

    public function createOffre($offre, $selectedTags)
    {
        try {
            $createOffreResult = $this->offreModel->createNewOffre($offre);
            $offre_id = $createOffreResult->getId();
            $insertTagsResult = $this->offreModel->insertTagsToOffre($offre_id, $selectedTags);
            if ($createOffreResult instanceof Offre && $insertTagsResult) {
                $_SESSION['success']['message'] = 'Succesecfully created Offre';
                header("Location: ../../View/recruteur/createOffre.php");
                exit();
            } else {
                $_SESSION['error']['message'] = 'Invalid Offre informations';
                header("Location: ../../View/recruteur/createOffre.php");
                exit();
            }
        } catch (\Throwable $th) {
            return false;
        }

    }

    public function getOffres()
    {
        $offres = $this->offreModel->getAllOffres();
        return $offres;
    }

    public function getOffresById($recruteurId)
    {
        $offres = $this->offreModel->getAllOffresByRecruteurId($recruteurId);
        return $offres;
    }

    public function getOffreById($offreId)
    {
        $offre = $this->offreModel->getOffreById($offreId);
        return $offre;
    }


    public function updateOffre($offre, $tags_ids)
    {
        $resultUpdateOffre = $this->offreModel->updateOffreFromDatabase($offre);
        if ($resultUpdateOffre) {
            $offre_id = $offre->getId();
            $resultUpdateTags = $this->offreModel->updateOffreTags($tags_ids, $offre_id);
        }
        if ($resultUpdateTags) {
            $_SESSION['success']['message'] = 'Updated Offre seccesfully';
            header("Location: ../../View/recruteur/dashboard.php");
            exit();
        } else {
            $_SESSION['error']['message'] = 'Invalid inputs';
            header("Location: ../../View/recruteur/updateOffre.php");
            exit();
        }
    }

    public function deleteOffre($id)
    {
        $result = $this->offreModel->deleteOffreFromDatabase($id);
        if ($result) {
            $_SESSION['success']['message'] = 'Delete Offre seccesfully';
            header("Location: ../../View/recruteur/dashboard.php");
            exit();
        } else {
            $_SESSION['error']['message'] = 'Somthing wrong';
            header("Location: ../../View/recruteur/dashboard.php");
            exit();
        }
    }

}
?>