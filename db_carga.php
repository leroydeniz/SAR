<?php 
session_start();
IF(ISSET($_SESSION['user'])){
	
		error_reporting(0);
		include 'connect_sar.php';

		//Usuarion prefijado
		$usuarioapp = $_SESSION['user'];

			if(isset($_POST['descripcion'])){
				$descripcion = $_POST['descripcion'];
			}
			if(isset($_POST['keyword_1'])){
				$keyword_1 = $_POST['keyword_1'];
			}
			if(isset($_POST['keyword_2'])){
				$keyword_2 = $_POST['keyword_2'];
			}
			if(isset($_POST['keyword_3'])){
				$keyword_3 = $_POST['keyword_3'];
			}
			if(isset($_POST['keyword_4'])){
				$keyword_4 = $_POST['keyword_4'];
			}
			if(isset($_POST['keyword_5'])){
				$keyword_5 = $_POST['keyword_5'];
			}
			if(isset($_POST['keyword_6'])){
				$keyword_6 = $_POST['keyword_6'];
			}
			if(isset($_POST['keyword_7'])){
				$keyword_7 = $_POST['keyword_7'];
			}
			if(isset($_POST['keyword_8'])){
				$keyword_8 = $_POST['keyword_8'];
			}
			if(isset($_POST['keyword_9'])){
				$keyword_9 = $_POST['keyword_9'];
			}

			if($_FILES!=null && $_POST!=null){
				$file = $_FILES["imgInp"]["tmp_name"];   

				if(!isset($file)){
					echo "Please upload an image";
				}else{
					$imgInp = file_get_contents(addslashes($_FILES['imgInp']['tmp_name']));

					$image_size = getimagesize($_FILES['imgInp']['tmp_name']);

					if($image_size==FALSE){
						echo "No se ha seleccionado una imagen.";
					} else {
						$image = base64_encode($imgInp);
					}
				}
			}

			//ABRO LA CONEXIÓN
			$mysqli = mysqli_connect ($server, $user, $pass, $db);
			if (!$mysqli) {
				die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><h3>Será redirigido al banco de preguntas en 5 segundos</h3><br/><br/><img src='imgs/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
			} else {
				
				//guardo la información en la base de datos con formato utf8
				mysqli_set_charset($mysqli, 'utf8');
				
				$sql = "INSERT INTO posts (descripcion, keyword_1, keyword_2, keyword_3, keyword_4, keyword_5, keyword_6, keyword_7, keyword_8, keyword_9, usuario, imagen, cuando) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW());";

				//verifico la conexión y la estructura inicial de la sentencia 
				if($stmt = mysqli_prepare($mysqli,$sql)){

					//Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
					mysqli_stmt_bind_param($stmt, "ssssssssssss", $descripcion, $keyword_1, $keyword_2, $keyword_3, $keyword_4, $keyword_5, $keyword_6, $keyword_7, $keyword_8, $keyword_9, $usuarioapp, $image);
					mysqli_stmt_execute($stmt);
					// CIERRO LA CONEXIÓN
					mysqli_close($mysqli);
					header("location:perfil.php");
					
				}
			}

} else {
    echo "<script language=\"javascript\">alert(\"Usuario no logueado\");document.location.href='login.php';</script>"; 
}
?>