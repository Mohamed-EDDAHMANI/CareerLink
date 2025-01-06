<?php

namespace App\Models;
use App\Config\Database;
use App\Classes\User;

class UserModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function findUserByEmailAndPassword($user)
    {
        $email = $user->getEmail();
        $passwprd = $user->getPassword();
        $query = "SELECT * FROM users
        where email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwprd);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['name'], $row['email'], $row['password'], $row['role']);
        } else {
            return false;
        }
    }

    public function createNewUser($user, ...$additionalData)
    {
        try {
            $name = $user->getName();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $role = $user->getRole();
            $query = "INSERT INTO users (name , email , password , role)
        VALUES (:name, :email, :password, :role)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            $userID = $this->conn->lastInsertId();
            if ($userID) {
                $query = "SELECT * FROM users
                where id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $userID);
                $stmt->execute();
                $result = $stmt->fetch(\PDO::FETCH_ASSOC);
                $newUser = new User($result['name'], $result['email'], $result['password'], $result['role']);
            }
        } catch (\Throwable $e) {
            return 'Registration error: ' . $e->getMessage();
        }



        if ($newUser) {
            switch ($newUser->getRole()) {
                case 'Administrateur':
                    $query = "INSERT INTO admins (user_id)
                              VALUES (:user_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':user_id', $userID);
                    break;

                case 'Candidat':
                        $skills = $additionalData[0];
                        $diplome = $additionalData[1];
                        $query = "INSERT INTO candidats (skills, deplome, user_id)
                              VALUES (:skills, :deplome, :user_id)";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':skills', $skills);
                        $stmt->bindParam(':deplome', $diplome);
                        $stmt->bindParam(':user_id', $userID);
                    
                    break;

                case 'Recruteur':
                        $companyName = $additionalData[0];
                        $query = "INSERT INTO recruteurs (company_name, user_id)
                              VALUES (:company_name, :user_id)";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':company_name', $companyName);
                        $stmt->bindParam(':user_id', $userID);
                    break;

                default:
                    echo 'Role is not exist';
                    break;
            }
            //i have to hundel the return of $newUser
            if ($stmt->execute()) {
                // Get the last inserted ID
                $lastInsertId = $this->conn->lastInsertId();
        
                // Return the new user instance and the last inserted ID
                return [
                    'user' => $newUser,
                    'id' => $lastInsertId,
                ];
            }else{
                return false;
            }
        } else {
            return false;
        }
    }


}
?>