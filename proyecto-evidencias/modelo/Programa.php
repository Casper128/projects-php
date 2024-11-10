<?php
	class Programa{
		var $id;
		var $Programa;
		var $NivelEducativo;
		var $FkPrograma;
		function __construct($id,$Programa,$NivelEducativo,$FkPrograma){
			$this->id=$id;
			$this->Programa=$Programa;
			$this->NivelEducativo=$NivelEducativo;
			$this->FkPrograma=$FkPrograma;
		}
		function setId($id){
			$this->id=$id;
		}
		function getId(){
			return $this->id;
		}
		function setPrograma($Programa){
			$this->Programa=$Programa;
		}
		function getPrograma(){
			return $this->Programa;
		}
		function setNivelEducativo($NivelEducativo){
			$this->NivelEducativo=$NivelEducativo;
		}
		function getNivelEducativo(){
			return $this->NivelEducativo;
		}
		
		function setFkPrograma($FkPrograma){
			$this->FkPrograma=$FkPrograma;
		}
		function getFkPrograma(){
			return $this->FkPrograma;
		}
	}
?>