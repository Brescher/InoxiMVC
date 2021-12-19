<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\Responses\Response;
use App\Models\User;

class LoginController extends AControllerRedirect
{

    public function index()
    {
        return $this->html();
    }

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
                $this->redirect("login", "error", "emptyinput");
                exit();
            }
            if($this->invalidEmail($email) !== false){
                $this->redirect("login", "error", "invalidEmail");
                exit();
            }
            if($this->invalidUsername($username) !== false){
                $this->redirect("login", "error", "invalidUsername");
                exit();
            }
            if($this->passwordMatch($password, $passwordRepeat) !== false){
                $this->redirect("login", "error", "passworddontmatch");
                exit();
            }
            if($this->usernameExists($username) !== false){
                $this->redirect("login", "error", "usernameExists");
                exit();
            }

            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setUsername($username);
            $newUser->setPassword($password);
            $newUser->save();
            $this->redirect("home", "index");
        } else {
            $this->redirect("login", "register");
            exit();
        }
    }

    public function loginUser(){

    }

    public function emptyInputSignup()
    {
        return false;
    }
    public function invalidEmail()
    {
        return false;
    }
    public function invalidUsername()
    {
        return false;
    }
    public function passwordMatch()
    {
        return false;
    }
    public function usernameExists()
    {
        return false;
    }
}