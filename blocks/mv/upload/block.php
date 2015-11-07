<?php
require '../php/main/db_connect.php';
$arr = array();
if(isset($user_id)) {
            $nav_ui = json_decode(file_get_contents('../json/ui/ru/mv/nav.json'),true);
            $res = array(
                'head' => '<link type="text/css" href="css/jquery.datetimepicker.css" rel="stylesheet" />
                            <link type="text/css" href="css/blocks/mv/mv_upload.css" rel="stylesheet" />
                                <nav id="content_menu">
                                    <a href="mv=my" class="new_local"><p>'.$nav_ui['my'].'</p></a>
                                    <a href="mv=bookmarks" class="new_local"><p>'.$nav_ui['bookmark'].'</p></a>
                                    <a href="mv=upload" class="new_local"><p>'.$nav_ui['upload'].'</p></a>
                                </nav>
                                <nav id="content_search">
                                    <button class="content_search">
                                        Встроить видео
                                    </button>
                                    <button class="content_search">
                                        Загрузить видео
                                    </button>
                                </nav>
                                <section id="content_block">
                                        <div class="video_upload_form">
                                            <div class="video_embed">
                                                <input id="video_embed" type="text">
                                                <button id="video_embed_button">Посмотреть</button>
                                            </div>
                                            <div id="form_video">
                                                <div class="video_embed_video">
                                                </div>
                                                <button id="video_embed_close"></button>
                                                <button id="video_embed_button_pst"></button>
                                                <div class="video_embed_title">
                                                    <input id="video_embed_title" type="text">
                                                </div>
                                                <input id="video_embed_category" type="text">
                                                    <div id="video_embed_category_auto">
                                                        <div class="video_embed_category_auto">
                                                            <p>Обзор</p>
                                                        </div>
                                                    </div>
                                                <div id="video_embed_node">
                                                    <p>Связь</p>
                                                    <div id="video_embed_node_auto">
                                                        <div class="video_embed_node_auto">
                                                            <p>Обзор</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input id="video_embed_date" type="text">
                                                <div class="video_embed_text"">
                                                    <textarea id="video_embed_text" ></textarea>
                                                </div>
                                                <div class="video_embed_rules">
                                                    <div class="video_embed_status">
                                                        <div class="video_embed_status_pt video_embed_status_active" id="for_all">
                                                        </div>
                                                    </div>
                                                    <p>Для всех</p>
                                                    <div class="video_embed_status">
                                                        <div class="video_embed_status_pt" id="for_sub">
                                                        </div>
                                                    </div>
                                                    <p>Для подписчиков</p>
                                                    <div class="video_embed_status">
                                                        <div class="video_embed_status_pt" id="for_friends">
                                                        </div>
                                                    </div>
                                                    <p>Для друзей</p>
                                                    <div class="video_embed_status">
                                                        <div class="video_embed_status_pt" id="for_me">
                                                        </div>
                                                    </div>
                                                    <p>Частное</p>
                                                </div>
                                                <div class="video_embed_image">
                                                    <p>Перетащите картинку в эту область.</p>
                                                    <input id="video_embed_image" type="file">
                                                    <div class="pre_video_embed_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                </section><script src="js/library/jquery.datetimepicker.js"></script><script defer src="js/blocks/mv.js"></script>'
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