<?php
session_start();
require_once '../../Classes/User.php';
require_once '../../Config/Database.php';
require_once 'Auth.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get the email and password from the form
// $email = $_POST['email'];
// $password = $_POST['password'];
$email = 'mark@gmail.com';
$password = 'mark';

// Call the login method
$db = new Database();
$conn = $db->connect();
$auth = new Auth( $conn);
$auth->login($email, $password);

?>