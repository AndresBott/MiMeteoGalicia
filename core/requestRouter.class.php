<?php

/**
 * Class navigation
 * Simple Front controller iplementation
 */
class navigation{


    protected $controllerInstance = null;
    protected $action = "";
    protected $default = "";
    protected $registrededControllers = [];


    /**
     * @param $conf instanceof config
     * you can pass a list oo controllers as a config instance
     */



    public function __construct($conf){
        if($conf instanceof config) {
            if(is_string($conf->getParam("defaultIndex")) ){
                $this->default = $conf->getParam("defaultIndex");
            }
        }
        $this->getController();
    }

    /**
     * include the correct controller and execute the corresponding action
     *
     */
    public function run(){


        $this->loadModel($this->controller);
        $controller = f::sanitizePath(CONTROLLERSPATH."/".$this->controller."Controller.php");


        if(is_readable($controller)) {
            include_once($controller);
            $controlerName = $this->controller."Controller";
        }
        else if(is_readable(f::sanitizePath(CONTROLLERSPATH."/".$this->default."Controller.php"))){
            include_once(f::sanitizePath(CONTROLLERSPATH."/".$this->default."Controller.php"));
            $controlerName = $this->default."Controller";
        }else if(ENV == "devel"){
            die("Correct Controlller nor deffined");
        }


        $this-> controllerInstance =  new $controlerName();

        $me = $this->action."Action";
        if(method_exists($this-> controllerInstance,$me)){
            $this->controllerInstance->$me();
        }elseif(method_exists($this-> controllerInstance, "indexAction")){
            $this->controllerInstance->indexAction();
        }else if(ENV == "devel"){
            die("Action Not Found");
        }else{
            $this->controllerInstance->notFoundAction();
        }


    }


    public function loadModel($name = ""){
        if(is_string($name)){
            $model = f::sanitizePath(ROOTPATH."/model/".$name.".model.php");
//            f::p($model);
            if(is_readable($model)){
                include_once ($model);
            }
        }
    }

    /**
     * redirect to new controller and acion
     * @param null $controller
     * @param null $action
     */
    public function redirect($controller=null,$action="index",$data=false){
        $this->setNavData($data);

        if(is_string($controller) && is_string($action)){

            $url =$this->getUrl($controller,$action);
            header('Location:'.$url);
            exit;
//            $this->setController($controller,$action);
//            $this->run();
        }
    }


    public function getUrl($controller=null,$action=null,$extraParams = []){

        $paramString = http_build_query(f::escapeArray($extraParams));

        if(is_string($controller) && is_string($action)){
//            f::p(f::sanitezeUrl(PUBLICURL."/index.php?c=$controller&a=$action"));
            return f::sanitezeUrl(PUBLICURL."/index.php?c=$controller&a=$action&$paramString");
        }

    }


    protected function setController($controller=null,$action=null){
        if(isset($controller) && !empty($controller)){
            $this->controller = $controller;
        }else{
            $this->controller = $this->default;
        }

        if(isset($action) && !empty($action)){
            $this->action = $action;
        }else{
            $this->action = "index";
        }

    }

    /**
     * Get the controller to be used deppending on the GET information
     * if non is passed the default is used
     * c => controller, a => action
     */
    protected function getController(){

        $c =(isset($_GET["c"]) && !empty($_GET["c"]) ) ? $_GET["c"] : null;
        $a =(isset($_GET["a"]) && !empty($_GET["a"]) ) ? $_GET["a"] : null;


        $this->setController($c,$a);
    }



    /**
     * include a template file view file
     * @param $name template dira and name
     *
     */
    public function includetpl($name,$datas =[]){
        global $siteConfig;
        global $auth;
        global $navigation;


        $data=[];
        if(isset($_SESSION["post"]) && is_array($_SESSION["post"])) {
            $data = $_SESSION["post"];
            unset($_SESSION["post"]);
        }


        if(!is_array($datas)){
            $datas= [$datas];
        }

        $data = array_merge($data,$datas);

        $data = new config($data);

        if(is_string($name)){
            $file = f::sanitizePath(ROOTPATH."/view/".$name);
            if(is_readable($file)){
                include($file);
            }else{
                f::p("file: $file not found");
            }
        }

    }


    public function setNavData($data = []){
        unset($_SESSION["post"]);
        if($data != false){
            $_SESSION["post"] = $data;
        }

    }




}