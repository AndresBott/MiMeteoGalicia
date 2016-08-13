<?php
include (f::sanitizePath(ROOTPATH)."/view/head.tpl.php");
include (f::sanitizePath(ROOTPATH)."/view/front/menu.tpl.php");
//f::p($data);
?>
    <div class="container-fluid text-center">
        <div class="row content">

            <div class="col-sm-8 col-sm-offset-2 text-left">

                <h1>Listar usuarios</h1>
                <hr>
                <?php
                $msg = false;

//                f::p($data);
                if($data->getParam("response")== "Added"){
                    $msg = "Usuario añadido Correctamente";
                }
                if($data->getParam("response")== "Deleted"){
                    $msg = "Usuario Eliminado Correctamente";
                }

                if($msg){
                    ?>


                    <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <?= $msg ?>
                    </div>
                    <?php

                }
                ?>

                <?php
                $msg = false;

                //                f::p($data);
                if($data->getParam("response")== "errorDeleting"){
                    $msg = "Error desconocido eliminando usuario";
                }
                if($msg){
                    ?>
                    <div class="alert alert-error" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <?= $msg ?>
                    </div>
                    <?php

                }
                ?>






                <table class="table">
                    <thead>
                    <tr>
                        <th>Nick</th>
                        <th>rol</th>
                        <th>Id Estación</th>
                        <th>Nombre Estación</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach($data->getParam("users") as $usuario){
                    ?>
                    <tr>
                        <td><?= $usuario["nick"]?></td>
                        <td><?= $usuario["rol"]?></td>
                        <td><?= $usuario["idEstacion"]?></td>
                        <td><?= $usuario["estacionName"]?></td>
                        <td>
                            <a href="<?=$navigation->getURL("User","delUser",["id"=>$usuario["id"]]) ?>">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>


                <?php
//                f::p($data);
                ?>





            </div>

        </div>
    </div>

<?php include (f::sanitizePath(ROOTPATH)."/view/footer.tpl.php"); ?>