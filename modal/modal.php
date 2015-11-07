<?php
require '../php/main/SafeMySQL.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$category = filter_input(INPUT_POST, 'category');

$local = array(
    'video' => 'video',
    'audio' => 'audio',
    'images' => 'images',
    'text' => 'text'
);

if($local[$category]) {
    include $category.'/'.$category.'.php';
}