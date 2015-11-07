<?php
$page = filter_input(INPUT_GET,'get_first');
$page_lan = strlen($page);
$category = filter_input(INPUT_GET,'get_first_var');
$post = filter_input(INPUT_GET,'get_second');
$id = filter_input(INPUT_GET,'get_second_var');

switch ($page_lan) {
    case 0:
        include 'mn/block.php';
        break;
    case $page === 'hm':
        include 'mn/block.php';
        break;
    case $page_lan === 2:
        $cat = (!$category || $category === 'all' || $category === 'my' || $category === 'dialogs') ? 'main' : $category;
        if(file_exists($page.'/block.php')) {
            include $page.'/block.php';
        }
        else if(file_exists($page.'/'.$cat.'/block.php')) {
            include $page.'/'.$cat.'/block.php';
        }
        else {
            $arr = array();
            $res = array(
                'head' => '<div id="material_null">
                                            <p>СТРАНИЦА НЕ НАЙДЕНА</p>
                                    </div>'
            );
            array_push($arr,$res);
            print json_encode($arr);
        }
        break;
    case $page_lan > 2:
        include 'pl/profile.php';
        break;
    default:
        $arr = array();
        $res = array(
            'head' => '<div id="material_null">
                                        <p>СТРАНИЦА НЕ НАЙДЕНА</p>
                                </div>'
        );
        array_push($arr,$res);
        print json_encode($arr);
        break;
}
