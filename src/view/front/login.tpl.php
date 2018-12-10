<?php

include (f::sanitizePath(ROOTPATH)."/view/head.tpl.php");
include (f::sanitizePath(ROOTPATH)."/view/front/menu.tpl.php");
?>

    <div class="container text-center">
        <div class="row content">

            <div class="col-sm-8 col-sm-offset-2 text-left">

                <h1>Login</h1>
                <hr>
                <h4>Please login: (admin:admin)</h4>

                <?php
                    if($data->getParam("response")== "error"){
                ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            Wrong user or password
                        </div>
                <?php
                    }
                ?>

                <form class="form-horizontal" role="form" method="POST" action="<?=$navigation->getURL("front","login") ?>">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="user" >User:</label>
                        <div class="col-sm-10">
                            <input type="text" name="user" class="form-control" id="user" placeholder="Username" value="<?=$data->getParam("us")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" name="passwd" class="form-control" id="pwd" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Login</button>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="login">
                </form>


            </div>

        </div>
    </div>

<?php include (f::sanitizePath(ROOTPATH)."/view/footer.tpl.php"); ?>