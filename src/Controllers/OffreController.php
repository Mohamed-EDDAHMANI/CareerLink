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

    // public function getOffre($id)
    // {
    //     $offre = $this->offreModel->getOffreById($id);
    //     return $offre;
    // }

    // public function updateOffre($id, $post, $description, $salary, $qualification, $location, $recruiter_id, $category_id)
    // {
    //     $offre = new Offre($id, $post, $description, $salary, $qualification, $location, $recruiter_id, $category_id);
    //     $result = $this->offreModel->updateOffre($offre);
    //     if ($result) {
    //         header("Location: ../../View/offre/index.php");
    //         exit();
    //     } else {
    //         $_SESSION['error']['message'] = 'Invalid email or password';
    //         header("Location: ../../View/offre/edit.php");
    //         exit();
    //     }
    // }

    // public function deleteOffre($id)
    // {
    //     $result = $this->offreModel->deleteOffre($id);
    //     if ($result) {
    //         header("Location: ../../View/offre/index.php");
    //         exit();
    //     } else {
    //         $_SESSION['error']['message'] = 'Invalid email or password';
    //         header("Location: ../../View/offre/index.php");
    //         exit();
    //     }
    // }

}
?>