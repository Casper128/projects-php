<?php
	class horarios{
		var $id;
		var $dia_semana;
		var $hora_inicio;
		var $hora_fin;

		function __construct($id,$dia_semana,$hora_inicio,$hora_fin){
			$this->id=$id;
			$this->dia_semana=$dia_semana;
			$this->hora_inicio=$hora_inicio;
			$this->hora_fin=$hora_fin;
		}
		function setId($id){
			$this->id=$id;
		}
		function getId(){
			return $this->id;
		}
		function setDiaSemana($dia_semana){
			$this->dia_semana=$dia_semana;
		}
		function getDiaSemana(){
			return $this->dia_semana;
		}
		function setHoraInicio($hora_inicio){
			$this->hora_inicio=$hora_inicio;
		}
		function getHoraInicio(){
			return $this->HoraInicio;
		}
		function setHoraFin($hora_fin){
			$this->hora_fin=$hora_fin;
		}
		function getHoraFin(){
			return $this->hora_fin;
		}
	}
?>