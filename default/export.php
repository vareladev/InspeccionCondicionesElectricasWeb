<?php
	include 'export-sql.php';
	//exportando resumen de analisis ambiental
	//obteniendo idlocal y global de cada medicion
	include 'sql-open.php';
																			
	$sql = 'SELECT h.idHospital, a.idArea, m.idMedicionGlobal,m.idMedicion
			FROM medicion m, area a, hospital h, usuario u, variable v
			WHERE m.idArea = a.idArea 
				AND a.idHospital = h.idHospital 
				AND m.idUsuario = u.idUsuario 
				AND m.idMedicionGlobal = v.idMedicionGlobal
				AND m.idMedicion = v.idMedicion
				AND (v.tipo = 2 OR v.tipo = 4 OR v.tipo = 5 OR v.tipo = 6)
			GROUP BY m.idMedicionGlobal,m.idMedicion
			ORDER BY m.fecha2 ASC';

	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$idg = $row["idMedicionGlobal"];
			$id = $row["idMedicion"];
			$idHospital = $row["idHospital"];
			$idArea = $row["idArea"];
			//verificando si la medicion no existe en la tabla analisis_condamb
			$sql2 = 'SELECT idMedicionGlobal FROM analisis_condamb
			WHERE idMedicionGlobal = '.$idg.'
				AND idMedicion ='.$id.';';
			$result2 = $con->query($sql2);
			
			if ($result2->num_rows == 0) { //la medicion  no ha sido exportada				
				$arr1 = parama_analisis($idg, $id, $idHospital, $idArea, 2, "Iluminación ambiental", "600 Lux (máximo)");
				insert_resume($arr1);
				$arr1 = parama_analisis($idg, $id, $idHospital, $idArea, 4, "Ruido ambiental", "65 dB (Máximo)");
				insert_resume($arr1);
				$arr1 = parama_analisis($idg, $id, $idHospital, $idArea, 5, "Temperatura ambiental", "de 22°C a 26°C");
				insert_resume($arr1);
				$arr1 = parama_analisis($idg, $id, $idHospital, $idArea, 6, "Humedad relativa", "de 30 % a 60%");
				insert_resume($arr1);
			}
		}
	}
	include 'sql-close.php';	
	
	//exportando resumen de analisis de receptaculos electricos
	//obteniendo idlocal y global de cada medicion realizada
	include 'sql-open.php';																		
	$sql = 'SELECT h.idHospital, a.idArea, m.idMedicionGlobal,m.idMedicion
			FROM medicion m, area a, hospital h, usuario u, variable v
			WHERE m.idArea = a.idArea 
				AND a.idHospital = h.idHospital 
				AND m.idUsuario = u.idUsuario 
				AND m.idMedicionGlobal = v.idMedicionGlobal
				AND m.idMedicion = v.idMedicion
				AND v.tipo = 1
			GROUP BY m.idMedicionGlobal,m.idMedicion
			ORDER BY m.fecha2 ASC';
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$idg = $row["idMedicionGlobal"];
			$id = $row["idMedicion"];
			$idHospital = $row["idHospital"];
			$idArea = $row["idArea"];
			//verificando si la medicion no existe en la tabla analisis_recelec
			$sql2 = 'SELECT idMedicionGlobal FROM analisis_recelec
			WHERE idMedicionGlobal = '.$idg.'
				AND idMedicion ='.$id.';';
			$result2 = $con->query($sql2);
			
			if ($result2->num_rows == 0) { //la medicion  no ha sido exportada				
				paramelec_analisis($idg, $id, $idHospital, $idArea);
			}
		}
	}
	include 'sql-close.php';	
	
	header('Location: reporte.php');
?>