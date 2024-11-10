<?php
	class Vinculacion{
		var $id;
		var $vinculaciones;
		function __construct($id,$vinculaciones){
			$this->id=$id;
			$this->vinculaciones=$vinculaciones;
		}
		function setId($id){
			$this->id=$id;
		}
		function getId(){
			return $this->id;
			
		}
		function setVinculaciones($vinculaciones){
			$this->vinculaciones=$vinculaciones;
		}
		function getVinculaciones(){
			return $this->vinculaciones;
		}
	}
?>