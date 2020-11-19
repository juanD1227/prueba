<?php

if (isset($_POST['guardar'])) 
{
    $nombre = $_POST['nombre'];
	$email = $_POST['correo']; 
	$sexo = $_POST['sexo'];
	$area = $_POST['areas'];
    $descripcion = $_POST['descripcion'];
    $boletin= 0;
    if(isset($_POST['boletin'])){
        $boletin=$_POST['boletin'];
    }
    $rol1 = 0;
    if(isset($_POST['rol1'])){
        $boletin=$_POST['rol1'];
    }
    $rol2 = 0;
    if(isset($_POST['rol2'])){
        $boletin=$_POST['rol2'];
    }
    $rol3 = 0;
    if(isset($_POST['rol3'])){
        $boletin=$_POST['rol3'];
    }
    

	// if (empty($nombre) ||
	// 	empty($email) ||
	// 	empty($sexo) ||
	// 	empty($area) ||
	// 	empty($nacionalidad) ||
	// 	empty($telefono) ||
	// 	empty($direccion) ||
	// 	empty($tipo_identificacion) ||
	// 	empty($lugar_identificacion)) {//... pero si están vacíos los campos...

	// 	$mensaje = "¡Ningún campo puede quedar vacío!";//... muestra la alerta...
	// } else {//... de lo contrario haga el ingreso de los datos
		$consulta = new Consultas();// Creación automática de una nueva clase consulta
	    $consulta->insert($nombre, $email, $sexo, $area, $descripcion, $boletin, $rol);

	
}
?>