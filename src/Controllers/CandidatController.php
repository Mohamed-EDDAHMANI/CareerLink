<?php 

namespace App\Controllers;

use App\Models\CandidatModel;

class CandidatController{

    private CandidatModel $candidatModel;

    public function __construct()
    {
        $this->candidatModel = new CandidatModel();
    }

    public function applyToOffre($offreId, $candidatId)
    {
        $result = $this->candidatModel->insertToCandidatOffre($offreId, $candidatId);
        if($result){
            $_SESSION['seccess']['message'] =  "Applied to offre successfully";
            return true;
        }else{
            $_SESSION['error']['message'] =  "Failed to apply to offre";
            return false;
        }
        
    }

    public function getNumOfOffres($candidatId)
    {
        $result = $this->candidatModel->getNumOfOffresFromDB($candidatId);
        if ($result) {
            return $result;
        }
    }

}






?>