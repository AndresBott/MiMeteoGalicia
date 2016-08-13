<?php

class UserController extends controller{

    public function indexAction(){
        global $navigation;
        $navigation->redirect("user","viewList");
    }

    public function addUserAction(){
        // still not better solution...
        global $siteConfig;
        global $auth;
        global $navigation;

        if($auth->isRole("admin")){

            $post = new config($_POST);

            if($post->getParam("action") == "addUser") {
                if($post->hasValues(["user","passwd","rol"])){

                    $user = new userModel();
                    $r = $user->addUser($post);


                    if($r === "exists"){
                        $post->setParam("response","exists");
                        $navigation->redirect("User","addUser", $post->getArray());
                        exit;
                    }elseif($r == false){
                        $post->setParam("response","errorAdding");
                        $navigation->redirect("User","addUser", $post->getArray());
                        exit;
                    }else{
                        $post->setParam("response","Added");
                        $navigation->redirect("User","viewList", $post->getArray());
                        exit;
                    }


                }else{
                    $post->setParam("response","error");
                    $navigation->redirect("User","addUser", $post->getArray());
                    exit;
                }
            }else{
                if(isset($_SESSION["post"]) && is_array($_SESSION["post"])) {
                    $data = $_SESSION["post"];
                    unset($_SESSION["post"]);
                }else{
                    $data=[];
                }
                $navigation->loadModel("meteoGalicia");
                $meteo = new meteoGaliciaModel();
                $data["listaEstacionsMeteo"] = $meteo->getEstaciones();
//                f::p($data);
                $navigation->includetpl("/users/addUser.tpl.php",$data);
            }

        }else{
            $navigation->redirect("Front","login");
        }

    }


    public function viewListAction(){
        global $auth;
        global $navigation;

        if($auth->isRole("admin")){
            $user = new userModel();

            $userList = $user->getList();

            $navigation->includetpl("/users/viewList.tpl.php",["users"=>$userList]);
        }
    }


    public function delUserAction(){
        global $auth;
        global $navigation;
        if($auth->isRole("admin")) {
//            f::p("del user");

            $get = new config($_GET);
            $post = new config();

            $user = new userModel();
            $r = $user->delUser($get);

            if($r == false){
                $post->setParam("response","errorDeleting");
                $navigation->redirect("User","viewList", $post->getArray());
                exit;
            }else{
                $post->setParam("response","Deleted");
                $navigation->redirect("User","viewList", $post->getArray());
                exit;
            }

        }
    }

}

