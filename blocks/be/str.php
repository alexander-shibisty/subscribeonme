<?php
require '../php/main/SafeMySQL.php';
if($last_id) {
    $o = new SafeMySQL();
    $base = $o->getAll('SELECT id,title FROM base_games WHERE id>?i LIMIT 0,10',$last_id);
    $arr = array();
    $i = 0;
    foreach ($base as $array) {
        $res = array (
            'n0' => $array['id'],
            'n1' => $array['title']
        );
        $i++;
        array_push($arr,$res);
    }
    unset($array);
    print json_encode($arr);
}