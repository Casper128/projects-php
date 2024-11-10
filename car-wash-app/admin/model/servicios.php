<?php
	class servicios{
		var $id;
		var $nombre;
		var $costo;

		function __construct($id ,$nombre ,$costo){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->costo=$costo;
		}
		function setId($id){
			$this->id=$id;
		}
		function getId(){
			return $this->id;
		}
		function setNombre($nombre){
			$this->nombre=$nombre;
		}
		function getNombre(){
			return $this->nombre;
		}
		function setCosto($costo){
			$this->costo=$costo;
		}
		function getCosto(){
			return $this->costo;
		}
	}
?>