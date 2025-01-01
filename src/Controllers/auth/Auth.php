<?php 


class Auth {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($email, $password) {
        $user = User::login($email, $password, $this->conn);
        
        if ($user) {
            $this->createUserSession($user);
            $this->redirectEffect($user);
        }
        
        return false;
    }

    public function signup($name, $email, $password, $role, ...$additionalData) {
        try {
            $user = User::singUp($name, $email, $password, $role, $this->conn, ...$additionalData);
            
            if ($user && isset($user)) {
                $this->createUserSession($user);
                $this->redirectEffect($user);
                return true;
            }

        } catch (Exception $e) {
            return  'Registration error: ' . $e->getMessage();
        }
    }

    public function redirectEffect($user) {
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
                break;
        }
        exit;
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            session_destroy();
            return [
                'success' => true,
                'message' => 'Logout successful'
            ];
        }
        return [
            'success' => false,
            'message' => 'No active session found'
        ];
    }

    private function createUserSession($user) {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
    }

    public function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    public function getCurrentUser() {
        return $_SESSION['user'] ?? null;
    }
}