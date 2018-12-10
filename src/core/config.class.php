<?php

/**
 * Class config
 * used to manage configuration paramenters making it easy to add and read config data
 * encapsulating all the needed parapeters in one  object, instead of passing a lot of attributes.
 */

class config{
    /**
     * @var array
     * holds all the parameters
     */
    private $paramList = [];

    /**
     * @param null $val
     * add parameters when instanciating the object
     */
    function __construct($val=null){
        if(is_array($val)){
            $this->paramList = f::escapeArray($val);
        }
    }

    /**
     * @param null $key
     * @param null $val
     * Set the value of a parameter
     */
    public function setParam($key=null,$val=null){
        if(is_string($key) && !empty($val)){
            $this->paramList[$key] = $val;
        }
    }

    /**
     * @param null $key
     * @return null
     * return a the value of a parameter if it's set.
     */
    public function getParam($key = null){
        if(isset($this->paramList[$key]) && !empty($this->paramList[$key])){
            return $this->paramList[$key];
        }else{
            return null;
        }
    }

    /**
     * @return array
     * Get an array of all avaliable parameters keys
     */
    public function getParamList (){
        return array_keys($this->paramList);
    }


    /**
     * @return array
     * Get the parameters key=>value array
     */
    public function getArray(){
        return $this->paramList;
    }

    /**
     * @param $v
     * @return bool
     * check if a parameter is set
     */
    public function hasValues($v){
        if(is_string($v)){
            if(isset($this->paramList[$v]) && !empty($this->paramList[$v])){
                return true;
            }else{
                return false;
            }
        }else if(is_array($v)){
            foreach($v as $keys){
                if(!$this->hasValues($keys)){
                    return false;
                }
            }
            return true;
        }
    }
}