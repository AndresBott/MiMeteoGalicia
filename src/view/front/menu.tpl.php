<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <?php  if($auth->isLoggedIn()){?>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainMenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php } ?>
            <a class="navbar-brand" href="<?=$navigation->getURL("Front","index") ?>">Sample MVC</a>
        </div>
        <div class="collapse navbar-collapse" id="mainMenu">
        <?php  if($auth->isLoggedIn()){?>
            <ul class="nav navbar-nav navbar-right">

                <?php if($auth->isRole("admin")){ ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=$navigation->getURL("User","addUser") ?>">Add</a></li>
                        <li><a href="<?=$navigation->getURL("User","viewList") ?>">View</a></li>

                    </ul>
                </li>
                <?php } ?>
                <li><a href="<?=$navigation->getURL("Front","logout") ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

            </ul>
        <?php } ?>

        </div>
    </div>
</nav>


