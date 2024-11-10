<?php
	class ControlEvidencias{
		var $objEvidencias;
		function __construct($objEvidencias){
			$this->objEvidencias=$objEvidencias;
		}
		function guardar(){//Listo
			$idDigitado=$this->objEvidencias->getId();
			$tipEvDigitado=$this->objEvidencias->getTipoEvi();
			$EvDigitado=$this->objEvidencias->getEvidencias();
			$comandoSql="INSERT INTO `evidencia`
			(`IDEVIDENCIA`, `TIPOEVIDENCIA`, `EVIDENCIA`) 
			VALUES ('".$idDigitado."','".$tipEvDigitado."','".$EvDigitado."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){
			$idDigitado=$this->objEvidencias->getId();
			$tipEvDigitado=$this->objEvidencias->getTipoEvi();
			$EvDigitado=$this->objEvidencias->getEvidencias();
			$comandoSql="UPDATE evidencia set EVIDENCIA='".$EvDigitado."',
			TIPOEVIDENCIA='".$tipEvDigitado."', where IDEVIDENCIA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function borrar(){//Listo
			$idDigitado=$this->objEvidencias->getId();
			$comandoSql="delete from evidencia where IDEVIDENCIA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){
			$tipEvDigitado="";
			$EvDigitado="";
			$idDigitado=$this->objEvidencias->getId();
			$comandoSql="select * from evidencia where IDEVIDENCIA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
				$tipEvDigitado=$row["TIPOEVIDENCIA"];
				$EvDigitado=$row["EVIDENCIA"];
				$this->objEvidencias->setTipoEvi($tipEvDigitado);
				$this->objEvidencias->setEvidencias($EvDigitado);
			}
			return $this->objEvidencias;
		}
		function listar(){//Listo

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM evidencia INNER JOIN profesor_evidencias,estudiantes_evidencias 
			order by IDEVIDENCIA;";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['IDEVIDENCIA'];
				$mat[$i][1]=  $registro['TIPOEVIDENCIA'];
				$mat[$i][2]=  $registro['EVIDENCIA'];
				$mat[$i][3]=  $registro['FK_EVIDENCIA_ID_PROFESOR'];
				$mat[$i][4]=  $registro['FK_EVIDENCIAS_ID_ESTUDIANTE'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}
	}
	

?>