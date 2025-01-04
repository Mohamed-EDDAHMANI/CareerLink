<?php 

namespace App\Controllers;
use App\Classes\Categorie;
use App\Models\CategorieModel;

class CategorieController{
    
    private CategorieModel $categorieModel;

    public function __construct()   {
       $this->categorieModel = new CategorieModel();
    }

    public function createCategorie($category_name, $category_id){
        if($category_id){
            $categorie = new Categorie($category_id ,$category_name);
        }else{
            $categorie = new Categorie(null ,$category_name);
        }

        $resultInsert = $this->categorieModel->insertCategorie($categorie);
        if($resultInsert){
            $_SESSION['success']['message'] = $category_name .' Category created successfully';
        }else{
            $_SESSION['error']['message'] = $category_name .' Category already exist';
            // $_SESSION['error']['effect'] = '<script>
            // function showModal(modalId) {
            //     document.getElementById(modalId).classList.remove(\'hidden\');
            // };
            // </script>';
            header("Location: ../../View/admin/dashboard.php");
            exit();
        }
    }

    public function getCatigories(){
        return $this->categorieModel->getAllCategories();
    }
    public function getCategoryById($category_id){
        return $this->categorieModel->getCategoryByIdForUpdate($category_id);
    }
}




?>