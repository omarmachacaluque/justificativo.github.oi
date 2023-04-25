<?php

class ControladorComision{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearcomision(){

		if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoci"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevomotivo"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevocelular"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])&& 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevalugar"])){

			   	$tabla = "comision";

			   	$datos = array("nombre"=>$_POST["nuevoCliente"],
					           "ci"=>$_POST["nuevoci"],
					           "motivo"=>$_POST["nuevomotivo"],
					           "celular"=>$_POST["nuevocelular"],
					           "direccion"=>$_POST["nuevaDireccion"],
					           "lugar"=>$_POST["nuevalugar"],
					           "fechasol"=>$_POST["nuevafechasol"],
					           "dehora"=>$_POST["nuevadehora"],
					           "ahora"=>$_POST["nuevaahora"]);

			   	$respuesta = Modelocomision::mdlIngresarcomision($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La comision ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "comision";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La comision no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "comision";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarcomision($item, $valor){

		$tabla = "comision";

		$respuesta = Modelocomision::mdlMostrarcomision($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarcomision(){

		if(isset($_POST["editarcomision"])){

		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarcomision"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarci"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarmotivo"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarcelular"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editardireccion"])&& 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarlugar"])){

			   	$tabla = "comision";

			   	$datos = array("id"=>$_POST["idcomision"],
			   				   "nombre"=>$_POST["editarcomision"],
					           "ci"=>$_POST["editarci"],
					           "motivo"=>$_POST["editarmotivo"],
					           "celular"=>$_POST["editarcelular"],
					           "direccion"=>$_POST["editardireccion"],
					           "lugar"=>$_POST["editarlugar"],
					           "fechasol"=>$_POST["editarfechasol"],
					           "dehora"=>$_POST["editardehora"],
					           "ahora"=>$_POST["editarahora"]);

			   	$respuesta = Modelocomision::mdlEditarcomision($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La comision ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "comision";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La comision no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "comision";

							}
						})

			  	</script>';



			}

		}

	}
/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechascomision($fechaInicial, $fechaFinal){

		$tabla = "comision";

		$respuesta = Modelocomision::mdlRangoFechascomision($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "comision";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$comision = Modelocomision::mdlRangoFechascomision($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = Modelocomision::mdlMostrarcomision($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
		
			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CI</td>
					<td style='font-weight:bold; border:1px solid #eee;'>MOTIVO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CONTROL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DIRECCION</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>LUGAR</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td	
					<td style='font-weight:bold; border:1px solid #eee;'>DE HORA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>A HORA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA GENERADA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>		
					</tr>");

			foreach ($ventas as $row => $item){


			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["id"]."</td> 
			 			<td style='border:1px solid #eee;'>".$item["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["ci"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["motivo"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["celular"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["direccion"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["lugar"]."</td>
			 			");
		 		echo utf8_decode("</td>
		 			<td style='border:1px solid #eee;'>".substr($item["fechasol"],0,10)."</td>
					<td style='border:1px solid #eee;'>".substr($item["dehora"],0)."</td>
					<td style='border:1px solid #eee;'>".substr($item["ahora"],0)."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>	
					<td style='border:1px solid #eee;'>".substr($item["estado"],0)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarcomision(){

		if(isset($_GET["idcomision"])){

			$tabla ="comision";
			$datos = $_GET["idcomision"];

			$respuesta = Modelocomision::mdlEliminarcomision($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La comision ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "comision";

								}
							})

				</script>';

			}		

		}

	}

}

