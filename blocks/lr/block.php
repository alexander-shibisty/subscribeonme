<?php
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu"></nav>
        <nav id="content_search"></nav>
        <section id="content_block"><article class="leter"></article></section>'
    );
    array_push($arr,$res);
    print json_encode($arr);