<!DOCTYPE html>
<?php 
	session_start();
	if(isset($_SESSION['user'])){
		echo "<script language=\"javascript\">alert(\"Usuario ya logueado.\");document.location.href='perfil.php';</script>";
	}
?>
<html lang="es">
	<head>
		<title>Registrarse</title>
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
			<h1>Registrarse</h1>
		</div>

		<div class="forms">
			
				<i class="fa fa-child" style="font-size:80px;"></i>
				<br/><br/>

				<form id="register"  method="POST">
					<input type="text" id="inputUser" name="user" placeholder="Usuario" size="40" required/>
					<br/><br/>
					<input type="password" id="inputPassword" name="pass" placeholder="Contraseña" size="40" required/>
					<br/><br/>
					<input type="email" id="inputEmail" name="email" placeholder="Email" size="40" required/>
					<br/><br/>
					<button type="submit" name="register" >Ingresar</button>
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
	die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/<img src='img/not.png' style='max-width:200px;'/><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
}

#Uso la base de datos en utf8
mysqli_set_charset($mysqli, 'utf8');

IF(ISSET($_POST['register'])){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];

	# Verifico que el nombre de usuario no esté en uso
	$sql = "SELECT count(*) AS number FROM users WHERE usuario='".$user."';";
	$result = mysqli_query($mysqli,$sql);
	$num = mysqli_fetch_array($result);
	if ($num['number'] == 0) {

		# Como el nombre de usuario está libre, lo ingreso en la base de datos
		$sql = "INSERT INTO users(usuario,password,email,fecha_registro, ultimo_acceso) VALUES('$user','$pass','$email',NOW(),NOW());";
		mysqli_query($mysqli,$sql);

		# recupero los datos para mostrar lo que estaba en la base de datos
		$sql = "SELECT * FROM users WHERE usuario='$user';";
		$result = mysqli_query($mysqli,$sql);
		$datos = mysqli_fetch_array($result);

		# Creo la sesión
		session_start();
		$_SESSION['user'] = $user;
		$_SESSION['ultimo_acceso'] = $datos['ultimo_acceso'];

		echo "<script language=\"javascript\">alert(\"Bienvenido $user \");document.location.href='perfil.php';</script>";
	}else{
		echo "<script language=\"javascript\">alert(\"El nombre de usuario ya existe\");</script>";
	}
}
?>