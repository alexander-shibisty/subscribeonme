<?php
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu">
                        <a href="ma=my" class="new_local"><p>МОИ СТАТЬИ</p></a>
                        <a href="ma=bookmarks" class="new_local"><p>ИЗБРАННОЕ</p></a>
                        <a href="ma=add" class="new_local"><p>ДОБАВИТЬ</p></a>
                    </nav>
                    <div id="material_null">
                        <p>МАТЕРИАЛОВ НЕТ</p>
                    </div>'
    );
    array_push($arr,$res);
    print json_encode($arr);