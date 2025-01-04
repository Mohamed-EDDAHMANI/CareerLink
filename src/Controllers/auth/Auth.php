<?php

namespace App\Controllers\auth;
use App\Classes\User;
use App\Models\UserModel;



class Auth
{

    private UserModel $userModel;

    public function __construct()   {
       $this->userModel = new UserModel();
    }

    public function login($email, $password){

        $user = new User('',$email, $password);
        $userFound = $this->userModel->findUserByEmailAndPassword($user);
        
        if ($userFound instanceof User) {
            $this->createUserSession($userFound);
            $this->redirectEffect($userFound);
        }else{
            $_SESSION['error']['message'] = 'Invalid email or password';
            header("Location: ../../View/auth/login.php");
            exit();
        }
    }

    public function signup($name, $email, $password, $role, ...$additionalData)
    {
        try {
            //create user table
            $user = new User($name, $email, $password, $role);
            $newUser = $this->userModel->createNewUser($user, ...$additionalData);

            if ($newUser instanceof User) {
                $this->createUserSession($newUser);
                $this->redirectEffect($newUser);
                return true;
            }else{
                $_SESSION['error']['message'] = 'Invalid email or password';
                header("Location: ../../View/auth/login.php");
                exit();
            }

        } catch (\Exception $e) {
            return 'Registration error: ' . $e->getMessage();
        }
    }

    public function redirectEffect($user)
    {
        switch ($user->getRole()) {
            case 'Administrateur':
                header("Location: ../../View/admin/dashboard.php");
                break;
            case 'Candidat':
                header("Location: ../../View/candidate/home.php");
                break;
                case 'Recruteur':
                    echo 'seccess creating Recruteur';
                    header("Location: ../../View/recruteur/home.php");
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
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ];
    }

}