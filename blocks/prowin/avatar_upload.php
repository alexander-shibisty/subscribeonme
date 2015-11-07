<?php
require '../../php/main/db_connect.php';
$pre_image_width = filter_var($_POST['settings']['width'], FILTER_VALIDATE_INT);
$pre_image_height = filter_var($_POST['settings']['height'], FILTER_VALIDATE_INT);
$pre_image_left = filter_var($_POST['settings']['left'], FILTER_VALIDATE_INT);
$pre_image_top = filter_var($_POST['settings']['top'], FILTER_VALIDATE_INT);
$pre_image_zoomx = filter_var($_POST['settings']['zoomx'], FILTER_VALIDATE_INT);
$pre_image_zoomy = filter_var($_POST['settings']['zoomy'], FILTER_VALIDATE_INT);
if(isset($user_id,
        $_FILES['avatar'],
        $pre_image_width,
        $pre_image_height,
        $pre_image_left,
        $pre_image_top,
        $pre_image_zoomx,
        $pre_image_zoomy)) {
    $filetype = array ('.jpeg','.png','.jpg','.gif');
    $filesize = 500;
    $filename = md5(time().$user_id.$_FILES['avatar']['tmp_name']);
    $filedir = "../../upload_image/avatars/".$filename.'.jpg';
    move_uploaded_file($_FILES['avatar']['tmp_name'],$filedir);
    
    //Первью 150px
    $params_150 = getimagesize($filedir);
    $w_150 = $params_150[0]/$pre_image_width;
    $h_150 = $params_150[1]/$pre_image_height;
    $x_150 = ($pre_image_left === 'auto') ? 0 : $pre_image_left*$w_150;
    $y_150 = ($pre_image_top === 'auto') ? 0 : $pre_image_top*$h_150;
    $new_width_150 = 150;
    $new_height_150 = 150;
    $result_width_150 = $pre_image_zoomx*$w_150;
    $result_height_150 = $pre_image_zoomy*$w_150;
    $new_image_150 = imagecreatetruecolor($new_width_150, $new_height_150);
    $old_image_150 = imagecreatefromjpeg($filedir);
    imagecopyresampled($new_image_150, $old_image_150, 0, 0, $y_150,$x_150,  $new_width_150, $new_height_150, $result_width_150, $result_height_150);
    imagejpeg($new_image_150, '../../upload_image/avatars/pre_150px/'.$filename.'.jpg', 100);
    unset($params_150);
    //Превью 50px
    $params = getimagesize('../../upload_image/avatars/pre_150px/'.$filename.'.jpg');
    $new_image = imagecreatetruecolor(50, 50);
    $old_image = imagecreatefromjpeg('../../upload_image/avatars/pre_150px/'.$filename.'.jpg');
    imagecopyresampled($new_image, $old_image, 0, 0, 0,0,  50, 50, 150, 150);
    imagejpeg($new_image, '../../upload_image/avatars/pre_50px/'.$filename.'.jpg', 90);
    unset($params);
    
    if(file_exists('../../upload_image/avatars/'.$filename.'.jpg') 
        && file_exists('../../upload_image/avatars/pre_150px/'.$filename.'.jpg')
        && file_exists('../../upload_image/avatars/pre_50px/'.$filename.'.jpg')) {
        //открываем транзакцию
        $load = $o->transactionQuery();
        mysqli_autocommit($load, false);
        $x =  mysqli_query($load,$o->parse("UPDATE users_information SET avatar=?s WHERE user_id=?i",$filename,$user_id));
        $y =  mysqli_query($load,$o->parse("INSERT INTO users_avatars (user_id, avatar) VALUES (?i,?s)",$user_id,$filename));
        if($x && $y) {
            mysqli_commit($load);
            print('success');
        }
        else {
            mysqli_rollback($load);
            print('Что-то пошло не так...');
        }
        mysqli_close($load);
    }
    else {
        print('Не одалось обработать файлы.');
    }
}
else {
    print('Пройдите регистрацию или авторизацию');
}
