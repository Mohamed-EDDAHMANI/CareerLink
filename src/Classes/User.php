<?php


class User
{
    protected $name;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($name, $email, $password, $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public static function login($email, $password, $conn)
    {
        $query = "SELECT * FROM users
        where email = :email AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public static function singUp($name, $email, $password, $role, $conn, ...$data)
    {
        $query = "INSERT INTO users (name , email , password , role)
        VALUES (:name, :email, :password, :role)";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $userID = $conn->lastInsertId();
        $query = "SELECT * FROM users
        where id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $userID);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($user) {
            switch ($role) {
                case 'Administrateur':
                    $query = "INSERT INTO admins (user_id)
                              VALUES (:user_id)";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':user_id', $userID);
                    $stmt->execute();
                    break;

                case 'Candidat':
                    if (isset($data[0]) && isset($data[1])) {
                        $skills = $data[0];
                        $diplome = $data[1];
                        $query = "INSERT INTO admins (skills, deplome, user_id)
                              VALUES (:skills, :deplome, :user_id)";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':skills', $skills);
                        $stmt->bindParam(':deplome', $diplome);
                        $stmt->bindParam(':user_id', $userID);
                        $stmt->execute();
                    }
                    break;

                case 'Recruteur':
                    if (isset($data[0])) {
                        $companyName = $data[0];
                        $query = "INSERT INTO admins (skills, deplome, user_id)
                              VALUES (:skills, :deplome, :user_id)";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':company_name', $companyName);
                        $stmt->bindParam(':user_id', $userID);
                        $stmt->execute();
                    }
                    break;

                default:
                    echo 'Role is not exist';
                    break;
            }
            return $stmt->execute() ? $user : false;
        } else {
            return false;
        }
    }


}
?>