<?php
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu">
                        <a href="ml=my" class="new_local"><p>МОИ РУКОПИСИ</p></a>
                        <a href="ml=bookmarks" class="new_local"><p>ИЗБРАННОЕ</p></a>
                        <a href="ml=add" class="new_local"><p>ДОБАВИТЬ</p></a>
                    </nav>
                    <nav id="content_search"></nav>
                    <section id="content_block">
                    </section>'
    );
    array_push($arr,$res);
    print json_encode($arr);