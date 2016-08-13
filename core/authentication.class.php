<?php
/**
 * the authentication core module uses the user model to access the users
 * In a real use case, the authentication module should not depend on a model, but allow to use it, defined in the config
 */
include(ROOTPATH . "/model/user.model.php");

class authentication{

    protected $AuthAttrs= ["userId","userNick","isLoggedIn"];
    protected $role = null;
    protected $userNick = null;
    protected $userId = null;
    protected $isLoggedIn = false;

   /**
     * use php sessions to store user data
     */
    public function __construct(){
        session_start();

        $this->readSession();

        if(!isset($this->userId)) {
            $this->userNick = "Guest";
        }
    }


    /**
     * Write the object important data to Session variable
     */
    protected function writeSession(){
        foreach($this->AuthAttrs as $v){
            $_SESSION[$v] =  $this->$v;
        }
    }
    /**
     * Read from session variable and fill in the needed data
     */
    protected function readSession(){
        foreach($this->AuthAttrs as $v){
            if(isset($_SESSION[$v] ) && !empty($_SESSION[$v])) {
                    $this->$v = $_SESSION[$v];
            }
        }
    }

    /**
     * Load the role from the defined user From the database
     */
    protected function getRole(){
        if($this->isLoggedIn()){
            global $db;
            $userModel = new userModel();
            $userModel->getUserById($this->userId);
            return $userModel->getRol();
        }else {
            return null;
        }
    }


    public function isRole($role = " "){
        if($this->getRole() == $role){
            return true;
        }else{
            return false;
        }
    }

    public function isLoggedIn(){
        return $this->isLoggedIn;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function login($user=" ",$pass=" "){

        if($user instanceof config){
            $pass = $user->getParam("passwd");
            $us = $user->getParam("user");
        }else{
            $us = $user;
        }

        $us = f::escapeString($us);
        $pass = f::escapeString($pass);
        $mdpass = md5($pass);

//        f::p("user: $user pass: $pass md5pass: $mdpass");

        $userModel = new userModel();
        $userModel->getUserByName($us);
        $dbUserPass = $userModel->getPass();

//        f::p($userModel);
//        f::p($dbUserPass);
//        f::p($mdpass);


        if($dbUserPass == $mdpass){

            $this->isLoggedIn = true;
            $this->userNick = $userModel->getNick();
            $this->userId = $userModel->getId();
            $this->writeSession();
        }
    }




    public function logout(){
        foreach($this->AuthAttrs as $v){
            if(isset($_SESSION[$v] ) && !empty($_SESSION[$v])) {
                unset($_SESSION[$v]);
                $this->$v = null;
            }
        }
        $this->isLoggedIn = false;
    }



}