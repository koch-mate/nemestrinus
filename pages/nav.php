<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Menü</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/?mode=main">NEMESTRINUS <small style="color:#bbb;">v<?php include("lib/version.php");?></small></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php 
                foreach(array_keys(MENU_STRUCT) as $topMenu) {
                    if(!in_array(PAGE_RIGHTS[$topMenu], $_SESSION['userRights'])){
                        continue;
                    }
                ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?=MENU_NAMES[$topMenu]?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php 
                            foreach(array_keys(MENU_STRUCT[$topMenu]) as $separator){

                                if(!is_numeric($separator) && in_array(PAGE_RIGHTS[$separator], $_SESSION['userRights'])){?>
                                <li class="dropdown-header">
                                    <?=MENU_NAMES[$separator]?>
                                </li>
                                <?php }
                                foreach((is_numeric($separator) ? MENU_STRUCT[$topMenu] : MENU_STRUCT[$topMenu][$separator]) as $menuItem){
                                    if(!in_array(PAGE_RIGHTS[$menuItem], $_SESSION['userRights'])){
                                        continue;
                                    }
                                    ?>
                                    <li>
                                        <a href="/?mode=<?=$menuItem?>">
                                            <?=(in_array($menuItem,array_keys(MENU_ICONS))?'<span class="glyphicon '.MENU_ICONS[$menuItem].'" aria-hidden="true"></span> ':'')?>
                                            <?=MENU_NAMES[$menuItem]?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if(is_numeric($separator)){
                                    break;
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <?php } ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <p class="navbar-text">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    <a href="/?mode=sajat-profil">
                                        <?=$_SESSION['realName']?>
                                    </a>
                                </p>
                            </li>
                            <li><a href="/?mode=logout">Kilépés</a></li>
                        </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>