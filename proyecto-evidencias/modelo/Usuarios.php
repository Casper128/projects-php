<?php
class Usuarios{
	var $id;
	var $nomUsuario;
	var $contrasena;
	var $nivelAcceso;
	var $bandera;

	function __deafult(){
	}

	function __construct($id,$nomUsuario,$contrasena,$nivelAcceso){
		$this->id=$id;
		$this->nomUsuario=$nomUsuario;
		$this->contrasena=$contrasena;
		$this->nivelAcceso=$nivelAcceso;
	}
	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getNomUsuario(){
		return $this->nomUsuario;
	}
	function setNomUsuario($nomUsuario){
		$this->nomUsuario=$nomUsuario;
	}
	function getContrasena(){
		return $this->contrasena;
	}
	function setContrasena($contrasena){
		$this->contrasena=$contrasena;
	}
	function getNivelAcceso(){
		return $this->nivelAcceso;
	}
	function setNivelAcceso($nivelAcceso){
		$this->nivelAcceso=$nivelAcceso;
	}
	function getBandera(){
		return $this->bandera;
	}
	function setBandera($bandera){
		$this->bandera=$bandera;
	}	

}
?>