<?php 

namespace App\Classes;

class Offre {
    private $id;
    private $post;
    private $description;
    private $salary;
    private $qualification;
    private $location;
    private $recruiter_id;
    private $category_id;


    public function __construct($id, $post, $description, $salary, $qualification, $location, $recruiter_id, $category_id) {
        $this->id = $id;
        $this->post = $post;
        $this->description = $description;
        $this->salary = $salary;
        $this->qualification = $qualification;
        $this->location = $location;
        $this->recruiter_id = $recruiter_id;
        $this->category_id = $category_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getPost() {
        return $this->post;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function getQualification() {
        return $this->qualification;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getRecruiterId() {
        return $this->recruiter_id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    

    public function setId($id) {
        $this->id = $id;
    }

    public function setPost($post) {
        $this->post = $post;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function setQualification($qualification) {
        $this->qualification = $qualification;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function setRecruiterId($recruiter_id) {
        $this->recruiter_id = $recruiter_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }
}




?>