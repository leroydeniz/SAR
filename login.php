<!DOCTYPE html>
<?php 
session_start();
if(isset($_SESSION['user'])){
	echo "<script language=\"javascript\">alert(\"Usuario ya logueado.\");document.location.href='perfil.php';</script>";
}
?>
<html lang="es">
	<head>
		<title>Identificarse</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='css/style.css'>
		<script src='js/jquery-3.4.1.min.js'></script>
		<script src='js/menu.js'></script>
		<meta name='author' content='Leroy Deniz' />
	</head>

	<body>

		<?php 
			IF(ISSET($_SESSION['user'])){
				include("base/menu-usuario.html"); 
			} else {
				include("base/menu-invitado.html");
			}
		?>


		<div class="header">	
			<h1>Identificarse</h1>
		</div>


		<div class="forms">
				<i class="fa fa-child" style="font-size:80px;"></i>
				<br/><br/>
			
				<form id="login" method="POST">
					<input type="text" id="inputUser" name="user" placeholder="Usuario" size="40" required/>
					<br/><br/>
					<input type="password" id="inputPassword" name="pass" placeholder="Contraseña" size="40" required/>
					<br/><br/>
					<button type="submit" name="login" >Ingresar</button>
				</form>
		</div>

		<div class="footer">
			<p>Hecho por @ldeniz</p>
		</div>

	</body>
</html>


<?php
	#Incluyo el archivo de conexión a la base de datos, dos niveles por encima del index
	include "connect_sar.php";

	#Función de conexión con la base de datos
	$mysqli = mysqli_connect($server,$user,$pass,$db) or die ("Error de conexión con la base de datos.");
	if(!$mysqli) {
		die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/<img src='img/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
	}

	IF(ISSET($_POST['login'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		#Usa la base de datos como utf8
		mysqli_set_charset($mysqli, 'utf8');
		
		$sql = "SELECT count(*) AS number FROM users WHERE usuario='".$user."' AND password='".$pass."'";
		$result = mysqli_query($mysqli,$sql);
		$num = mysqli_fetch_array($result);
		if ($num['number'] == 1) {
			session_start();
			/*Traigo la información de la última conexión*/
			$sql = "SELECT * FROM users WHERE usuario='".$user."' AND password='".$pass."'";
			$result = mysqli_query($mysqli,$sql);
			$datos = mysqli_fetch_array($result);
			$_SESSION['user'] = $user;
			$_SESSION['ultimo_acceso'] = $datos['ultimo_acceso'];
			
			/*Actualizo la fecha de última conexión*/
			$sql = "UPDATE users SET ultimo_acceso=NOW() WHERE usuario='".$user."'";
			mysqli_query($mysqli,$sql);
			
			echo "<script language=\"javascript\">alert(\"Bienvenido $user \");document.location.href='perfil.php';</script>";
		}else{
			echo "<script language=\"javascript\">alert(\"Usuario o contraseña incorrecto\");document.location.href='login.php';</script>";
		}
	}
?>