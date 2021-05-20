<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Últimos posts</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='css/style.css'>
		<script src='js/jquery-3.4.1.min.js'></script>
		<script src='js/menu.js'></script>
		<meta name='author' content='Leroy Deniz' />
	</head>

	<body>

		<?php 
		session_start();
		IF(ISSET($_SESSION['user'])){
			include("base/menu-usuario.html"); 
		} else {
			include("base/menu-invitado.html");
		}
		?> 
		<!-- Header -->
		<div class="header">
			<h1>Últimos posts</h1>
			<p>Esta app simula una red social para compartir fotos</p>
		</div>

		<!-- Photo Grid -->
		<div class="row"> 
			<?php 
			#Archivo con datos de conexión
			include 'connect_sar.php';

			#Usar la base de datos con datos utf8
			mysqli_set_charset($mysqli, 'utf8');
			
			#Conexión a la base de datos
			$mysqli = mysqli_connect($server,$user,$pass,$db);

			#Verifica la conexión
			if(!$mysqli) {
				die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><img src='img/not.png' class='img-wall' '><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
			} else {
				echo "<div class='row'>";
				#Selecciona los datos a mostrar, hasta un máximo de 30 imágenes
				$sql = "SELECT usuario,descripcion,cuando,imagen FROM posts order by cuando DESC LIMIT 40;";
				$resultado = mysqli_query ($mysqli,$sql);

				while( $row = mysqli_fetch_array( $resultado)){
					echo "<div class='column'><img alt='".$row['descripcion']."' src='data:image;base64,".$row['imagen']."'></div>";
				}

				//Cierro la conexión
				mysqli_close($mysqli);

				echo"</div>";
			}

			?>

		</div>

		<div class="footer">
			<p>Hecho por @ldeniz</p>
		</div>

	</body>
</html>