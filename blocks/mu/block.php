<?php
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu">
                        <a href="mu=my" class="new_local"><p>МОЯ МУЗЫКА</p></a>
                        <a href="mu=bookmarks" class="new_local"><p>ИЗБРАННОЕ</p></a>
                        <a href="mu=upload" class="new_local"><p>ЗАГРУЗИТЬ</p></a>
                    </nav>
                    <div id="material_null">
                        <p>МАТЕРИАЛОВ НЕТ</p>
                    </div>'
    );
    array_push($arr,$res);
    print json_encode($arr);