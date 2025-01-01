<?php
session_start();
require_once '../../Classes/User.php';
require_once '../../Config/Database.php';
require_once 'Auth.php';


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get the email and password from the form
// $email = $_POST['email'];
// $password = $_POST['password'];
// $role = $_POST['role'];
$name = 'ossama';
$email = 'ossama11@gmail.com';
$password = 'ossama';
$role = 'Candidat';

// Call the Auth class
$db = new Database();
$conn = $db->connect();
$auth = new Auth( $conn);

switch ($role) {
    case 'Administrateur':
        $auth->signup($name, $email, $password, $role);
        break;

    case 'Candidat':
        // $skills = $_POST['skills'];
        // $deplome = $_POST['deplome'];
        $skills = 'devWeb info it';
        $deplome = 'master';
        $auth->signup($name, $email, $password, $role, $conn, $skills, $deplome);
        break;

    case 'Recruteur':
        // $companyName = $_POST['companyName'];
        $companyName = 'simplon';
        $auth->signup($name, $email, $password, $role, $conn, $companyName);

        break;

    default:
        # code...
        break;
}


// }
?>