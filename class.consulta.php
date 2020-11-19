<?php 

require_once('class.conexion.php');

class Consultas
{
        //Inserción de un nuevo Empleado
            public function insert($nombre, $email, $sexo, $area, $descripcion, $boletin, $roles){
                $modelo = new Conexion();
                $conexion = $modelo->get_Conexion();
                try{
                    $sql = "INSERT INTO `empleados` (`nombre`, `email`, `sexo`, `area_id`,`boletin`,`descripcion`) VALUES (:nombre, :email, :sexo, :area_id, :boletin, :descripcion)";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bindParam(':nombre', $nombre);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':sexo', $sexo);
                    $stmt->bindParam(':area_id', $area);
                    $stmt->bindParam(':boletin', $boletin);
                    $stmt->bindParam(':descripcion', $descripcion);
                    $stmt->execute();
                }
                catch (Exception $e){
                    return $e->getMessage();
                }
                            
                $sql2 = "SELECT * FROM `user` WHERE `usuario` = :usuario ";
                $stmt2 = $conexion->prepare($sql2);
                $stmt2->bindParam(':usuario', $usuario);
                $stmt2->execute();
                while ($select = $stmt2->fetch()) {
                    $user = $select;
                }
                $id = $user['id'];
                
                try{
                    $sql3 = "INSERT INTO `persona` (`id_user`, `n_identificacion`, `nombres`, `apellidos`) VALUES (:idUser, :identificacion, :nombre, :apellido)";
                    $stmt3 = $conexion->prepare($sql3);
                    $stmt3->bindParam(':idUser', $id);
                    $stmt3->bindParam(':identificacion', $identificacion);
                    $stmt3->bindParam(':nombre', $nombre);
                    $stmt3->bindParam(':apellido', $apellido);
                    $stmt3->execute();
                    return true;
                }
                catch (Exception $e){
                    return $e->getMessage();
                }
            }
        //Select que valida los datos para Loggeo y visualización de datos de Usuario
            public function select_login_usuario($usuario){
                $user = null;
                $modelo = new Conexion();
                $conexion = $modelo->get_conexion();
                $sql = "SELECT * FROM user WHERE usuario = :usuario";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->execute();
                while ($select = $stmt->fetch()) {
                    $user = $select;
                }
                return $user;
            }
        //Select para listar la tabla de los usuarios (No muestra información del Admin)
            public function select_lista_usuarios(){
                $user = null;
                $modelo = new Conexion();
                $conexion = $modelo->get_conexion();
                //$sql = "SELECT * FROM user WHERE rol <> 'admin'";
                $sql = "SELECT * FROM user INNER JOIN persona ON user.id = persona.id_user WHERE user.rol <> 'admin' ORDER BY user.id";
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                while ($select = $stmt->fetch()) {
                    $user[] = $select;
                }
                return $user;
            }
        //Select para la busqueda
            public function select_filtro_tabla($busqueda){
                $modelo = new Conexion();
                $conexion = $modelo->get_Conexion();
                $statement = $conexion->prepare(
                    "SELECT * FROM user 
                    INNER JOIN persona ON user.id = persona.id_user 
                    WHERE user.rol <> 'admin' 
                    AND nombres LIKE :busqueda 
                    or apellidos LIKE :busqueda 
                    or n_identificacion LIKE :busqueda 
                    or usuario LIKE :busqueda 
                    or email LIKE :busqueda 
                    or rol LIKE :busqueda"
                );
                /*$statement=$conexion->prepare(
                    "SELECT * FROM user INNER JOIN persona ON user.id = persona.id_user WHERE usuario LIKE :busqueda or email LIKE :busqueda or rol LIKE :busqueda AND rol <> 'admin'"
                );*/
                $statement->execute(array(':busqueda'=> "%$busqueda%"));
                $resultado = $statement->fetchAll();
                return $resultado;
            }
        }

?>