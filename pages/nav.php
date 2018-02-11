<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container" style="width:75%;">
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
                    if(count(array_intersect(PAGE_RIGHTS[$topMenu], $_SESSION['userRights'])) == 0){
                        continue;
                    }
                ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?=MENU_NAMES[$topMenu]?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach(array_keys(MENU_STRUCT[$topMenu]) as $separator){

                                if(!is_numeric($separator) && count(array_intersect(PAGE_RIGHTS[$separator], $_SESSION['userRights'])) > 0 ){?>
                                <li class="dropdown-header">
                                    <?=MENU_NAMES[$separator]?>
                                </li>
                                <?php }
                                foreach((is_numeric($separator) ? MENU_STRUCT[$topMenu] : MENU_STRUCT[$topMenu][$separator]) as $menuItem){
                                    if(count(array_intersect(PAGE_RIGHTS[$menuItem], $_SESSION['userRights'])) == 0){
                                        continue;
                                    }
                                    ?>
                                    <li>
                                        <a href="/?mode=<?=$menuItem?>">
                                            <?=(in_array($menuItem,array_keys(MENU_ICONS))?
                                                MENU_ICONS[$menuItem][0] == 'g' ?
                                                '<span class="glyphicon '.MENU_ICONS[$menuItem].'" aria-hidden="true"></span> ':
                                                '<i class="fa '.MENU_ICONS[$menuItem].'" aria-hidden="true"></i> '

                                                :'')?>
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
                                  <a href="/?mode=sajat-profil">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;
                                        <?=$_SESSION['realName']?>
                                    </a>
                                </p>
                            </li>
                            <li>
                              <a href="/?mode=help"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;Súgó</a>
                            </li>
                            <li >
                                <a style="color:orange;" href="https://github.com/koch-mate/nemestrinus/issues/new" target="_blank"><i class="fa fa-github" aria-hidden="true"></i>&nbsp;Hibabejelentés</a>
                            </li>

                            <li><a href="/?mode=logout"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Kilépés</a></li>
                        </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
