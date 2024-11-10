<?php

	class ControlCitas{
		var $objEvidencias;
		function __construct($objEvidencias){
			$this->objEvidencias=$objEvidencias;
		}
		// function guardar(){//Listo
		// 	$clienteDigitado=$this->objEvidencias->getClienteId();
		// 	$serviciosDigitado=$this->objEvidencias->getServicioId();
		// 	$horaDigitado=$this->objEvidencias->getHora();
		// 	$fechaEvDigitado=$this->objEvidencias->getFechaHora();
		// 	$objControlConexion=new ControlConexion();
		// 	$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
		// 	foreach($serviciosDigitado as $servicio){
		// 		$comandoSql="INSERT INTO `citas` ( `cliente_id`, `servicio_id`, `hora`, `fecha_hora`) 
		// 		VALUES ('".$clienteDigitado."','".$servicio."','".$horaDigitado."','".$fechaEvDigitado."')";
		// 		$objControlConexion->ejecutarComandoSql($comandoSql);
		// 	}
		// 	$objControlConexion->cerrarBd();
		// }


		function guardar()
{
    $clienteDigitado = $this->objEvidencias->getClienteId();
    $serviciosDigitado = $this->objEvidencias->getServicioId();
    $horaDigitado = $this->objEvidencias->getHora();
    $fechaEvDigitado = $this->objEvidencias->getFechaHora();
    $objControlConexion = new ControlConexion();
    $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat']);

    // Verificar si la hora está ocupada para el día especificado
    $comandoSqlVerificar = "SELECT COUNT(*) AS numCitas FROM citas WHERE fecha_hora = '$fechaEvDigitado' AND hora = '$horaDigitado'";
    $resultadoVerificar = $objControlConexion->ejecutarSelect($comandoSqlVerificar);
    $filaVerificar = $resultadoVerificar->fetch_assoc();
    $numCitas = $filaVerificar['numCitas'];

    if ($numCitas > 0) {
        $_SESSION["error"] = true;
    } else {
        // Insertar las citas en la base de datos
        foreach ($serviciosDigitado as $servicio) {
            $comandoSql = "INSERT INTO `citas` (`cliente_id`, `servicio_id`, `hora`, `fecha_hora`) 
				VALUES ('" . $clienteDigitado . "','" . $servicio . "','" . $horaDigitado . "','" . $fechaEvDigitado . "')";
            $objControlConexion->ejecutarComandoSql($comandoSql);
        }
        $_SESSION["error"] = false;
    }


    $objControlConexion->cerrarBd();
}

		function borrar(){//Listo
			$idDigitado=$this->objEvidencias->getId();
			$comandoSql="delete from citas where id='".$idDigitado."'";
			$objControlConexion=new ControlConexion();
			$objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$objControlConexion->ejecutarComandoSql($comandoSql);
			$objControlConexion->cerrarBd();
		}

		function listar($cliente,$rolUser){//Listo
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
			$comandoSql = "SELECT citas.id as citas, fecha_hora, hora, clientes.nombre as nombre_cliente, servicios.nombre as nombre_servicio, servicios.costo
			FROM `citas`
			INNER JOIN clientes ON citas.cliente_id = clientes.id
			INNER JOIN servicios ON servicios.id = citas.servicio_id";
			if ($rolUser != 1) {
				$comandoSql .= " WHERE cliente_id = $cliente";
			}
			$comandoSql .= " ORDER BY fecha_hora DESC";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$i=0;
			$mat=null;
			while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)){
				$mat[$i][0]=  $registro['fecha_hora'];
				$mat[$i][1]=  $registro['hora'];
				$mat[$i][2]=  $registro['nombre_cliente'];
				$mat[$i][3]=  $registro['nombre_servicio'];
				$mat[$i][4]=  $registro['costo'];
				$mat[$i][5]=  $registro['citas'];
				$i=$i+1;
			}
			$objConexion->cerrarBd();
			return $mat;
		}
	}
	

?>