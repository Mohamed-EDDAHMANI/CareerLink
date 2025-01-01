<?php 

class Candidat extends User {

    private $skills ;
    private $deplome ;
    private $userId ;

    public function __construct($skills, $deplome, $userId) {
        $this->skills = $skills;
        $this->deplome = $deplome;
        $this->userId = $userId;
    }

    
}



?>