<?php
class clientes{
	var $id;
	var $nombre;
	var $telefono;
	var $usuario;
	var $password;
	var $admin;

	function __construct($usuario, $password, $nombre , $telefono) {
		$this->usuario = $usuario;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
	}

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getNombre(){
		return $this->nombre;
	}
	function setNombre($nombre){
		$this->nombre=$nombre;
	}
	function getPassword(){
		return $this->password;
	}
	function setPassword($password){
		$this->password=$password;
	}
	function getTelefono(){
		return $this->telefono;
	}
	function setTelefono($telefono){
		$this->telefono=$telefono;
	}
	function getUsuario(){
		return $this->usuario;
	}
	function setUsuario($usuario){
		$this->usuario=$usuario;
	}	
	function getAdmin(){
		return $this->admin;
	}
	function setAdmin($admin){
		$this->admin=$admin;
	}	
}
?>