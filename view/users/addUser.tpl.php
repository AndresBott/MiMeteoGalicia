<?php

include (f::sanitizePath(ROOTPATH)."/view/head.tpl.php");
include (f::sanitizePath(ROOTPATH)."/view/front/menu.tpl.php");
?>



<div class="container text-center">
    <div class="row content">

        <div class="col-sm-8 col-sm-offset-2 text-left">

            <h1>Añadir Usuario</h1>
            <hr>
            <?php
//            f::p($data->getParam("listaEstacionsMeteo")[6]);
            $msg = false;

//            f::p($data);
            if($data->getParam("response")== "error"){
                $msg = "Faltan campos por añadir";
            }
            if($data->getParam("response")== "exists"){
                $msg = "El usuario ya existe";
            }
            if($data->getParam("response")== "errorAdding"){
                $msg = "Error desconocido añadiendo el usuario";
            }

            if($msg){
                ?>


                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?= $msg ?>
                </div>
                <?php

            }
            ?>
            <form class="form-horizontal" role="form" method="POST" action="<?=$navigation->getURL("User","addUser") ?>">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="user" >Nombre de Usuario:</label>
                    <div class="col-sm-8">
                        <input type="text" name="user" class="form-control" id="user" placeholder="Nombre de usuario" value="<?=$data->getParam("user")?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="pwd">Contraseña:</label>
                    <div class="col-sm-8">
                        <input type="password" name="passwd" class="form-control" id="pwd" placeholder="Contraseña">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="rol">Rol:</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="rol" id="rol">
                            <option>user</option>
                            <option>guest</option>
                            <option>admin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5" for="idEstacion">Estacion Metereológica:</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="idEstacion" id="idEstacion">
                            <option value="0">Ninguna</option>
                            <?php  foreach($data->getParam("listaEstacionsMeteo") as $estacion){     ?>
                                <option value="<?=$estacion["idEstacion"]?>"><?=$estacion["estacion"]." ".$estacion["concello"]." (".$estacion["provincia"].")"?></option>
                            <?php   }   ?>

                        </select>
                    </div>


                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Añadir</button>
                    </div>
                </div>
                <input type="hidden" name="action" value="addUser">
            </form>


        </div>

    </div>
</div>

<?php include (f::sanitizePath(ROOTPATH)."/view/footer.tpl.php"); ?>
