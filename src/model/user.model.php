<?php

class userModel{


    protected $userFields=["id","nick","pass","rol","idEstacion"];
    protected $readedUsers = [];
    protected $usersIndex = 0;
    protected $usersCount =0;



    /**
     * @return int
     */
    public function getIndex(){
        return $this->usersIndex;
    }

    /**
     * @param int $usersIndex
     */
    public function setIndex($usersIndex)    {
        $this->usersIndex = $usersIndex;
    }

    public function next(){
        $this->usersIndex++;
    }

    public function getLine(){
        if(isset($this->readedUsers[$this->usersIndex])){
            return $this->readedUsers[$this->usersIndex];
        }else{
            return false;
        }
    }

    public function getId() {
        return $this->readedUsers[$this->usersIndex]["id"];
    }

    public function getNick()  {
        return $this->readedUsers[$this->usersIndex]["nick"];
    }

    public function getPass()  {
//        f::p($this->readedUsers);
        return $this->readedUsers[$this->usersIndex]["pass"];
    }


    public  function  getIdEstacion(){
        return $this->readedUsers[$this->usersIndex]["idEstacion"];
    }

    public function getRol()
    {

        return $this->readedUsers[$this->usersIndex]["rol"];
    }

    public function getList(){
        global $db;
        $fields = implode(",", $this->userFields);
        $query = "SELECT $fields FROM users";
        $r = $db->fetchAll($query);

        // no injection here so we don' parse all the results

        $this->readedUsers = $r;
        $this->usersCount =count($r);

        global $navigation;
        $navigation->loadModel("meteoGalicia");
        $meteo = new meteoGaliciaModel();

        $returnArray=[];
        foreach ($this->readedUsers as $user){
            $user["estacionName"]=$meteo->getEstacionName($user["idEstacion"]);
            $returnArray[] =$user;
        }
        $this->readedUsers = $returnArray;


        return $this->readedUsers;
    }


    public function getUserById($id=null){
        global $db;
        $fields = implode(",", $this->userFields);
        $query = "SELECT $fields FROM users WHERE id= ?";
        $r = $db->fetch($query,[$id]);

        $tmpArray=[];
        foreach ($this->userFields as $field){
            $tmpArray[$field] = trim($r[$field]);
        }
        array_push($this->readedUsers,$tmpArray);

    }

    public  function getUserByName($name=null){

        global $db;
        $fields = implode(",", $this->userFields);
        $query = "SELECT $fields FROM users WHERE nick= ?";
        $r = $db->fetch($query,[$name]);

        $tmpArray=[];
        foreach ($this->userFields as $field){
            $tmpArray[$field] = trim($r[$field]);
        }
        array_push($this->readedUsers,$tmpArray);

        return $tmpArray;
    }


    public function addUser ($nick_="",$pass="",$rol="guest",$station="1"){
        global $db;

        if($nick_ instanceof config ){
            $data = $nick_;
        }else{
            $data =  new config([
                "nick"=>$nick_,
                "pass"=>$pass,
                "rol"=>$rol,
                "idEstacion"=>$station
            ]);
        }


        $exist = $this->getUserByName($data->getParam("user"));

        if(!empty($exist["nick"])){
//            f::p($exist);
//            exit;
            return "exists";
        }

        $fields=["nick","pass","rol","idEstacion"];
        $fields = implode(",", $fields);
        $query = "INSERT INTO users ($fields) VALUES (?,?,?,?);";

        $r = $db->execute($query,[$data->getParam("user"),md5($data->getParam("passwd")),$data->getParam("rol"),$data->getParam("idEstacion") ]);

        return $r;




    }


    public function deluser($id_=null){
        global $db;

        if($id_ instanceof config ){
            $id = $id_->getParam("id");
        }elseif(is_numeric($id_)){
            $id = $id_;
        }else{
            return false;
        }
        $query = "DELETE FROM users WHERE id=?;";
        $r = $db->execute($query,[$id]);
        return $r;


    }


}