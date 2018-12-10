<?php
include (f::sanitizePath(ROOTPATH)."/view/head.tpl.php");
include (f::sanitizePath(ROOTPATH)."/view/front/menu.tpl.php");
?>
<div class="container-fluid text-center">
    <div class="row content">

        <div class="col-sm-6 col-sm-offset-3 text-left">


            <?php

            $meteo =new config($data->getParam("meteoData"));

            ?>
            <br><br>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 text-center ">
                    <div class="panel panel-default wheather-panel">
                        <div class="panel-body">
                            <span class="temp"><?=$meteo->getParam("valorTemperatura")?><i class="wi wi-degrees"></i> <i class="wi <?=$meteo->getParam("iconClass")?>"></i> </span>
                            <br>
                            <span class="wind"> <i class="wi <?=$meteo->getParam("windForceIcon")?>"></i> <i class="wi wi-wind  <?=$meteo->getParam("windDirIcon")?>"></i> </span>
                            <br>
                            <span><?=$meteo->getParam("estacion").", ".$meteo->getParam("concello")." (".$meteo->getParam("provincia").")"  ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php
//        f::p($data);
        ?>
    </div>
</div>
</div>
<?php include (f::sanitizePath(ROOTPATH)."/view/footer.tpl.php"); ?>