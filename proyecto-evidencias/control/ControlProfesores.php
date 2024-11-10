<?php
	class ControlProfesores{
		var $objProfesor;
		function __construct($objProfesor){
			$this->objProfesor=$objProfesor;
		}
		function guardar(){//Listo
			$idDigitado=$this->objProfesor->getCedula();
			$nomDigitado=$this->objProfesor->getNombre();
			$tituDigitado=$this->objProfesor->getTitulo();
			$emailDigitado=$this->objProfesor->getEmail();
			$idVincuDigitado=$this->objProfesor->getIdVinculacion();
			$comandoSql="INSERT INTO `profesor`
			(`CEDULA`, `NOMBRE`, `TITULO`,`EMAIL`,`Vinculacion_idProfesor`) 
			VALUES ('".$idDigitado."','".$nomDigitado."','".$tituDigitado."'
			,'".$emailDigitado."','".$idVincuDigitado."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){//Listo
			$idDigitado=$this->objProfesor->getCedula();
			$nomDigitado=$this->objProfesor->getNombre();
			$tituDigitado=$this->objProfesor->getTitulo();
			$emailDigitado=$this->objProfesor->getEmail();
			$idVincuDigitado=$this->objProfesor->getIdVinculacion();
			$comandoSql="UPDATE `profesor` 
			SET `CEDULA`='".$idDigitado."'
			,`NOMBRE`='".$nomDigitado."'
			,`TITULO`='".$tituDigitado."'
			,`EMAIL`='".$emailDigitado."'
			,`VINCULACION_IDPROFESOR`='".$idVincuDigitado."' WHERE `CEDULA`='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function borrar(){//Listo
			$idDigitado=$this->objProfesor->getCedula();
			$comandoSql="delete from profesor where CEDULA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){//Listo
			$idDigitado=$this->objProfesor->getCedula();
			$nomDigitado="";
			$tituDigitado="";
			$emailDigitado="";
			$comandoSql="select * from profesor where CEDULA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
			$nomDigitado=$row["NOMBRE"];
			$tituDigitado=$row["TITULO"];
			$emailDigitado=$row["EMAIL"];
			$idVincuDigitado=$row["VINCULACION_IDPROFESOR "];
			$this->objProfesor->setNombre($nomDigitado);
			$this->objProfesor->setTitulo($tituDigitado);
			$this->objProfesor->setEmail($emailDigitado);
			$this->objProfesor->setIdVinculacion($idVincuDigitado);
			}
			return $this->objProfesor;
			
		}
		function listar(){

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM profesor";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['CEDULA'];
				$mat[$i][1]=  $registro['NOMBRE'];
				$mat[$i][2]=  $registro['TITULO'];
				$mat[$i][3]=  $registro['EMAIL'];
				$mat[$i][4]=  $registro['VINCULACION_IDPROFESOR'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}
	}

?>