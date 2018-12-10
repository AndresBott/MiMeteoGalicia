<?php

class meteoGaliciaModel{


    protected $urlListado = "http://servizos.meteogalicia.es/rss/observacion/listaEstacionsMeteo.action";
    protected $listaEstacones = null;
    protected $actualStateUrl = "http://servizos.meteogalicia.es/rss/observacion/estadoEstacionsMeteo.action?idEst=";



    public function getEstaciones(){

        if(is_array($this->listaEstacones)){
            return $this->listaEstacones;
        }

        if(f::urlReachable($this->urlListado) ){
            $json = file_get_contents($this->urlListado);
            $ar = json_decode($json,true);
            $this->listaEstacones = $ar["listaEstacionsMeteo"];
        }

        return $this->listaEstacones;
    }


    public function getEstacionName($id=0){
        if($this->listaEstacones == null){
            $this->getEstaciones();
        }

        foreach ($this->listaEstacones as $estacion){
            if($estacion["idEstacion"] == $id){
               return $estacion["estacion"].", ".$estacion["concello"]." (".$estacion["provincia"].")";
            }
        }
        return "Not Found";

    }

    public function  getData($id=0){

        if(is_numeric($id)){
            $url = f::sanitezeUrl($this->actualStateUrl.$id);
        }else{
            return false;
        }


        if(f::urlReachable($url) ){
            $json = file_get_contents($url);
            $obj = json_decode($json,true);

//            f::p($obj);
            if(empty($obj["listEstadoActual"])){
                return false;
            }else{
                $obj = $obj["listEstadoActual"][0];
                $obj["iconClass"] = $this->getIconClass($obj["lnIconoCeo"]);
                $obj["windDirIcon"] = $this->getWindDirecionClass($obj["lnIconoVento"]);
                $obj["windForceIcon"] = $this->getWindForceClass($obj["lnIconoVento"]);
                //f::p($obj);
                return $obj;
            }


        }
    }



    public function getIconClass($num=0){
        if(is_numeric($num)){
            switch($num){
                case 101: // despejado
                    return "wi-day-sunny";
                case 103: // nuves y claros
                    return "wi-day-sunny-overcast";
                case 105: // cubierto
                    return"wi-cloudy";
                case 107:  // chuvascos
                    return"wi-day-showers";
                case 111 : // lluvia
                    return "wi-rain";
                case 201: // noche despejada
                    return"";
                case 211: // noche lluvia
                    return "wi-night-clear";
                default: // sin dato
                    return "wi-volcano";
            }
        }

    }


    public function getWindDirecionClass($num=0){
        if(is_numeric($num)){
            switch($num){
                case 301: // direccion norte
                case 309:
                case 317:
                    return "wi-towards-n";

                case 302: // direccion NE
                case 310:
                case 318:
                    return "wi-towards-ne";


                case 303: // direccion E
                case 311:
                case 319:
                    return "wi-towards-e";


                case 304: // direccion SE
                case 312:
                case 320:
                    return "wi-towards-se";


                case 305: // direccion S
                case 313:
                case 321:
                    return "wi-towards-s";

                case 306: // direccion SW
                case 314:
                case 322:
                    return "wi-towards-sw";

                case 307: // direccion W
                case 315:
                case 323:
                    return "wi-towards-w";


                case 308: // direccion NW
                case 316:
                case 324:
                    return "wi-towards-nw";

                case 300: // variable
                    return "D";



                default: // sin dato
                    return "";
            }
        }
    }


    public function getWindForceClass($num=0){

        if($num >=301 && $num <309){
            return "wi-wind-beaufort-1";
        }else if($num >=309 && $num <317){
            return "wi-wind-beaufort-2";
        }elseif($num >=317 && $num <324){
            return "wi-wind-beaufort-3";
        }else{
            return "no data";
        }

    }


}


