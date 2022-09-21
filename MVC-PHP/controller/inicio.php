<?php
require_once("../db/connection.php");
session_start();
if($_POST["inicio"]){
	// inicia sesion para los usuarios
	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];
	
	
	/// consultamos el usuario segun el usuario y la clave
	$con="select * from persona where idpersona = '$usuario' and password = '$clave'"; 	
	$query=mysqli_query($mysqli, $con);
	$fila=mysqli_fetch_assoc($query);
	
	if($fila){		
		/// si el usario y la clave son correctas, creamo las sessiones 
			
		$_SESSION['id_user'] = $fila['idpersona']; 
		$_SESSION['nombres'] = $fila['nombres']; 
		$_SESSION['nombres'] = $fila['apellidos']; 
		$_SESSION['tipo'] = $fila['idtipousua'];
		$_SESSION['usuario'] = $fila['idpersona'];
		
				/// dependiendo del tipo de usuario lo redireccinamos a una pagina
		/// si es un administrador
		if($_SESSION['tipo'] == 1){
			header("Location: ../model/admin/index.php"); 
			exit();
		}
		/// si es un veterinario
		elseif($_SESSION['tipo'] == 2){
			header("Location: ../model/veterinario/index.php"); 
			exit();		
		}
		/// si es un propietario
		if($_SESSION['tipo'] == 3){
			header("Location: ../model/propietario/index.php"); 
			exit();
		}
		
		
		
	}else{
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inio y se muestra un mensaje
		header("Location: ../errorlog.html"); 
		exit();
	}
	
}	
?>