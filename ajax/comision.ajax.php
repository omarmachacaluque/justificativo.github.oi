<?php

require_once "../controladores/comision.controlador.php";
require_once "../modelos/comision.modelo.php";

class Ajaxcomision{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idcomision;

	public function ajaxEditarcomision(){

		$item = "id";
		$valor = $this->idcomision;

		$respuesta = Controladorcomision::ctrMostrarcomision($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarcomision
	;
	public $activarId;


	public function ajaxActivarcomision(){

		$tabla = "comision";

		$item1 = "estado";
		$valor1 = $this->activarcomision;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = Modelocomision::mdlActualizarcomision($tabla, $item1, $valor1, $item2, $valor2);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idcomision"])){

	$editar = new Ajaxcomision();
	$editar -> idcomision = $_POST["idcomision"];
	$editar -> ajaxEditarcomision();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarcomision"])){

	$activarUsuario = new Ajaxcomision();
	$activarUsuario -> activarcomision = $_POST["activarcomision"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarcomision();

}
