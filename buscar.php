<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<title>Últimos posts</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<link rel='stylesheet' href='css/style.css'/>
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

		<div class="header">
			<h1>Buscar</h1>
			<p>Busca a través de los tags que se introducen junto a cada foto.</p>
			<form name="buscar" action="buscar.php" method="POST">
					<input name="patron" placeholder="Ingrese patrón de búsqueda y presione enter" size="40"/>
			</form>
		</div>


	<?php 
	#Archivo con datos de conexión
	include 'connect_sar.php';

	#Conexión a la base de datos
	$mysqli = mysqli_connect($server,$user,$pass,$db);

	#Verifica la conexión
	if(!$mysqli) {
		die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><img src='img/not.png' class='img-wall' /><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
	} else {

		if(isset($_POST['patron'])) {

			mysqli_set_charset($mysqli, 'utf8');

			$patron = $_POST['patron'];
			#Selecciona los datos a mostrar, hasta un máximo de 30 imágenes
			$sql = "SELECT * FROM posts WHERE keyword_1 LIKE '%$patron%' OR keyword_2 LIKE '%$patron%' OR keyword_3 LIKE '%$patron%' OR keyword_4 LIKE '%$patron%' OR keyword_5 LIKE '%$patron%' OR keyword_6 LIKE '%$patron%' OR keyword_7 LIKE '%$patron%' OR keyword_8 LIKE '%$patron%' OR keyword_9 LIKE '%$patron%' OR descripcion LIKE '%$patron%' order by cuando;";
			$resultado = mysqli_query ($mysqli,$sql);

			echo "<div class='row'>";

			while( $row = mysqli_fetch_array($resultado)){
				echo "<div class='column'><img alt='".$row['descripcion']."' src='data:image;base64,".$row['imagen']."'/></div>";
			}
			echo"</div>";
		}

		//Cierro la conexión
		mysqli_close($mysqli);
		
	}

	?>


	<div class="footer">
		<p>Hecho por @ldeniz</p>
	</div>

	</body>
</html>