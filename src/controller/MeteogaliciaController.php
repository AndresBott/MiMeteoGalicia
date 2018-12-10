<?php

class MeteogaliciaController extends controller{

    public function indexAction(){
        // still not better solution...
        global $siteConfig;
        global $auth;
        global $navigation;

        if($auth->isloggedIn()){

            $navigation->loadModel("meteoGalicia");
            $meteo = new meteoGaliciaModel();

            $user = new userModel();
            $user->getUserById($auth->getUserId());
            $idEstacion = $user->getIdEstacion();
//            f::p($idEstacion);
            $currentData = $meteo->getData($idEstacion);

            $navigation->includetpl("front/index.tpl.php",["meteoData"=>$currentData,"user"=>$user->getNick()]);
        }else{
            $navigation->redirect("Front","login");
        }


    }
}

