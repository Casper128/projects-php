<?php
include("../control/configBd.php");
class ControlUsuarios{
	var $objUsuarios;
	function __construct($objUsuarios){
			$this->objUsuarios=$objUsuarios;
	}
	function validarUsuario(){
			$esvalido=false;
			$usuDigitado=$this->objUsuarios->getNomUsuario();
			$conDigitada=$this->objUsuarios->getContrasena();
			
			$comandoSql="select * from usuarios where Usuario='".$usuDigitado."' and contrasena='".$conDigitada."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd("localhost", "root", "","sisevid");
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
				$usuConsultado=$row["Usuario"];
				$conConsultada=$row["contrasena"];
				$this->objUsuarios->setNivelAcceso($row["NivelAcceso"]);
				if($usuConsultado==$usuDigitado && $conConsultada==$conDigitada && $usuDigitado != null && $conDigitada !=null &&$usuDigitado != "" && $conDigitada !="" ){
					$esvalido=true;
				}
				else{
					$esvalido=false;
				}
			}
			return $this->objUsuarios;
	}	
		function guardar(){
			$idDigitado=$this->objUsuarios->getId();
			$usuDigitado=$this->objUsuarios->getNomUsuario();
			$passDigitado=$this->objUsuarios->getContrasena();
			$nivAccesDigitado=$this->objUsuarios->getNivelAcceso();
			$comandoSql="INSERT INTO usuarios VALUES('".$idDigitado."','".$usuDigitado."','".$passDigitado."'
			,'".$nivAccesDigitado."')";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd('localhost','root','','sisevid');
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}
		function modificar(){
			$idDigitado=$this->objUsuarios->getId();
			$usuDigitado=$this->objUsuarios->getNomUsuario();
			$passDigitado=$this->objUsuarios->getContrasena();
			$nivAccesDigitado=$this->objUsuarios->getNivelAcceso();
			$comandoSql="UPDATE `usuarios`
			SET `IDUSUARIO`='.$idDigitado.',`Usuario`='".$usuDigitado."'
			,`contrasena`='".$passDigitado."'
			,`NivelAcceso`='".$nivAccesDigitado."' where `IDUSUARIO`='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd('localhost','root','','sisevid');
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function borrar(){
			$idDigitado=$this->objUsuarios->getId();
			$comandoSql="delete from usuarios where IDUSUARIO='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd('localhost','root','','sisevid');
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();			

		}
		function consultar(){
			$nivAccesoDigitado="";
			$passDigitado="";
			$usuDigitado="";
			$idDigitado=$this->objUsuarios->getId();
			$comandoSql="select * from usuarios where IDUSUARIO='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd('localhost','root','','sisevid');
			$recordSet=$objControlConexion->ejecutarSelect($comandoSql);
			if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
				$idDigitado=$row["IDUSUARIO"];
				$usuDigitado=$row["Usuario"];
				$passDigitado=$row["contrasena"];
				$nivAccesoDigitado=$row["NivelAcceso"];
				$this->objUsuarios->setId($idDigitado);
				$this->objUsuarios->setNomUsuario($usuDigitado);
				$this->objUsuarios->setContrasena($passDigitado);
				$this->objUsuarios->setNivelAcceso($nivAccesoDigitado);
			}
			return $this->objUsuarios;
		}
		function listar(){

			$objConexion = new ControlConexion();
			$objConexion->abrirBd('localhost','root','','sisevid');
			$comandoSql="SELECT * FROM usuarios";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				
				$mat[$i][0]=  $registro['IDUSUARIO'];
				$mat[$i][1]=  $registro['Usuario'];
				$mat[$i][2]=  $registro['contrasena'];
				$mat[$i][3]=  $registro['NivelAcceso'];
				$i=$i+1;
			}		
	
			$objConexion->cerrarBd();
			return $mat;
		}	
	}

?>
