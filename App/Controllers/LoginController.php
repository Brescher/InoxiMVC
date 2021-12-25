<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\Responses\Response;
use App\Models\User;

class LoginController extends AControllerRedirect
{

    public function index()
    {
        $this->redirect("home");
    }
    //$error
    public function register()
    {
        return $this->html();
    }

    public function login()
    {
        return $this->html();
    }

    public function registerUser(){
        if(isset($_POST["register"])){
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["passwordrepeat"];


            if($this->emptyInputSignup($email, $username, $password, $passwordRepeat) !== false){
                $error = "Prazdne pole.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->invalidEmail($email) !== false){
                $error = "Treba zadať email.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->invalidUsername($username) !== false){
                $error = "Zlé poúživateľské meno, dovolené znaky sú A-Z, a-z, 0-9.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->passwordMatch($password, $passwordRepeat) !== false){
                $error = "Heslá sa nezhodujú";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->usernameExists($username) !== false){
                $error = "Dané poúživateľské meno už existuje.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->emailExists($email) !== false){
                $error = "Daný email už existuje.";
                $this->redirect("login", "register", [$error]);
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setUsername($username);
            $newUser->setPassword($hashedPassword);
            $newUser->save();
            $this->redirect("login", "login");
        } else {
            $this->redirect("login", "register");
            exit();
        }
    }

    public function loginUser(){
        if(isset($_POST["login"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            if($this->emptyInputLogin($username, $password) !== false){
                $error = "Prazdne pole.";
                $this->redirect("login", "login", [$error]);
                exit();
            }

            $allUsers = User::getAll();

            foreach ($allUsers as $user){
                if(($user->getUsername() === $username) || ($user->getEmail() === $username)){
                    $pwdHashed = $user->getPassword();
                    $checkPwd = password_verify($password, $pwdHashed);
                    if ($checkPwd === false) {
                        $this->redirect("login", "login", "error");
                        exit();
                    } else if ($checkPwd === true) {
                        session_start();
                        $_SESSION["userid"] = $user->getUserId();
                        $_SESSION["username"] = $user->getUsername();
                        $this->redirect("home", "index");
                        exit();
                    }
                } else {
                    $result = true;
                }
            }
            if($result !== false) {
                $this->redirect("login", "login", "error");
                exit();
            }
        } else {
            $this->redirect("login", "login");
            exit();
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $this->redirect("home", "index");
    }

    public function emptyInputSignup($email, $username, $password, $passwordRepeat)
    {
        if(empty($email) || empty($username) || empty($password) || empty($passwordRepeat)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function invalidEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function invalidUsername($username)
    {
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function passwordMatch($password, $passwordRepeat)
    {
        if($password !== $passwordRepeat){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function usernamelExists($username)
    {
        $result = false;
        $allUsers = User::getAll();

        foreach ($allUsers as $user){
            if(($user->getUsername() === $username)){
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }

    public function emailExists($email)
    {
        $result = false;
        $allUsers = User::getAll();

        foreach ($allUsers as $user){
            if(($user->getEmail() === $email)){
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }

    public function emptyInputLogin($username, $password)
    {
        if(empty($username) || empty($password)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}