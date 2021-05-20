<!DOCTYPE html>
<?php 
session_start();
if(isset($_SESSION['user'])){
	$username = $_SESSION['user'];
?>
<html lang="es">
	<head>
		<title>Nuevo Post</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='css/style.css'>
		<script src="js/ShowImageInForm.js"></script>
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
			<h1>Nuevo post</h1>
			<p>Se sugiere cargar una imagen en buena calidad.</p>
		</div>

		<center>
			<form id='carga' name='carga' action='db_carga.php' method="POST" enctype='multipart/form-data'>
				<table>
					<tr>
						<td>
							<input type="file" name="imgInp" id="imgInp" size="30" accept="image/*"  onchange="loadFile(event)" required/>
						</td>
						<td rowspan="12">
							<img id="output" src="" style="max-width:250px;margin-left:20px;"/>
						</td>
					</tr>
					<tr>
						<td>
							<textarea type="text" name="descripcion" id="descripcion" cols="54" rows="5" placeholder="Descripción" required></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="keyword_1" id="keyword_1" size="20" placeholder="Tag 1" required/><input type="text" name="keyword_2" id="keyword_2" size="20" placeholder="Tag 2" required/><input type="text" name="keyword_3" id="keyword_3" size="20" placeholder="Tag 3" required/>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="keyword_4" id="keyword_4" size="20" placeholder="Tag 4" required/><input type="text" name="keyword_5" id="keyword_5" size="20" placeholder="Tag 5" required/><input type="text" name="keyword_6" id="keyword_6" size="20" placeholder="Tag 6" required/>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="keyword_7" id="keyword_7" size="20" placeholder="Tag 7" required/><input type="text" name="keyword_8" id="keyword_8" size="20" placeholder="Tag 8" required/><input type="text" name="keyword_9" id="keyword_9" size="20" placeholder="Tag 9" required/>
						</td>
					</tr>
					<tr>
						<td rowspan=2><br/><br/><center><input type="submit" id="submit" value="Subir foto"/> &nbsp;&nbsp; <input type="reset" value="Borrar"/></center></td>
					</tr>
				</table>
			</form>
		</center>


		<div class="footer">
			<p>Hecho por @ldeniz</p>
		</div>

	</body>
</html>
					<?php 

} else {
	echo "<script>alert(\"Usuario no logueado\");document.location.href='login.php';</script>"; 
}
?>