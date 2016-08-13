<?php

/**
 * Class abdb
 * this is a simple database abstraction just for this example
 * It connects to a sqlite database, other databases  should be easily implemented
 */



final class database{

        // use traits for diferent database types
    protected $db = false;
    protected $dbType;
    protected $dbName;
    protected $user;
    protected $pass;
    protected $dbUrl;
    protected $errors =[];


    /**
     * @param null $dbType "sqlite" mysql not implemented yet
     * @param null $dbUrl path to the sqlite database, or database server url
     * @param null $dbName // not used
     * @param null $user // not used
     * @param null $pass // not used
     */
    public function __construct($dbType = null, $dbUrl=null, $dbName = null, $user = null, $pass = null ){

        // check if the needed pdo drivers are installed
        $this->checkPDO();


        $keys = ["dbType","dbUrl","dbName","user","pass"];
        if($dbType instanceof config){

            foreach ($keys as $key ){

                if($dbType->getParam($key) != null ){
                    $this->$key = $dbType->getParam($key);
                }
            }


        }else{

            $this->dbType = $dbType;
            $this->dbUrl = $dbUrl;
            $this->dbName = $dbName;
            $this->user = $user;
            $this->pass = $pass;
        }



        if($this->getConnectString() != false){
            $this->connect();
        }
    }


    /**
     * check if pdo and sqlite module is available in this PHP
     * exit printing a message if not.
     */
    protected function checkPDO(){
        if (!class_exists('PDO')) {
            f::p("You need to install PHP PDO");
            exit;
        }
        $driver = PDO::getAvailableDrivers();

        if(!in_array("sqlite",$driver)){
            f::p("PDO sqlite not installed");
            exit;
        }

    }

    /**
     * Connect to database
     */
    public function connect(){
        try {
            $this->db = new PDO($this->getConnectString());
        }
        catch( PDOException $Exception ) {
            $this->addError("ERROR: Unable to connect to database (".$Exception->getCode( ));
            //throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
    }

    /**
     * check for database connection
     * @return bool true if has db connection and false if not
     */
    public function isConnected(){
        if($this->db === false){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @return array an array with all error messages
     */
    public function getError(){
        $tmp = $this->errors;
        $this->errors = [];
        return $tmp;
    }

    private function addError($msg =null){
        if(is_string($msg)){
            array_push( $this->errors,$msg);
        }
    }

    /**
     * @return string | false retunrs a pdo connection string or false of not enought data
     */
    private function getConnectString(){

        switch ($this->dbType){
            case "sqlite":

                if(is_string($this->dbUrl)){

                    return "sqlite:".$this->dbUrl;
                }

                break;

            case "mysql":
                // not implemented yet
                return false;
            break;

            default:
                return false;
            break;
        }
    }

    /**
     * fetch a sql query as a prepared statement
     * @param $sql
     * @param $data
     * @return array
     */
    public function fetch($sql,$data=[]){

        if(!is_array($data)){
            $this->addError("ERROR: method fetch needs data passed as array");
            return false;
        }
        $prep = $this->db->prepare($sql);
        $prep->execute($data);
        $result = $prep->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * feach all result from a query
     * @param $sql
     * @param array $data
     * @return bool
     */
    public function fetchAll($sql,$data=[]){
        if(!is_array($data)){
            $this->addError("ERROR: method fetch needs data passed as array");
            return false;
        }
        $prep = $this->db->prepare($sql);
        $prep->execute($data);
        $result = $prep->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    function execute($sql,$data=[]){
        if(!is_array($data)){
            $this->addError("ERROR: method fetch needs data passed as array");
            return false;
        }


        $prep = $this->db->prepare($sql);
        $r = $prep->execute(f::escapeArray($data));

        if(!$r){
            $this->addError("ERROR: executing query");
            return false;
        }

        return true;
    }






}
