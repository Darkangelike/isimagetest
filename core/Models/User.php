<?php

namespace Models;

class User extends AbstractModel implements \JsonSerializable
{
    protected string $tableName = "users";
    private string $username;
    private string $email;
    private string $password;
    private string $display_name;

    // getter ID
    public function getId(): int
    {
        return $this->id;
    }

    // gs $username
    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username):void
    {
        $this->username = $username;
    }

    // gs $email
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    // gs $password
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    // gs $display_name
    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function setDisplayname(string $display_name): void
    {
        $this->display_name = $display_name;
    }

    // METHODS

    /**
     * Insert a new user into the database
     * 
     * @param User $user
     * 
     * @return void
     */
    public function register(User $user): void
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (username, password, email, display_name)
        VALUES (:username, :password, :email, :display_name)");

        $sql->execute([
            "username" => $user->username,
            "email" => $user->email,
            "password" => $user->password,
            "display_name" => $user->display_name
        ]);
    }

    /**
     *
     * Finds and returns a user object from the database
     * Using its associated string $username property
     * If the User $user->username is not found
     * Returns false boolean
     *
     * @param string $username
     * @return User | boolean
     *
     *
     */
    public function findByUsername(string $username): User | bool
    {

        $sql = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE username = :username");

        $sql->execute([
            "username" => $username
        ]);
        $sql->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        $element = $sql->fetch();
        return $element;
    }

    /**
     *
     * checks for a matching username in the database
     * also checks if the password in argument is associated with that username
     *
     * Returns a boolean
     *
     * @param string $username
     * @param string $password
     * @return bool
     *
     */
    public static function login(string $username, string $password):bool
    {
        $result = false;

        $user = new \Models\User();

        if ($user = $user->findByUsername($username))
        {
            ;

            if (password_verify($password, $user->password))
            {
                $_SESSION["user"] = [
                    "id" => $user->id,
                    "username" => $user->username,
                    "password" => $user->password,
                    "display_name" => $user->display_name,
                    "email" => $user->email
                ];

                $result = true;
            }
        };

        return $result;

    }

    /**
     *
     * logs out the current user from the running session
     *
     * @return void
     */
    public function logOut(): void
    {
        session_unset();
    }

    public static function getUser()
    {
        if (!isset($_SESSION["user"])){
           return false;
        } else {
            $modelUser = new \Models\User();
           return $modelUser->findById($_SESSION["user"]["id"]);
        }
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "displayName" => $this->getDisplayName()
        ];
    }
}