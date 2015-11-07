<!DOCTYPE html>
	<html>
		<head>
        
			<meta charset="utf-8" />
			<link href="css/main.css" type="text/css" rel="stylesheet">
			<title>Главная - Панель администратора</title>

		</head>

		<body>
        
        <div id="all">
        <noscript><p style="color:#F30;">Для корректной работы сайта нужен JavaScript</p></noscript>
            <div id="login">
            <form action="php/login/admin_login.php" method="post">
            <table>
            	<tr>
                	<td>
                    	<p>Логин:</p>
                    </td>
                    <td>
                    	<input type="text" name="admin_login"/>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<p>Пароль:</p>
                    </td>
                    <td>
                    	<input type="password" name="admin_password"/>
                    </td>
                </tr>
               	<tr>
                	<td>
                    </td>
                    <td>
                    	<button>Войти</button>
                    </td>
               </tr>
            </table>
            </form>
            </div>
            
        </div>    
            
		</body>
        
	</html>