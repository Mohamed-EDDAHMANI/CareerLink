<?php

namespace App\Controllers\auth;
use App\Classes\User;
use App\Models\UserModel;



class Auth
{

    public function login($email, $password){
        $user = new User('',$email, $password);
        $userModel = new UserModel();
        $userFound = $userModel->findUserByEmailAndPassword($user);
        
        // print_r($userFound->getEmail());
        if ($userFound == null) {
           //handle user not found
        }else{
            $this->createUserSession($userFound);
            $this->redirectEffect($userFound);
        }
        return false;
    }

    public function signup($name, $email, $password, $role, ...$additionalData)
    {
        try {
            //create user table
            $user = new User($name, $email, $password, $role);
            $userModel = new UserModel();
            $newUser = $userModel->createNewUser($user, ...$additionalData);

            if ($newUser instanceof User) {
                $this->createUserSession($newUser);
                $this->redirectEffect($newUser);
                return true;
            }
            return false;

        } catch (\Exception $e) {
            return 'Registration error: ' . $e->getMessage();
        }
    }

    public function redirectEffect($user)
    {
        switch ($user->getRole()) {
            case 'Administrateur':
                // echo 'seccess';
                header("Location: ../../View/admin/dashboard.php");
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
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ];
    }

}