<?php

namespace App\Controllers\auth;
use App\Classes\User;

class Auth
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($email, $password)
    {
        $user = User::login($email, $password, $this->conn);

        if ($user) {
            $this->createUserSession($user);
            $this->redirectEffect($user);
        }

        return false;
    }

    public function signup($name, $email, $password, $role, ...$additionalData)
    {
        try {
            $user = User::singUp($name, $email, $password, $role, $this->conn, ...$additionalData);
            var_dump($user);

            if ($user && isset($user)) {
                $this->createUserSession($user);
                $this->redirectEffect($user);
                return true;
            }
            return false;

        } catch (\Exception $e) {
            return 'Registration error: ' . $e->getMessage();
        }
    }

    public function redirectEffect($user)
    {
        switch ($user['role']) {
            case 'Administrateur':
                echo 'seccess';
                // header("Location: admin_dashboard.php");
                break;
            case 'Candidat':
                echo 'seccess creating Candidat';
                // header("Location: user_dashboard.php");
                break;
            case 'Recruteur':
                echo 'seccess creating Recruteur';
                // header("Location: user_dashboard.php");
                break;
            default:
                echo 'seccess';
                // header("Location: login.php?error=Unknown role");
                break;
        }
        exit;
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            session_destroy();
            return true;
        }
        return false;
    }

    private function createUserSession($user)
    {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
    }

}