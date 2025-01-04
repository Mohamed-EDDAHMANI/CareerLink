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
                    $dataArray = array_slice($additionalData, 1);  // Remove the first element (PDO connection)
                    if (isset($dataArray[0]) && isset($dataArray[1])) {
                        $skills = $dataArray[0];
                        $diplome = $dataArray[1];
                        $query = "INSERT INTO candidats (skills, deplome, user_id)
                              VALUES (:skills, :deplome, :user_id)";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':skills', $skills);
                        $stmt->bindParam(':deplome', $diplome);
                        $stmt->bindParam(':user_id', $userID);
                    }
                    break;

                case 'Recruteur':
                    $dataArray = array_slice($additionalData, 1);  // Remove the first element (PDO connection)
                    if (isset($dataArray[0])) {
                        $companyName = $dataArray[0];
                        $query = "INSERT INTO recruteurs (company_name, user_id)
                              VALUES (:company_name, :user_id)";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':company_name', $companyName);
                        $stmt->bindParam(':user_id', $userID);
                    }
                    break;

                default:
                    echo 'Role is not exist';
                    break;
            }
            //i have to hundel the return of $newUser
            return $stmt->execute() ? $newUser : false;
        } else {
            return false;
        }
    }


}
?>