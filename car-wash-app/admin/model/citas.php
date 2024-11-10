<?php
	class citas{
		var $id;
		var $cliente_id;
		var $servicio_id;
		var $hora;
		var $fecha_hora;
		function __construct($id,$cliente_id,$servicio_id,$hora,$fecha_hora){
			$this->id=$id;
			$this->cliente_id=$cliente_id;
			$this->servicio_id=$servicio_id;
			$this->hora=$hora;
			$this->fecha_hora=$fecha_hora;
		}
		function setId($id){
			$this->id=$id;
		}
		function getId(){
			return $this->id;
		}
		function setClienteId($cliente_id){
			$this->cliente_id=$cliente_id;
		}
		function getClienteId(){
			return $this->cliente_id;
		}
		function setServicioId($servicio_id){
			$this->servicio_id=$servicio_id;
		}
		function getServicioId(){
			return $this->servicio_id;
		}
		function setHora($hora){
			$this->hora=$hora;
		}
		function getHora(){
			return $this->hora;
		}
		function setFechaHora($fecha_hora){
			$this->fecha_hora=$fecha_hora;
		}
		function getFechaHora(){
			return $this->fecha_hora;
		}
	}

?>