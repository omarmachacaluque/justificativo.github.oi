<?php

require_once "../controladores/salida.controlador.php";
require_once "../modelos/salida.modelo.php";

class Ajaxsalida{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idsalida;

	public function ajaxEditarsalida(){

		$item = "id";
		$valor = $this->idsalida;

		$respuesta = Controladorsalida::ctrMostrarsalida($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarsalida
	;
	public $activarId;


	public function ajaxActivarsalida(){

		$tabla = "salida";

		$item1 = "estado";
		$valor1 = $this->activarsalida;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = Modelosalida::mdlActualizarsalida($tabla, $item1, $valor1, $item2, $valor2);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idsalida"])){

	$editar = new Ajaxsalida();
	$editar -> idsalida = $_POST["idsalida"];
	$editar -> ajaxEditarsalida();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarsalida"])){

	$activarUsuario = new Ajaxsalida();
	$activarUsuario -> activarsalida = $_POST["activarsalida"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarsalida();

}
