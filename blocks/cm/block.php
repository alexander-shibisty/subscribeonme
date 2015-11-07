<?php
    $arr = array();
    $res = array(
        'head' => '<div id="material_null">
                            <p>МАТЕРИАЛОВ НЕТ</p>
                        </div>'
    );
    array_push($arr,$res);
    print json_encode($arr);