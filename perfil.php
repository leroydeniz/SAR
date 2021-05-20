<!DOCTYPE html>
<?php 
session_start();
if(isset($_SESSION['user'])){
	$username = $_SESSION['user'];
	$ultimo_acceso = $_SESSION['ultimo_acceso'];
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='css/style.css'>
    	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<script src='js/jquery-3.4.1.min.js'></script>
		<script src='js/menu.js'></script>
		<meta name='author' content='Leroy Deniz' />
		<title>Perfil</title>
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
			<h1>Perfil de @<?php echo $username;?></h1>
			<p>(último acceso: <?php echo $ultimo_acceso;?>)</p>
		</div>


		<div class="row"> 
			<?php 
				#Archivo con datos de conexión
				include 'connect_sar.php';

				#Conexión a la base de datos
				$mysqli = mysqli_connect($server,$user,$pass,$db);
	
				#Usa la base de datos en utf8
				mysqli_set_charset($mysqli, 'utf8');

				#Verifica la conexión
				if(!$mysqli) {
					die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><img src='img/not.png' class='img-wall'/><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
				} else {
					echo "<div class='row'>";
					#Selecciona los datos a mostrar, hasta un máximo de 30 imágenes
					$sql = "SELECT usuario,descripcion,cuando,imagen FROM posts WHERE usuario = '".$username."' order by cuando DESC;";
					$resultado = mysqli_query ($mysqli,$sql);

					while( $row = mysqli_fetch_array( $resultado)){
						echo "<div class='column'><img alt='".$row['descripcion']."' src='data:image;base64,".$row['imagen']."'/></div>";
					}
					echo"</div>";

					//Cierro la conexión
					mysqli_close($mysqli);

					
				}

			?>

		</div>

		<div class="footer">
			<p>Hecho por @ldeniz</p>
		</div>

	</body>
</html>
<?php
	} else {
		echo "<script>alert('Usuario no logueado');document.location.href='login.php';</script>"; 
	}
?>


