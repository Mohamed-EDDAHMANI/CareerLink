<?php
session_start();

require '../../../vendor/autoload.php';

use App\Controllers\auth\Auth;
use App\Config\Database;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Call the Auth class
    $db = new Database();
    $conn = $db->connect();
    $auth = new Auth($conn);

    switch ($role) {
        case 'Administrateur':
            $auth->signup($name, $email, $password, $role);
            break;

        case 'Candidat':
            $skills = $_POST['skills'];
            $deplome = $_POST['deplome'];
            $auth->signup($name, $email, $password, $role, $conn, $skills, $deplome);
            break;

        case 'Recruteur':
            $companyName = $_POST['companyName'];
            $auth->signup($name, $email, $password, $role, $conn, $companyName);

            break;

        default:
            # code...
            break;
    }


}
?>