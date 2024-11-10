<?php
	class ControlProgramas{
		var $objPrograma;
		function __construct($objPrograma){
			$this->objPrograma=$objPrograma;
		}
		function guardar(){
			$idDigitado=$this->objPrograma->getId();
			$proDigitado=$this->objPrograma->getPrograma();
			$nivEduDigitado=$this->objPrograma->getNivelEducativo();
			$FkProgramaDigitado=$this->objPrograma->getFkPrograma();
			$comandoSql="INSERT INTO programa VALUES('".$idDigitado."','".$proDigitado."','".$nivEduDigitado."'
			,'".$FkProgramaDigitado."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){
			$idDigitado=$this->objPrograma->getId();
			$proDigitado=$this->objPrograma->getPrograma();
			$nivEduDigitado=$this->objPrograma->getNivelEducativo();
			$FkProgramaDigitado=$this->objPrograma->getFkPrograma();
			$comandoSql="UPDATE `programa`
			SET `IDPROGRAMA`='".$idDigitado."',`PROGRAMA`='".$proDigitado."'
			,`NIVELEDUCATIVO`='".$nivEduDigitado."'
			,`FK_ID_FACULTAD_PROGRAMA`='".$FkProgramaDigitado."' where `IDPROGRAMA`='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function borrar(){
			$idDigitado=$this->objPrograma->getId();
			$comandoSql="delete from programa where IDPROGRAMA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){
			$nivEduDigitado="";
			$proDigitado="";
			$idDigitado=$this->objPrograma->getId();
			$comandoSql="select * from programa where IDPROGRAMA='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
				$proDigitado=$row["PROGRAMA"];
				$nivEduDigitado=$row["NIVELEDUCATIVO"];
				$this->objPrograma->setPrograma($proDigitado);
				$this->objPrograma->setNivelEducativo($nivEduDigitado);
			}
			return $this->objPrograma;
		}
		function listar(){

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql="SELECT * FROM programa";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['IDPROGRAMA'];
				$mat[$i][1]=  $registro['PROGRAMA'];
				$mat[$i][2]=  $registro['NIVELEDUCATIVO'];
				$mat[$i][3]=  $registro['FK_ID_FACULTAD_PROGRAMA'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}	
	}

?>