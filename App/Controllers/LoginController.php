<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\Responses\Response;
use App\Models\Upost;
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

    public function users()
    {
        $users = User::getAll();

        return $this->html(
            [
                'users' => $users
            ]
        );
    }

    public function registerUser(){
        if(isset($_POST["register"])){
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["passwordrepeat"];
            $error = "";


            if($this->emptyInputSignup($email, $username, $password, $passwordRepeat) !== false){
                $error = "Musíte vyplniť všetky polia.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->invalidEmail($email) !== false){
                $error = "Neplatná emailová adresa.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->invalidUsername($username) !== false){
                $error = "Zlé poúživateľské meno, dovolené znaky sú: A-Z, a-z, 0-9.";
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
            if($this->checkNameLength($username) !== false){
                $error = "Používateľské meno musí byť dlhšie ako 5 znakov a kratšie ako 13 znakov.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->checkPasswdLength($password) !== false){
                $error = "Heslo musí byť dlhšie ako 8 znakov a kratšie ako 20 znakov.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->checkPasswdStrength($password) !== false){
                $error = "Heslo musí obsahovať aspoň jedno veľké písmeno, jedno malé písmeno a jednu číslicu.";
                $this->redirect("login", "register", [$error]);
                exit();
            }
            if($this->passwordMatch($password, $passwordRepeat) !== false){
                $error = "Heslá sa nezhodujú";
                $this->redirect("login", "register", [$error]);
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setUsername($username);
            $newUser->setPassword($hashedPassword);
            $newUser->setUserType("user");
            $newUser->save();
            $this->redirect("login", "login", [$error]);
        } else {
            $error = "Prosím, registrujte sa normálnym spôsobom.";
            $this->redirect("login", "register", [$error]);
            exit();
        }
    }

    public function loginUser(){
        if(isset($_POST["login"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            if($this->emptyInputLogin($username, $password) !== false){
                $error = "Vyplnte všetky polia.";
                $this->redirect("login", "login", [$error]);
                exit();
            }

            $allUsers = User::getAll();

            foreach ($allUsers as $user){
                if(($user->getUsername() === $username) || ($user->getEmail() === $username)){
                    $pwdHashed = $user->getPassword();
                    $checkPwd = password_verify($password, $pwdHashed);
                    if ($checkPwd === false) {
                        $error = "Zlé heslo.";
                        $this->redirect("login", "login", [$error]);
                        exit();
                    } else if ($checkPwd === true) {
                        session_start();
                        $_SESSION["userid"] = $user->getId();
                        $_SESSION["username"] = $user->getUsername();
                        $_SESSION["usertype"] = $user->getUserType();
                        $this->redirect("home", "index");
                        exit();
                    }
                } else {
                    $result = true;
                }
            }
            if($result !== false) {
                $error = "Daný užívateľ neexistuje.";
                $this->redirect("login", "login", [$error]);
                exit();
            }
        } else {
            $error = "Prosím, prihláste sa normálnym spôsobom.";
            $this->redirect("login", "login", [$error]);
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

    public function addAdmin()
    {
        $userid = $this->request()->getValue('userid');
        if($userid > 0){
            $oldUser = User::getOne($userid);
            $username = $oldUser->getUsername();
            $email = $oldUser->getEmail();
            $password = $oldUser->getPassword();

            $user = new User();
            $user->setId($userid);
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setUserType("admin");
            $user->save();
            $this->redirect("login", "users");
        }
    }

    public function removeAdmin()
    {
        $userid = $this->request()->getValue('userid');
        if($userid > 0){
            $oldUser = User::getOne($userid);
            $username = $oldUser->getUsername();
            $email = $oldUser->getEmail();
            $password = $oldUser->getPassword();

            $user = new User();
            $user->setId($userid);
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setUserType("user");
            $user->save();
            $this->redirect("login", "users");
        }
    }

    public function deleteUser()
    {
        $userId = $this->request()->getValue('userid');
        if($userId > 0) {
            session_start();
            $usertype = "admin";
            if(strcmp($_SESSION['usertype'], $usertype) === 0 || $_SESSION['userid'] == $userId) {
                $user = User::getOne($userId);
                if($userId == $_SESSION['userid']){
                    $clause = "username = ?";
                    $username = $user->getUsername();
                    $posts = Upost::getAll($clause, [$username]);
                    foreach($posts as $post){
                        $name = $post->getImage();
                        unlink(Configuration::UPLOAD_DIR . "$name");
                        $post->delete();
                    }
                    $user->delete();
                    session_start();
                    session_unset();
                    session_destroy();
                    $this->redirect("home", "index");
                } else {
                    $clause = "username = ?";
                    $username = $user->getUsername();
                    $posts = Upost::getAll($clause, [$username]);
                    foreach($posts as $post){
                        $name = $post->getImage();
                        unlink(Configuration::UPLOAD_DIR . "$name");
                        $post->delete();
                    }
                    $user->delete();
                    $this->redirect('login', "users");
                }
            }
        } else {
            $this->redirect('login', "users");
        }

    }

    //validacia reg a log

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

    public function usernameExists($username)
    {
        $result = false;
        $allUsers = User::getAll();

        foreach ($allUsers as $user){
            if(strtolower($user->getUsername()) === strtolower($username)){
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

    public function checkNameLength($username)
    {
        $length = strlen(utf8_decode($username));

        if($length < 5 ||$length > 13){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function checkPasswdLength($pwd)
    {
        $length = strlen(utf8_decode($pwd));

        if($length < 8 || $length > 20){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function checkPasswdStrength($pwd)
    {
        if ( !preg_match("#[0-9]+#", $pwd) ) {
            $result = true;
        } else if ( !preg_match("#[a-z]+#", $pwd) ) {
            $result = true;
        } else if ( !preg_match("#[A-Z]+#", $pwd) ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}