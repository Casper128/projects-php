<?php
	class ControlVinculaciones{
		var $objVinculacion;
		function __construct($objVinculacion){
			$this->objVinculacion=$objVinculacion;
		}
		function guardar(){
			$idDigitado=$this->objVinculacion->getId();
			$vinDigitado=$this->objVinculacion->getVinculaciones();
			$comandoSql="INSERT INTO vinculacion VALUES('".$idDigitado."','".$vinDigitado."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){
			$idDigitado=$this->objVinculacion->getId();
			$vinDigitado=$this->objVinculacion->getVinculaciones();
			$comandoSql="UPDATE vinculacion set VINCULACION='".$vinDigitado."' where IDVINCULACION='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function borrar(){
			$idDigitado=$this->objVinculacion->getId();
			$comandoSql="delete from vinculacion where IDVINCULACION='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){
			$vinDigitado="";
			$idDigitado=$this->objVinculacion->getId();
			$comandoSql="select * from vinculacion where IDVINCULACION='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
				$vinDigitado=$row["VINCULACION"];
				$this->objVinculacion->setVinculaciones($vinDigitado);
			}
			return $this->objVinculacion;
		}
		function listar(){

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM vinculacion";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['IDVINCULACION'];
				$mat[$i][1]=  $registro['VINCULACION'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}	
	}

?>