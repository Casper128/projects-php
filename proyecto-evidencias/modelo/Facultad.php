<?php
	class Facultad{
		var $id;
		var $facultades;
		function __construct($id,$facultades){
			$this->id=$id;
			$this->facultades=$facultades;
		}
		function setId($id){
			$this->id=$id;
		}
		function getId(){
			return $this->id;
			
		}
		function setFacultades($facultades){
			$this->facultades=$facultades;
		}
		function getFacultades(){
			return $this->facultades;
		}
	}
?>