<?php 
	
	class Conexion{
		public function get_conexion(){
			$host = "localhost";
			$user = "root";
			$pw = null;
			$db = "empleado";
			$link = "mysql:host=$host; dbname=$db";

			try {
                $con = new PDO($link, $user, $pw);
                //echo ('true');
                return $con;
			} catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}
	}
    
    // $obj = new Conexion();
    // $obj->get_conexion();
 ?>