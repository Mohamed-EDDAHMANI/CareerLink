<?php
session_start();

require '../../../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\auth\Auth;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the login method

    $db = new Database();
    $conn = $db->connect();
    $auth = new Auth($conn);
    $auth->login($email, $password);
}
?>