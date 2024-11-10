<?php
	class Profesor{
		var $cedula;
		var $nombre;
		var $titulo;
		var $email;
		var $idVinculacion;
		function __construct($cedula,$nombre,$titulo,$email,$idVinculacion){
			$this->cedula=$cedula;
			$this->nombre=$nombre;
			$this->titulo=$titulo;
			$this->email=$email;
			$this->idVinculacion=$idVinculacion;;
		}
		function setCedula($cedula){
			$this->cedula=$cedula;
		}
		function getCedula(){
			return $this->cedula;
			
		}
		function setNombre($nombre){
			$this->nombre=$nombre;
		}
		function getNombre(){
			return $this->nombre;
		}
		function setTitulo($titulo){
			$this->titulo=$titulo;
		}
		function getTitulo(){
			return $this->titulo;
		}
		function setEmail($email){
			$this->email=$email;
		}
		function getEmail(){
			return $this->email;
		}
		
		function setIdVinculacion($idVinculacion){
			$this->idVinculacion=$idVinculacion;
		}
		function getIdVinculacion(){
			return $this->idVinculacion;
		}
	}

?>