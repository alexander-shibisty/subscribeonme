<?php

require_once '../../../php/db_connect/db.php';

	$str_games = 20;

	$query_str_base_games = mysql_query("SELECT COUNT(*) FROM games");

	$result_str_base_games = mysql_fetch_row($query_str_base_games);

	$result_str_base_games = $result_str_base_games[0];
	
	$pages = ceil($result_str_base_games / $str_games);
	
		if ($pages_get < 1) {
			
			$pages_get = 1;
			
		}
		
		elseif ($pages_get > $pages) {
		
			$pages_get = $pages;
		
		}

	$query_base_games = mysql_query("SELECT * FROM games ORDER BY id DESC LIMIT 0,20");

print ('<section id="table"><div id="add_form">
			<form>
				<input />
				<button onClick="return false">Добавить</button>
			</form>
			<div id="add_list"></div>
		</div>
		<table>
            	<tr class="list_1">
                	<td>
                    Название
                    </td>
                    <td>
                    Платформы
                    </td>
                    <td>
                    Релиз
                    </td>
                    <td>
                    Жанр
                    </td>
                    <td>
                    Разработчики
                    </td>
                    <td>
                    Издатели
                    </td>
                    <td>
                    Оценка П.
                    </td>
                    <td>
                    Оценка S.
                    </td>
                    <td>
                    Требования
                    </td>
                    <td>
                    Описание
                    </td>
                    <td>
                    Картинка
                    </td>
                    <td>
                    Действия
                    </td>
                </tr>');
				
				$counter= 0;

while ($result_base_games = mysql_fetch_array($query_base_games)) {
	
	++$counter;
	
	$counter_e = $counter%2;
	
	if($counter_e === 0) {
	
		$counter_r = 'class="list_1"';
	
	}
	
	else {
	
		$counter_r = 'class="list_2"';
	
	}
	
	print ('<tr '.$counter_r.'">
                	<td>
                    '.$result_base_games['title'].'
                    </td>
                    <td>
                    '.$result_base_games['platform'].'
                    </td>
                    <td>
                    '.$result_base_games['date'].'
                    </td>
                    <td>
                    '.$result_base_games['ganre'].'
                    </td>
                    <td>
                    '.$result_base_games['developer'].'
                    </td>
                    <td>
                    '.$result_base_games['publisher'].'
                    </td>
                    <td>
                    '.$result_base_games['rating'].'
                    </td>
                    <td>
                    '.$result_base_games['rating_som'].'
                    </td>
                    <td>
                    '.$result_base_games['requirements'].'
                    </td>
                    <td>
                    '.$result_base_games['text'].'
                    </td>
                    <td>
                    '.$result_base_games['images'].'
                    </td>
                    <td>
                    Удалить|Редактировать
                    </td>
                </tr>');

}

print('</table>
	<nav id="str"><button>1</button></nav></section>');

?>

