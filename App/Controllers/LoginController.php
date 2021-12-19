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
            if($this->usernameEmailExists($username, $email) !== false){
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
        if(!preg_match(("/^[a-zA-Z0-9]*$/"), $username)){
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


    public function usernameEmailExists($username, $email)
    {
        $result = false;
        $allUsers = User::getAll();
        foreach ($allUsers['users'] as $user){
            if(($user->getUsername() === $username) || ($user->getEmail() === $email)){
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
}