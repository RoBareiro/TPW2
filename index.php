<?php
	error_reporting(0);
	session_start();
	$conexion = mysqli_connect("localhost", "root", "", "revista") or die("No se puede seleccionar la base de datos.");
	$usuario= "";
	if(isset($_POST['enviar'])){
		$usuario = $_POST['user'];
		$pass = $_POST['pass'];
        $buscarUsuario= "SELECT * FROM cliente WHERE nombre='$usuario' && clave='md5($pass)'";
    	$usuarioEncontrado=mysqli_query($conexion, $buscarUsuario);
	 	if(mysqli_num_rows($usuarioEncontrado) == 1){

			$_SESSION['log']=true;
			$_SESSION['usuario']=$usuario;
			
			if ($_POST['recordar']){
				setcookie("user", $_POST['user'] , time()+(60*60*20),"/");
				setcookie("pass", $_POST['pass'] , time()+(60*60*20),"/");
			}
			else{
	  			setcookie("user","",time()-3600,"/");
	  			setcookie("pass","",time()-3600,"/");
	  		}

			header('location:Principal.php');
		}
	 	else { 
	 		if(empty($_POST['user']) && empty($_POST['pass'])){
				$mensaje=sprintf("<h3 style='color: red;'><b>Los campos no fueron ingresados.</b></h3>");
			}
			elseif(empty($_POST['user'])){
				$mensaje=sprintf("<h3 style='color: red;'><b>El usuario no fue ingresado.</b></h3>");
			}
			elseif (empty($_POST['pass'])) {
				$mensaje=sprintf("<h3 style='color: red;'><b>La contraseña no fue ingresada.</b></h3>");
			}
			else{
				$mensaje=sprintf("<h3 style='color: red;'><b>El usuario y/o la contraseña son incorrectos.</b></h3>");
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
		<title>ABCD revistas</title>
		<link href="css/custom.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery/jquery.js"></script>
		
	</head>
	<body class="container">
		<!-- BARRA DE NAVEGACION -->
	    <?php
	    	include 'includes/navbar.html';
	    ?>
		<!-- carrousel ppal -->
		<?php
	    	include 'includes/slidePpal.html';
	    ?>
		<!-- SEPARACION EN COLUMNAS -->
		<div class="row"> 
			<!-- PAGINACION PREGUNTAR COMO SE HACE BIEN -->
	        <div class="col-lg-9">
	        	<?php
	    			include 'includes/slideRevistas.html';
	    		?>
	        </div>

	        <div class="col-lg-3">
	        	<!-- FORMULARIO DE LOGIN -->
				<form class="form-horizontal" action="index.php" method="POST" id="login">
		        	<!-- MUESTRA EL MSJ DE ERROR EN EL FORM -->
		        	<?php if ($mensaje) { ?>
        				<div class="error">
            				<?php echo $mensaje ?>
					    </div>
					    <?php } ?>	
			        <div class="form-group">
			        	<h4>USUARIOS REGISTRADOS</h4>
					    <hr size="100%"></hr>
					    <label for="inputUsuario" class="control-label"><h4>Usuario:</h4></label>
			            <input type="text" name="user" class="form-control" id="inputUsuario" placeholder="Usuario" value="<?php if (isset($_COOKIE['user'])) echo $_COOKIE['user']; ?>">
			        </div>
			        <div class="form-group">
			            <label for="inputPassword" class="control-label"><h4>Contraseña:</h4></label>
			            <input type="password" name="pass" class="form-control" id="inputPassword" 
			            placeholder="Clave" value="<?php if (isset($_COOKIE['pass'])) echo $_COOKIE['pass']; ?>">
			        </div>
			        <div class="form-group">
			            <div class="checkbox">
			                <label><input type="checkbox">Recordarme</label>
			            </div>
			        </div>
			        <div class="form-group">
			            <a class="btn btn-default" href="registro.php">Registrarse</a>
			            <button type="submit" name="enviar" class="btn btn-primary">Ingresar</button>
			        </div>
				</form>
	        </div> 
		</div>
	
		<?php
			include 'includes/footer.html';
		?>
		
		
	</body>
</html>


