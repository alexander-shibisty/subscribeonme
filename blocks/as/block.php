<?php
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu">
                            <a href="all"><p>ПОСТЫ</p></a>
                            <a href="respect"><p>БЛАГОДАРНОСТЬ</p></a>
                        </nav>
                        <div id="material_null">
                            <p>МАТЕРИАЛОВ НЕТ</p>
                        </div>
                        <nav id="content_search">
                        </nav>
                        <section id="content_block">',
        'footer' => '</section>'
    );
    array_push($arr,$res);
    print json_encode($arr);