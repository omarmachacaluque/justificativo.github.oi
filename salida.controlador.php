<?php

class ControladorSalida{

/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearsalida(){

		if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoci"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevocelular"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])){

			   	$tabla = "salida";

			   	$datos = array("nombre"=>$_POST["nuevoCliente"],
					           "ci"=>$_POST["nuevoci"],
					           "celular"=>$_POST["nuevocelular"],
					           "direccion"=>$_POST["nuevaDireccion"],
					           "fechasol"=>$_POST["nuevafechasol"],
					           "dehora"=>$_POST["nuevadehora"],
					           "ahora"=>$_POST["nuevaahora"]);

			   	$respuesta = Modelosalida::mdlIngresarsalida($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La salida particular ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "salida";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La salida particular no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "salida";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarsalida($item, $valor){

		$tabla = "salida";

		$respuesta = Modelosalida::mdlMostrarsalida($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarsalida(){

		if(isset($_POST["editarsalida"])){

		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarsalida"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarci"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarcelular"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editardireccion"])){

			   	$tabla = "salida";

			   	$datos = array("id"=>$_POST["idsalida"],
			   				   "nombre"=>$_POST["editarsalida"],
					           "ci"=>$_POST["editarci"],
					           "celular"=>$_POST["editarcelular"],
					           "direccion"=>$_POST["editardireccion"],
					           "fechasol"=>$_POST["editarfechasol"],
					           "dehora"=>$_POST["editardehora"],
					           "ahora"=>$_POST["editarahora"]);

			   	$respuesta = Modelosalida::mdlEditarsalida($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La salida particular ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "salida";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La salida particular no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "salida";

							}
						})

			  	</script>';



			}

		}

	}
/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechassalida($fechaInicial, $fechaFinal){

		$tabla = "salida";

		$respuesta = Modelosalida::mdlRangoFechassalida($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReportes(){

		if(isset($_GET["reporte"])){

			$tabla = "salida";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$salida = Modelosalida::mdlRangoFechassalida($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = Modelosalida::mdlMostrarsalida($tabla, $item, $valor);

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
					<td style='font-weight:bold; border:1px solid #eee;'>CONTROL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DIRECCION</td>		
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
			 			<td style='border:1px solid #eee;'>".$item["celular"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["direccion"]."</td>
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

	static public function ctrEliminarsalida(){

		if(isset($_GET["idsalida"])){

			$tabla ="salida";
			$datos = $_GET["idsalida"];

			$respuesta = Modelosalida::mdlEliminarsalida($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La salidaparticular ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "salida";

								}
							})

				</script>';

			}		

		}

	}

}