<?php

namespace Controllers;

class User extends AbstractController
{
    protected $defaultModelName = \Models\User::class;

    /**
     * Displays a form for people to fill in their credentials
     * if datas are correct, the user will be inserted in the database
     * if datas are incorrect, the user will be redirected to the form again
     */
    public function signup()
    {
        $username = null;
        $email = null;
        $password = null;
        $display_name = null;

        if (!empty($_POST["username"]))
        {
            $username = htmlspecialchars($_POST["username"]);
        }

        if (!empty($_POST["email"]))
        {
            $email = htmlspecialchars($_POST["email"]);
        }

        if (!empty($_POST["password"]))
        {
            $password = htmlspecialchars($_POST["password"]);
        }

        if (!empty($_POST["displayName"]))

        {
            $display_name = htmlspecialchars($_POST["displayName"]);
        }

        if ($username && $email && $password && $display_name)
        {
            
            $user = new \Models\User();

            if ($user->findByUsername($username))
            {
                $this->redirect([
                    "type" => "user",
                    "action" => "signup",
                    "info" => "This user already exists. Please choose another username."
                ]);
            }

            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setDisplayName($display_name);
            
            $user = $user->register($user);
            echo "User creation successful";
        }
                
        $this->render("users/create", [
            "pageTitle" => "Create a user account"
        ]);
    }

    public function signin()
    {
        $username = null;
        $password = null;

        if (!empty($_POST["username"]))
        {
            $username = htmlspecialchars($_POST["username"]);
        }

        if (!empty($_POST["password"])) {
            $password = htmlspecialchars($_POST["password"]);
        }

        if ($password && $username)
        {
            $user = $this->defaultModel->findByUsername($username);

            if (!$user)
            {
                $this->redirect([
                    "type" => "user",
                    "action" => "signin"
                ]);
            }

            $isConnected = \Models\User::login($username, $password);

            if (!$isConnected)
            {
                $this->redirect([
                    "type" => "user",
                    "action" => "login",
                    "info" => "Wrong password"
                ]);
            }

        }

        $this->render("users/login", [
            "pageTitle" => "Sign in"
        ]);
    }

    /**
     * Logs out the current user session
     *
     * @return void
     */
    public function logout(): void
    {
        unset($_SESSION["user"]);
        $this->redirect([
            "type" => "velo",
            "action" => "index"
        ]);
    }
}