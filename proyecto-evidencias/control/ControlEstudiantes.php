<?php
	class ControlEstudiantes{
		var $objEstudiante;
		function __construct($objEstudiante){
			$this->objEstudiante=$objEstudiante;
		}
		function guardar(){//Listo
			$idDigitado=$this->objEstudiante->getCedula();
			$nomDigitado=$this->objEstudiante->getNombre();
			$estDigitado=$this->objEstudiante->getEstrato();
			$icfesDigitado=$this->objEstudiante->getIcfes();
			$ingreDigitado=$this->objEstudiante->getIngreso();
			$emailDigitado=$this->objEstudiante->getEmail();
			$comandoSql="INSERT INTO estudiante VALUES('".$idDigitado."','".$nomDigitado."','".$estDigitado."'
			,'".$icfesDigitado."','".$ingreDigitado."','".$emailDigitado."',' ')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){//Listo
			$idDigitado=$this->objEstudiante->getCedula();
			$nomDigitado=$this->objEstudiante->getNombre();
			$estDigitado=$this->objEstudiante->getEstrato();
			$icfesDigitado=$this->objEstudiante->getIcfes();
			$ingreDigitado=$this->objEstudiante->getIngreso();
			$emailDigitado=$this->objEstudiante->getEmail();
			$comandoSql="UPDATE `estudiante` 
			SET `CEDULA`='".$idDigitado."'
			,`NOMBRE`='".$nomDigitado."'
			,`ESTRATO`='".$estDigitado."'
			,`ICFES`='".$icfesDigitado."'
			,`FECHAINGRESO`='".$ingreDigitado."'
			,`EMAIL`='".$emailDigitado."'
			,`Asignatura_idAsignatura`=' ' where CEDULA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function borrar(){//Listo
			$idDigitado=$this->objEstudiante->getCedula();
			$comandoSql="delete from estudiante where CEDULA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){//Listo
			$idDigitado=$this->objEstudiante->getCedula();
			$nomDigitado="";
			$estDigitado="";
			$icfesDigitado="";
			$ingreDigitado="";
			$emailDigitado="";
			$comandoSql="select * from estudiante where CEDULA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
			$nomDigitado=$row["NOMBRE"];
			$estDigitado=$row["ESTRATO"];
			$icfesDigitado=$row["ICFES"];
			$ingreDigitado=$row["FECHAINGRESO"];
			$emailDigitado=$row["EMAIL"];
			$this->objEstudiante->setNombre($nomDigitado);
			$this->objEstudiante->setEstrato($estDigitado);
			$this->objEstudiante->setIcfes($icfesDigitado);
			$this->objEstudiante->setIngreso($ingreDigitado);
			$this->objEstudiante->setEmail($emailDigitado);
			}
			return $this->objEstudiante;
			
		}
		function listar(){

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM estudiante";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['CEDULA'];
				$mat[$i][1]=  $registro['NOMBRE'];
				$mat[$i][2]=  $registro['ESTRATO'];
				$mat[$i][3]=  $registro['ICFES'];
				$mat[$i][4]=  $registro['FECHAINGRESO'];
				$mat[$i][5]=  $registro['EMAIL'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}	
	}

?>