<?php

class FrontController extends controller{


    public function indexAction(){
        // still not better solution...
        global $siteConfig;
        global $auth;
        global $navigation;

        if($auth->isloggedIn()){

            $navigation->redirect("Meteogalicia","index");
        }else{
            $navigation->redirect("Front","login");
        }



    }

    public function loginAction(){

        // still not better solution...
        global $siteConfig;
        global $auth;
        global $navigation;


        $post = new config($_POST);

        if($post->getParam("action") == "login") {

            $auth->login($post);
            if($auth->isLoggedIn()){
                $navigation->redirect("Front","index");
            }else{
                $data = ["response"=>"error","user"=>$_POST["user"]];
                $navigation->redirect("Front","login",$data);
            }

            exit;
        }else{
            $navigation->includetpl("front/login.tpl.php");

        }
    }


    /***
     * Log users out and redirect to login
     */
    public function logoutAction(){
        global $auth;
        global $navigation;
        $auth->logout();
//        f::p("logout");
        $navigation->redirect("Fron","login");
        exit;

    }

    public function notFoundAction(){
        echo "404";
    }
}

