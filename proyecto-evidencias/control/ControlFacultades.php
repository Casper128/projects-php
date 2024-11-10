<?php
	class ControlFacultades{
		var $objFacultad;
		function __construct($objFacultad){
			$this->objFacultad=$objFacultad;
		}
		function guardar(){
			$idDigitado=$this->objFacultad->getId();
			$facDigitado=$this->objFacultad->getFacultades();
			$comandoSql="INSERT INTO facultad VALUES('".$idDigitado."','".$facDigitado."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){
			$idDigitado=$this->objFacultad->getId();
			$facDigitado=$this->objFacultad->getFacultades();
			$comandoSql="UPDATE facultad set FACULTAD='".$facDigitado."' where IDFACULTAD='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function borrar(){
			$idDigitado=$this->objFacultad->getId();
			$comandoSql="delete from facultad where IDFACULTAD='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){
			$facDigitado="";
			$idDigitado=$this->objFacultad->getId();
			$comandoSql="select * from facultad where IDFACULTAD='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
				$facDigitado=$row["FACULTAD"];
				$this->objFacultad->setfacultades($facDigitado);
			}
			return $this->objFacultad;
		}
		function listar(){

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM facultad";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['IDFACULTAD'];
				$mat[$i][1]=  $registro['FACULTAD'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}
	}

?>