<?php
require '../../../php/main/db_connect.php';
$link = trim(filter_input(INPUT_POST, 'link'));
$title = filter_input(INPUT_POST, 'title');
$category = filter_input(INPUT_POST, 'category');
$node = filter_input(INPUT_POST, 'node');
$node_cat = filter_input(INPUT_POST, 'node_cat');
$date = filter_input(INPUT_POST, 'time');
$text = filter_input(INPUT_POST, 'text');
$status = filter_input(INPUT_POST, 'status');
$image = ($_FILES['image']) ? $_FILES['image'] : filter_input(INPUT_POST, 'image');
if($user_id && $link && $title) {
    /*preg_match("/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/", $link, $result);
    if ($result) {
        //Проверка даты
        if(!$date) {
            date_default_timezone_set('Europe/London');
            $date = date('Y-m-d H:i:s');
        }
        //Проверка картинки
        if(!$image) {
            $url='http://img.youtube.com/vi/'.$result[1].'/0.jpg';
            $f=fopen($url,'rb');
            $f1=fopen('../../../upload_image/videos/pre_500px/'.$result[1].'.jpg','wb');
            while (!feof($f)){
                $str=fread($f,1024);
                fwrite($f1,$str);
            }
            fclose($f);
            fclose($f1);
        }
        //Категория
        if(!$category) {
            $category = '';
        }
        $load = $o->transactionQuery();
        mysqli_autocommit($load, false);
        $in = mysqli_query($load, $o->parse('INSERT INTO posts_videos_in (image,date,title,user_id,category) VALUES (?s,?s,?s,?i,?s)',$result[1],$date,$title,$user_id,$category));
        mysqli_query($load,$o->parse("SET @lastID := LAST_INSERT_ID();"));
        if(!$text) {
            $x = mysqli_query($load, $o->parse("INSERT INTO posts_videos (v_id, video) VALUES (@lastID,?s)",$link));
        }
        else {
            $x = mysqli_query($load, $o->parse("INSERT INTO posts_videos (v_id, video,text) VALUES (@lastID,?s,?s)",$link,$text));
        }
        //Статус
        if(!$status){
            $y = mysqli_query($load, $o->parse("INSERT INTO posts_videos_status (v_id, status) VALUES (@lastID,'me')"));
        }
        else {
            $y = mysqli_query($load, $o->parse("INSERT INTO posts_videos_status (v_id, status) VALUES (@lastID,?s)",$status));
        }
        //Связь
        if($node) {
            
        }
        //Конец транзакции
        if($x && $in && $y) {
            mysqli_commit($load);
            print('success');
        }
        else {
            mysqli_rollback($load);
            print('Что-то пошло не так.');
        }
        mysqli_close($load);
    }
    else {
        print('Пока-что отправлять можно только ссылки на YouTube.');
    }*/
}
else {
    print('Пройдите регистрацию или авторизацию.');
}