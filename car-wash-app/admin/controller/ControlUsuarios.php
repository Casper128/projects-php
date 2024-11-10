<?php
include("configBd.php");
class ControlUsuarios{
	var $objUsuarios;
	function __construct($objUsuarios){
			$this->objUsuarios=$objUsuarios;
	}

	function validarUsuario(){
		$esvalido = false;
		$usuDigitado = $this->objUsuarios->getUsuario();
		$conDigitada = $this->objUsuarios->getPassword();
		$comandoSql = "SELECT * FROM clientes where usuario='".$usuDigitado."' and password='".$conDigitada."'";
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$i=0;
		$mat=null;
		if($colum = $recordSet->fetch_array(MYSQLI_BOTH)){
			while (count($colum)> $i){
				$mat[0]=  $colum['id'];
				$mat[1]=  $colum['usuario'];
				$mat[2]=  $colum['admin'];
				$mat[3]=  $colum['nombre'];
				$i=$i+1;
			}
		}
		$objConexion->cerrarBd();
		return $mat;
	}
	
		function guardar(){
			$usuarioDigitado=$this->objUsuarios->getUsuario();
			$nombreDigitado=$this->objUsuarios->getNombre();
			$passwordDigitado=$this->objUsuarios->getPassword();
			$telefonoDigitado=$this->objUsuarios->getTelefono();
			$comandoSql="INSERT INTO clientes (usuario,nombre,password,telefono,admin)
			VALUES('".$usuarioDigitado."','".$nombreDigitado."','".$passwordDigitado."'
			,'".$telefonoDigitado."', 0	)";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
			return true;
		}


		function modificarClave(){
			$usuarioDigitado = $this->objUsuarios->getUsuario();
			$nuevaClaveDigitada = $this->objUsuarios->getPassword();
			
			// Verificar si el usuario existe
			$existeUsuario = $this->verificarUsuarioExistente($usuarioDigitado);
			
			if (!$existeUsuario) {
				return false; // El usuario no existe, no se puede modificar la contraseña
			}else{

			}
			// Modificar la contraseña del usuario existente
			$comandoSql = "UPDATE clientes SET password = '".$nuevaClaveDigitada."' WHERE usuario = '".$usuarioDigitado."'";
			$objControlConexion = new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
			return true;
			
		}
		
		function verificarUsuarioExistente($usuario){
			$comandoSql = "SELECT COUNT(*) AS count FROM clientes WHERE usuario = '".$usuario."'";
			$objControlConexion = new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat']);
			$resultado = $objControlConexion->ejecutarSelect($comandoSql);
			$objControlConexion->cerrarBd();
			$fila = $resultado->fetch_array(MYSQLI_BOTH);
			$count = $fila['count'];
			return ($count > 0);
		}
	}

?>
