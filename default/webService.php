<?php
	//json desde cliente
	$equipoString = isset($_POST["jsondata"]) ? $_POST["jsondata"] : "[]";
	$jsonEquipo = json_decode($equipoString, true);
	
	//para responder a cliente: 
	$response = array();
	$updatedRow = array();
	
	include 'sql-open.php';
	
	if(isset($_POST["tabla"]) && $_POST["tabla"] == 'equipo'){
		foreach($jsonEquipo as $row) { 
			$idEquipo = $row['idEquipo'] != 'null' ? $row['idEquipo'] : "NULL";

			$marca = isset($row['marca']) ? $row['marca'] : "NULL";
			$modelo = isset($row['modelo']) ? $row['modelo'] : "NULL";
			$serie = isset($row['serie']) ? $row['serie'] : "NULL";
			$fechaCalibracion = isset($row['fechaCalibracion']) ? "'".date('Y-m-d', strtotime(str_replace('-', '/', $row['fechaCalibracion'])))."'" : "NULL";
			$numeroInventario = isset($row['numeroInventario']) ? $row['numeroInventario'] : "NULL";
			$sql = "INSERT INTO equipo (idEquipo, marca, modelo, serie, fechaCalibracion, numeroInventario)
				VALUES ($idEquipo, '$marca', '$modelo','$serie',$fechaCalibracion,'$numeroInventario')";

			if ($con->query($sql) === TRUE) {
				$updatedRow['table'] = 'equipo';
				$updatedRow['id'] = $idEquipo;
				$updatedRow['global'] = "".mysqli_insert_id($con);
				array_push($response, $updatedRow);
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
		include 'sql-close.php';
		echo json_encode($response);
	}
	elseif (isset($_POST["tabla"]) && $_POST["tabla"] == 'accesorio'){
		foreach($jsonEquipo as $row) { 
			$idAccesorio = $row['idAccesorio'];
			$accesorio = isset($row['accesorio']) ? $row['accesorio'] : "NULL";
			$idEquipo = isset($row['idEquipo']) ? $row['idEquipo'] : "NULL";
			
			$sql = "INSERT INTO accesorio (idAccesorio, accesorio, idEquipo) VALUES ($idAccesorio, '$accesorio', '$idEquipo');";

			if ($con->query($sql) === TRUE) {
				$updatedRow['table'] = 'accesorio';
				$updatedRow['id'] = $idAccesorio;
				$updatedRow['global'] = "".mysqli_insert_id($con);
				array_push($response, $updatedRow);
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
		include 'sql-close.php';
		echo json_encode($response);
	}
	elseif(isset($_POST["tabla"]) && $_POST["tabla"] == 'mxe'){
		foreach($jsonEquipo as $row) { 
			$idmxe = $row['idmxe'];
			$idMedicion = isset($row['idMedicion']) ? $row['idMedicion'] : "NULL";
			$idEquipo = isset($row['idEquipo']) ? $row['idEquipo'] : "NULL";
			
			$sql = "INSERT INTO mxe (idmxe, idMedicion, idEquipo) VALUES ($idmxe, '$idMedicion', '$idEquipo');";

			if ($con->query($sql) === TRUE) {
				$updatedRow['table'] = 'mxe';
				$updatedRow['id'] = $idmxe;
				$updatedRow['global'] = "".mysqli_insert_id($con);
				array_push($response, $updatedRow);
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
		include 'sql-close.php';
		echo json_encode($response);
	}
	elseif(isset($_POST["tabla"]) && $_POST["tabla"] == 'medicion'){
		foreach($jsonEquipo as $row) { 
			$idMedicion = $row['idMedicion'];
			$servicioAnalizado = isset($row['servicioAnalizado']) ? $row['servicioAnalizado'] : "NULL";
			$responsable = isset($row['responsable']) ? $row['responsable'] : "NULL";
			$telefono = isset($row['telefono']) ? $row['telefono'] : "NULL";
			$idArea = isset($row['idArea']) ? $row['idArea'] : "NULL";
			$idUsuario = isset($row['idUsuario']) ? $row['idUsuario'] : "NULL";
			$fecha = isset($row['fecha']) ? "'".date('Y-m-d', strtotime(str_replace('-', '/', $row['fecha'])))."'" : "NULL";
			$comentario = isset($row['comentario']) ? $row['comentario'] : "NULL";
			
			$sql = "INSERT INTO medicion (idMedicion, servicioAnalizado, responsable, telefono, idArea, idUsuario, fecha, comentario) 
			VALUES ($idMedicion, '$servicioAnalizado', '$responsable', '$telefono', $idArea, $idUsuario, $fecha, '$comentario');";

			if ($con->query($sql) === TRUE) {
				$updatedRow['table'] = 'medicion';
				$updatedRow['id'] = $idMedicion;
				$updatedRow['global'] = "".mysqli_insert_id($con);
				array_push($response, $updatedRow);
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
		include 'sql-close.php';
		echo json_encode($response);
	}	
	elseif(isset($_POST["tabla"]) && $_POST["tabla"] == 'variable'){
		foreach($jsonEquipo as $row) { 
			$idVariable = $row['idVariable'];
			$idMedicion = isset($row['idMedicion']) ? $row['idMedicion'] : "NULL";
			$valor = isset($row['valor']) ? $row['valor'] : "NULL";
			$tipo = isset($row['tipo']) ? $row['tipo'] : "NULL";
			$cumple = isset($row['cumple']) ? $row['cumple'] : "NULL";

			$sql = "INSERT INTO variable (idVariable, idMedicion, valor, tipo, cumple) 
			VALUES ($idVariable, $idMedicion, $valor, $tipo, $cumple);";

			if ($con->query($sql) === TRUE) {
				$updatedRow['table'] = 'variable';
				$updatedRow['id'] = $idVariable;
				$updatedRow['global'] = "".mysqli_insert_id($con);
				array_push($response, $updatedRow);
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
		include 'sql-close.php';
		echo json_encode($response);
	}
	elseif(isset($_POST["tabla"]) && $_POST["tabla"] == 'subvariable'){
		foreach($jsonEquipo as $row) { 
			$idSubVariable = $row['idSubVariable'];
			$idVariable = isset($row['idVariable']) ? $row['idVariable'] : "NULL";
			$polaridad = isset($row['polaridad']) ? $row['polaridad'] : "NULL";
			$vfaseneutro = isset($row['vfaseneutro']) ? $row['vfaseneutro'] : "NULL";
			$vneutrotierra = isset($row['vneutrotierra']) ? $row['vneutrotierra'] : "NULL";
			$vfasetierra = isset($row['vfasetierra']) ? $row['vfasetierra'] : "NULL";


			$sql = "INSERT INTO subvariable (idSubVariable, idVariable, polaridad, vfaseneutro, vneutrotierra, vfasetierra) 
			VALUES ($idSubVariable, $idVariable, $polaridad, $vfaseneutro, $vneutrotierra,$vfasetierra);";

			if ($con->query($sql) === TRUE) {
				$updatedRow['table'] = 'subvariable';
				$updatedRow['id'] = $idSubVariable;
				$updatedRow['global'] = "".mysqli_insert_id($con);
				array_push($response, $updatedRow);
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
		include 'sql-close.php';
		echo json_encode($response);
	}	
	else{
		echo "else de webservice";
	}
?>