<?php
//$session_start = session_start();
$arr = array();
if($_SESSION['registration_email'] && $_SESSION['registration_password'] && preg_match('/^(?:\d+)_(?:\w+)$/', $category)){
    require '../php/main/SafeMySQL.php';
    $o = new SafeMySQL;
    //Если данные уже есть в базе пользователей
    $x = $o->getRow('SELECT password, email, nickname, category, rules FROM users_registration WHERE key_reg=?s', $category);
    if(!$x) {
        $res = array(
            'head' => '<div id="material_null">
                                <p>МАТЕРИАЛОВ НЕТ</p>
                            </div>'
        );
        array_push($arr,$res);
        print json_encode($arr);
        exit();
    }
    $re_id = $o->getOne('SELECT user_id FROM users WHERE email=?s AND password=?s',$x['email'],$x['password']);
    if($re_id) {
        $res = array(
            'head' => '<div id="material_null">
                                <p>Вы уже зарегистрированы.</p>
                            </div>'
        );
        array_push($arr,$res);
        print json_encode($arr);
        exit();
    }
    //Данных нет, отлично, ищем в таблице регистрации
    if($x['password'] == $_SESSION['registration_password'] 
            &&  $x['email'] == $_SESSION['registration_email']) {
        //Создаем транзакцию, чтобы данные попали во все нужны таблицы
        $load = $o->transactionQuery();
        mysqli_autocommit($load, false);
        $t1 = mysqli_query($load, $o->parse("INSERT INTO users (email,password) VALUES (?s,?s)",$x['email'],$x['password']));
        mysqli_query($load,$o->parse("SET @lastID := LAST_INSERT_ID();"));
        $t2 = mysqli_query($load, $o->parse("INSERT INTO users_information (user_id,nickname,category) VALUES (@lastID,?s,?s)",$x['nickname'],$x['category']));
        $t3 = mysqli_query($load, $o->parse("INSERT INTO users_online (user_id,online) VALUES (@lastID,'offline')"));
 
        if($t1 && $t2 && $t3) {
            mysqli_commit($load);
            $res = array(
                'head' => '<div id="none"><p>Вы зарегистрированы! Теперь можно попробовать войти на сайт.</p></div>'
            );
            array_push($arr,$res);
            $o->query("DELETE FROM users_registration WHERE key_reg=?s", $category);
            unset($_SESSION['registration_email'],$_SESSION['registration_password'],$key_reg);
        }
        else {
            mysqli_rollback($load);
            $res = array(
                'head' => '<div id="material_null">
                    <p>Что-то пошло не так.</p>
                </div>');
            array_push($arr,$res);
        }
        mysqli_close($load);
    }
    else{
        $res = array(
            'head' => '<div id="material_null">
                                <p>Данные не сошлись.</p>
                            </div>'
        );
        array_push($arr,$res);
    }
}
else if (preg_match('/^(?:\d+)_(?:\w+)$/', $category) && !filter_input(INPUT_COOKIE, 'RememberMe')) {
        require '../php/main/SafeMySQL.php';
        $o = new SafeMySQL;
        $x = $o->getRow('SELECT password, email, nickname, category, rules FROM users_registration WHERE key_reg=?s', $category);
        if(!$x) {
            $res = array(
                'head' => '<div id="material_null">
                                    <p>МАТЕРИАЛОВ НЕТ</p>
                                </div>'
            );
            array_push($arr,$res);
            print json_encode($arr);
            exit();
        }
        $res = array(
            'head' => '<style>
                            #material_null input {
                                width:174px;
                                height:30px;
                                border:none;
                                padding:3px;
                                border-bottom: 2px #db9b9b solid;
                                margin:5px 10px;
                                color:#5c5c5c;
                            }
                            #material_null button {
                                width:180px;
                                height:40px;
                                background:#fff;
                                cursor:pointer;
                                font-size:14px;
                                color:#b1b1b1;
                                border-bottom: #db9b9b solid 2px;
                                margin:5px 10px;
                                text-align: left;
                                text-align: center;
                                font-weight: bold;
                            }
                            #str_tr {
                                    border-top: 17px solid #ddd;
                            }
                        </style>
                        <div id="material_null">
                                <p>Данные сессии, нужные для окончания регистрации, потеряны или никогда не существовали.
                                <br>Если вы попали на эту страницу по ссылке, пройдя первую стадию регистрации, то вы можете их возобновить.
                                <br>Просто введите те же E-mail и пароль.
                                </p>
                                <input id="repeat_reg_mail" type="text" /><br>
                                <input id="repeat_reg_pass" type="text" /><br>
                                <button id="repeat_reg_button">Возобновить!</button>
                        </div>
                        <script>
                            change_placeholder("#repeat_reg_mail","E-mail");
                            change_placeholder("#repeat_reg_pass","Пароль");
                            $("#repeat_reg_button").click(function(){
                                $.post("blocks/rn/repeat.php",{},function(repeat){
                                    if(repeat === "success") {
                                        success("Сессия возобновилась, проверьте свой E-mail.");
                                    }
                                    else {
                                        error(repeat);
                                    }
                                });
                            });
                        </script>'
        );
        array_push($arr,$res);
}
else {
        $res = array(
            'head' => '<div id="material_null">
                                <p>МАТЕРИАЛОВ НЕТ</p>
                            </div>'
        );
        array_push($arr,$res);
}
print json_encode($arr);