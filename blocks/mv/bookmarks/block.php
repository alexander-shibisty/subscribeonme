<?php
require '../php/main/db_connect.php';
$arr = array();
if(isset($user_id)) {

            $res = array(
                'head' => '<nav id="content_menu">
                                    <a href="mv=my" class="new_local"><p>МОИ ВИДЕО</p></a>
                                    <a href="mv=bookmarks" class="new_local"><p>ИЗБРАННОЕ</p></a>
                                    <a href="mv=upload" class="new_local"><p>ЗАГРУЗИТЬ</p></a>
                                </nav><div id="material_null">
                                    <p>МАТЕРИАЛОВ НЕТ</p>
                                </div>'
            );
            array_push($arr,$res);

}
else {
        $res = array(
            'head' => '<div id="none"><p>Для просмотра этой страницы пройдите регистрацию или авторизацию</p><div>'
        );
        array_push($arr,$res);
}

print json_encode($arr);