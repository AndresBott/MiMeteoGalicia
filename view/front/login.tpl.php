<?php

include (f::sanitizePath(ROOTPATH)."/view/head.tpl.php");
include (f::sanitizePath(ROOTPATH)."/view/front/menu.tpl.php");
?>

    <div class="container text-center">
        <div class="row content">

            <div class="col-sm-8 col-sm-offset-2 text-left">

                <h1>Login</h1>
                <hr>
                <h4>Para poder usar este servicio debes de identificarte:</h4>

                <?php
                    if($data->getParam("response")== "error"){
                ?>


                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            Nombre de usuario o contraseña erroneos
                        </div>
                <?php
                    }
                ?>

                <form class="form-horizontal" role="form" method="POST" action="<?=$navigation->getURL("front","login") ?>">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="user" >Usuario:</label>
                        <div class="col-sm-10">
                            <input type="text" name="user" class="form-control" id="user" placeholder="Nombre de usuario" value="<?=$data->getParam("us")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Contraseña:</label>
                        <div class="col-sm-10">
                            <input type="password" name="passwd" class="form-control" id="pwd" placeholder="Contraseña">
                        </div>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <div class="col-sm-offset-2 col-sm-10">-->
<!--                            <div class="checkbox">-->
<!--                                <label>-->
<!--                                    <input type="hidden" name="remindme" value="0">-->
<!--                                    <input name="remindme" type="checkbox" value="1"> Recuerdame</label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Entrar</button>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="login">
                </form>


            </div>

        </div>
    </div>

<?php include (f::sanitizePath(ROOTPATH)."/view/footer.tpl.php"); ?>