<?php
$last_id = filter_input(INPUT_GET, 'last_id', FILTER_VALIDATE_INT);
$page = filter_input(INPUT_GET, 'local');
$page_lan = strlen($page);
$category = filter_input(INPUT_GET, 'category');

switch($page_lan) {
    case 0: 
        break;
    case 2:
        $cat = (!$category || $category === 'all' || $category === 'my' || $category === 'dialogs') ? 'main' : $category;
        if(file_exists($page.'/str.php')) {
            include $page.'/str.php';
        }
        else if(file_exists($page.'/'.$cat.'/str.php')) {
            include $page.'/'.$cat.'/str.php';
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

