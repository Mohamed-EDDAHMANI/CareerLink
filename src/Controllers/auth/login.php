<?php
session_start();
require_once '../../Classes/User.php';
require_once '../../Config/Database.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get the email and password from the form
// $email = $_POST['email'];
// $password = $_POST['password'];
$email = 'mark@gmail.com';
$password = 'mark';

// Call the login method
$db = new Database();
$conn = $db->connect();
$isLoggedIn = User::login($email, $password, $conn);

if ($isLoggedIn) {
    $_SESSION['user'] = [
        'nom' => $isLoggedIn['nom'],
        'email' => $isLoggedIn['email'],
        'role' => $isLoggedIn['role']
    ];
    $role = $isLoggedIn["role"];
    // Fetch the user details to determine the role
    switch ($user['role']) {
        case 'Administrateur':
            header("Location: admin_dashboard.php");
            break;
        case 'Candidat':
            header("Location: user_dashboard.php");
            break;
        case 'Recruteur':
            header("Location: user_dashboard.php");
            break;
        default:
            header("Location: login.php?error=Unknown role");
    }
    exit;
} else {
    header("Location: login.php?error=Invalid credentials");
    exit;
}
// }
?>