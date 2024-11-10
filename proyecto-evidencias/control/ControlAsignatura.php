<?php
	class ControlAsignaturas{
		var $objAsignatura;
		function __construct($objAsignatura){
			$this->objAsignatura=$objAsignatura;
		}
		function guardar(){//Listo
			$idDigitado=$this->objAsignatura->getId();
			$nomDigitado=$this->objAsignatura->getNombre();
			$periodoDigitado=$this->objAsignatura->getPeriodo();
			$creditoDigitado=$this->objAsignatura->getCreditos();
			$hrsEstDigitado=$this->objAsignatura->getHrsEst();
			$programaDigitado=$this->objAsignatura->getPrograma();
			$comandoSql="INSERT INTO asignatura 
			VALUES ('".$idDigitado."','".$nomDigitado."','".$periodoDigitado."'
			,'".$creditoDigitado."','".$hrsEstDigitado."','".$programaDigitado."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){//Listo
			$idDigitado=$this->objAsignatura->getId();
			$nomDigitado=$this->objAsignatura->getNombre();
			$periodoDigitado=$this->objAsignatura->getPeriodo();
			$creditoDigitado=$this->objAsignatura->getCreditos();
			$hrsEstDigitado=$this->objAsignatura->getHrsEst();
			$programaDigitado=$this->objAsignatura->getPrograma();
			$comandoSql="UPDATE `asignatura` 
			SET `IDASIGNATURA`='".$idDigitado."'
			,`NOMBRE`='".$nomDigitado."'
			,`PERIODO`='".$periodoDigitado."'
			,`CREDITOS`='".$creditoDigitado."'
			,`HRSINDEPENDIENTE`='".$hrsEstDigitado."'
			,`FK_ID_PROGRAMA_ASIGNATURA`='".$programaDigitado."'
			where IDASIGNATURA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function borrar(){//Listo
			$idDigitado=$this->objAsignatura->getId();
			$comandoSql="delete from asignatura where IDASIGNATURA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){//Listo
			$idDigitado=$this->objAsignatura->getId();
			$nomDigitado="";
			$periodoDigitado="";
			$creditoDigitado="";
			$hrsEstDigitado="";
			$comandoSql="select * from asignatura where IDASIGNATURA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
			$nomDigitado=$row["NOMBRE"];
			$periodoDigitado=$row["PERIODO"];
			$creditoDigitado=$row["CREDITOS"];
			$hrsEstDigitado=$row["HRSINDEPENDIENTE"];
			$this->objAsignatura->setNombre($nomDigitado);
			$this->objAsignatura->setPERIODO($periodoDigitado);
			$this->objAsignatura->setCREDITOS($creditoDigitado);
			$this->objAsignatura->setIngreso($hrsEstDigitado);
			}
			return $this->objAsignatura;
			
		}
		function listar(){

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM asignatura";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['IDASIGNATURA'];
				$mat[$i][1]=  $registro['NOMBRE'];
				$mat[$i][2]=  $registro['PERIODO'];
				$mat[$i][3]=  $registro['CREDITOS'];
				$mat[$i][4]=  $registro['HRSINDEPENDIENTE'];
				$mat[$i][5]=  $registro['FK_ID_PROGRAMA_ASIGNATURA'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}	
	}

?>