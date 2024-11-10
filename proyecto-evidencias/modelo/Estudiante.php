<?php
	class Estudiante{
		var $cedula;
		var $nombre;
		var $estrato;
		var $icfes;
		var $ingreso;
		var $email;
		function __construct($cedula,$nombre,$estrato,$icfes,$ingreso,$email){
			$this->cedula=$cedula;
			$this->nombre=$nombre;
			$this->estrato=$estrato;
			$this->icfes=$icfes;
			$this->ingreso=$ingreso;
			$this->email=$email;
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
		function setEstrato($estrato){
			$this->estrato=$estrato;
		}
		function getEstrato(){
			return $this->estrato;
		}
		function setIcfes($icfes){
			$this->icfes=$icfes;
		}
		function getIcfes(){
			return $this->icfes;
		}
		function setIngreso($ingreso){
			$this->ingreso=$ingreso;
		}
		function getIngreso(){
			return $this->ingreso;
		}
		function setEmail($email){
			$this->email=$email;
		}
		function getEmail(){
			return $this->email;
		}
	}

?>