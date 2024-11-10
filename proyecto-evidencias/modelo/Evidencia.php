<?php
	class Evidencia{
		var $id;
		var $TipoEvi;
		var $Evidencias;

		function __construct($id,$TipoEvi,$Evidencias){
			$this->id=$id;
			$this->TipoEvi=$TipoEvi;
			$this->Evidencias=$Evidencias;
		}
		function setId($id){
			$this->id=$id;
		}
		function getId(){
			return $this->id;
			
		}
		function setTipoEvi($TipoEvi){
			$this->TipoEvi=$TipoEvi;
		}
		function getTipoEvi(){
			return $this->TipoEvi;
			
		}
		function setEvidencias($Evidencias){
			$this->Evidencias=$Evidencias;
		}
		function getEvidencias(){
			return $this->Evidencias;
		}
	}
?>