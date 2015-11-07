<?php
$mysql_set_charset = mysql_set_charset( 'utf8' );
require 'php/main/db_connect.php';
$ui = json_decode(file_get_contents('json/ui/ru/main/main.json'),true);
?>
<!doctype html>
    <html lang="ru-RU"   ondragover="return false">
        <head>
            <meta charset="utf-8">
            <title>Pulsar.me - Alpha</title>
            <noscript><meta HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://mpulsar.com/noscript.html"></meta></noscript>
            <link href="favicon.ico" type="image/x-icon" rel="SHORTCUT ICON" />
            <link type="text/css" href="css/main.css" rel="stylesheet" />
            <?php
            if(isset($user_id)) {
                print('<link type="text/css" href="css/login.css" rel="stylesheet" />');  
            }
            else {
                print('<link type="text/css" href="css/no_login.css" rel="stylesheet" />');
            }
            ?>
        </head>
        <body>
            <div class="load_animation"></div>
            <button class="profile_co" id="profile_open"></button>
            <section id="profile_window">
                <?php require_once 'blocks/prowin/win.php'; ?>
            </section>
            <section id="body">
                <section id="all">
                    <section id="modal_form">
                        <div id="mf_bar">
                            <p></p>
                            <img id="form_close" src="img/system_icon/upload_close.png"/>
                        </div>
                        <div id="mf_con">
                            
                        </div>
                    </section>
                    <section id="modal_window">
                        <div id="modal_bar">
                            <button id="modal_close">
                            </button>
                            <button id="modal_undock">
                            </button>
                            <button id="modal_rollup">
                            </button>
                        </div>
                        <div id="modal_content">
                        </div>
                    </section>
                    <section id="search">
                        <button id="search_button"></button>
                        <input type="text"/>
                        <section id="search_list">
                            <div class="search_list_title">
                                <p>Поиск</p>
                            </div>
                        </section>
                    </section>
                    <div id="scroll_search">
                        <div id="scroll">
                        </div>
                    </div>
                    <nav id="menu">
                        <a href="hm" class="new_local"><span class="menu_category"><?php print($ui['menu']['home']); ?></span></a>
                        <a href="vo" class="new_local"><span class="menu_category"><?php print($ui['menu']['videos']); ?></span></a>
                        <a href="au" class="new_local"><span class="menu_category "><?php print($ui['menu']['audios']); ?></span></a>
                        <a href="ie" class="new_local"><span class="menu_category"><?php print($ui['menu']['images']); ?></span></a>
                        <a href="lr" class="new_local"><span class="menu_category"><?php print($ui['menu']['leters']); ?></span></a>
                        <a href="ae" class="new_local"><span class="menu_category"><?php print($ui['menu']['articles']); ?></span></a>
                        <a href="cm" class="new_local"><span class="menu_category"><?php print($ui['menu']['communitys']); ?></span></a>
                        <a href="pe" class="new_local"><span class="menu_category"><?php print($ui['menu']['peoples']); ?></span></a>
                        <a href="be" class="new_local"><span class="menu_category"><?php print($ui['menu']['lores']); ?></span></a>
                        <a href="sm" class="new_local"><span class="menu_category"><?php print($ui['menu']['streams']); ?></span></a>
                        <a href="sp" class="new_local"><span class="menu_category"><?php print($ui['menu']['shop']); ?></span></a>
                        <div id="menu_bar">
                            <div id="menu_bar_progress"></div>
                        </div>
                    </nav>
                    <section id="con_beg">
                        <section id="content">
                        </section> 
                    </section>
                        <nav id="str">
                            <div id="str_tr"></div>
                        </nav>
                    <footer>
                        <a href="st" class="new_local"><p id="support"><?php print($ui['footer']['support']); ?></p></a>
                        <a href="rs" class="new_local"><p id="rules"><?php print($ui['footer']['rules']); ?></p></a>
                        <a href="as" class="new_local"><p id="autors"><?php print($ui['footer']['blog']); ?></p></a>
                        <p>Pulsar</p>
                        <p>CMS: Luna</p>
                    </footer>
                </section>  
            </section>

        <section id="error">
            <div id="error_marker">
                <p>ERROR</p>
                <img id="error_close" src="img/system_icon/close.png"/>
            </div>
            <div id="error_text">
                <p></p>
            </div>
        </section> 
        <section id="success">
            <div id="success_marker">
                <p>SUCCESS</p>
                <img id="success_close" src="img/system_icon/close.png"/>
            </div>
            <div id="success_text">
                <p></p>
            </div>
        </section>
    <script src="js/library/jquery-2.1.1.min.js"></script>
    <script src="js/library/jquery.ui.core.js"></script>
    <script src="js/library/jquery.ui.widget.js"></script>
    <script src="js/library/jquery.ui.mouse.js"></script>
    <script src="js/library/jquery.ui.draggable.js"></script>
    <script src="js/commons.js"></script>
    <script src="js/audio.js"></script>
    <script src="js/url.js"></script>
    <script src="js/active.js"></script>
    <script src="js/window.js"></script>
    <script src="js/main.js"></script>
    <script src="js/hotkeys.js"></script>
    <?php
    if(isset($user_id)) {
        print('<script src="js/library/jquery.Jcrop.min.js"></script><script src="js/avatar_upload.js"></script><script src="js/login.js"></script>');  
    }
    else {
        print('<script src="js/no_login.js"></script>');
    }
    ?>
	</body>
</html>
