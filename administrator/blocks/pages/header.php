<?php

require_once '../../php/db_connect/db.php';

print ('<section id="information_list">
        	<table>
            	<tr>
                	<td>
                    	<p>Логин:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['login'].'</p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<p>Имя:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['first_name'].'</p>
                    </td>
                </tr>
                 <tr>
                	<td>
                    	<p>Фамилия:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['last_name'].'</p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<p>Email:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['email'].'</p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<p>Страна:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['country'].'</p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<p>Город:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['city'].'</p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<p>Адрес:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['address'].'</p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<p>Уровень доступа:</p>
                    </td>
                    <td>
                    	<p>'.$admin_information['access_level'].'</p>
                    </td>
                </tr>
            </table>
            </section>');
			
?>