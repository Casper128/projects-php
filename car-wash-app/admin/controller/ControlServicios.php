<?php
	class ControlServicios{
		var $objServicios;
		function __construct($objServicios){
			$this->objServicios=$objServicios;
		}
		function guardar(){
			$nombre=$this->objServicios->getNombre();
			$costo=$this->objServicios->getCosto();
			$comandoSql="INSERT INTO servicios (nombre,costo) VALUES('".$nombre."','".$costo."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}

		function modificar(){
			$id=$this->objServicios->getId();
			$nombre=$this->objServicios->getNombre();
			$costo=$this->objServicios->getCosto();
			$comandoSql="UPDATE servicios SET nombre='".$nombre."', costo='".$costo."' where id=".$id."";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			
		}

		function borrar(){
			$id=$this->objServicios->getId();
			$comandoSql="delete from servicios where id='".$id."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			
		}

		function listar(){
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM servicios";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				$mat[$i][0]=  $registro['id'];
				$mat[$i][1]=  $registro['nombre'];
				$mat[$i][2]=  $registro['costo'];
				$i=$i+1;
			}
			$objConexion->cerrarBd();
			return $mat;
		}
	}

?>