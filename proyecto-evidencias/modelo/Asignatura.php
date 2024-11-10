<?php
	class Asignatura{
		var $id;
		var $nombre;
		var $periodo;
		var $creditos;
		var $hrsEst;
		var $Programa;
		
		function __construct($id,$nombre,$periodo,$creditos,$hrsEst,$Programa){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->periodo=$periodo;
			$this->creditos=$creditos;
			$this->hrsEst=$hrsEst;
			$this->Programa=$Programa;
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
		function setPeriodo($periodo){
			$this->periodo=$periodo;
		}
		function getPeriodo(){
			return $this->periodo;
		}
		function setCreditos($creditos){
			$this->creditos=$creditos;
		}
		function getCreditos(){
			return $this->creditos;
		}
		function setHrsEst($hrsEst){
			$this->hrsEst=$hrsEst;
		}
		function getHrsEst(){
			return $this->hrsEst;
		}
		function setPrograma($Programa){
			$this->Programa=$Programa;
		}
		function getPrograma(){
			return $this->Programa;
		}
	}

?>