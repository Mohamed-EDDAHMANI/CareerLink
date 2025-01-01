<?php
session_start();
require_once '../../Classes/User.php';
require_once '../../Config/Database.php';


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get the email and password from the form
// $email = $_POST['email'];
// $password = $_POST['password'];
// $role = $_POST['role'];
$name = 'hamzat';
$email = 'hamzat3@gmail.com';
$password = 'hamzat';
$role = 'Administrateur';

// Call the login method
$db = new Database();
$conn = $db->connect();
switch ($role) {
    case 'Administrateur':
        $isLoggedIn = User::singUp($name, $email, $password, $role, $conn);
        if ($isLoggedIn) {
            echo 'seccessfely';
            // header("Location: admin_dashboard.php");
        } else {
            echo 'Error create';
            // header("Location: admin_dashboard.php");
        }
        break;

    case 'Candidat':
        // $skills = $_POST['skills'];
        // $deplome = $_POST['deplome'];
        $skills = 'devWeb info it';
        $deplome = 'master';
        $isLoggedIn = User::singUp($name, $email, $password, $role, $conn, $skills, $deplome);
        if ($isLoggedIn) {
            echo 'seccessfely';
            // header("Location: admin_dashboard.php");
        } else {
            echo 'Error create';
            // header("Location: admin_dashboard.php");
        }

        break;
    case 'Recruteur':
        // $companyName = $_POST['companyName'];
        $companyName = 'simplon';
        $isLoggedIn = User::singUp($name, $email, $password, $role, $conn, $companyName);
        if ($isLoggedIn) {
            echo 'seccessfely';
            // header("Location: admin_dashboard.php");
        } else {
            echo 'Error create';
            // header("Location: admin_dashboard.php");
        }
        break;

    default:
        # code...
        break;
}
echo var_dump($isLoggedIn);
if (isset($isLoggedIn[0])) {
    unset($_SESSION['user']);
    $user = $isLoggedIn[0];
    $_SESSION['user'] = [
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role']
    ];
}

// }
?>