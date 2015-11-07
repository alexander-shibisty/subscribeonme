<?php
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu"> 
                                    <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                    <a href="mm=conference" class="new_local"><p>КОНФЕРЕНЦИИ</p></a>
                                    <a href="mm=friends" class="new_local"><p>ДРУЗЬЯ</p></a>
                                </nav><div id="material_null">
                            <p>МАТЕРИАЛОВ НЕТ</p>
                        </div>'
    );
    array_push($arr,$res);
    print json_encode($arr);