<?php
//*******************************************************************
	//Funciones utilizadas en el modulo export.php
	
	function insert_resume($arr){
		if(sizeof($arr) == 8){
			include 'sql-open.php';
			$query = "INSERT INTO `analisis_condamb`(`idMedicionGlobal`, `idMedicion`, `idHospital`, `idArea`, `idParametro`, `promedio`, `magnitud`, `cumple`) 
						VALUES (".$arr['idg'].",".$arr['id'].",".$arr['idH'].",".$arr['idA'].",".$arr['idP'].",".$arr['pro'].",'".$arr['mag']."',".$arr['cumple'].");";
			$result = $con->query($query); 	
			include "sql-close.php";
		}
	}
	
	function parama_analisis($idg, $id, $idh, $ida, $tipo, $parametro, $estandar) {
		$array_resume = [];
		$array_resume["idg"] = $idg;
		$array_resume["id"] = $id;
		$array_resume["idH"] = $idh;
		$array_resume["idA"] = $ida;
		$array_resume["idP"] = $tipo;
		
		include 'sql-open.php';
		$sql = 'SELECT COALESCE(COUNT(`valor`),0) AS cuentatipo2
				FROM `variable` 
				WHERE `idMedicionGlobal` = '.$idg.' 
					AND `idMedicion` = '.$id.' 
					AND `tipo` = '.$tipo.';';
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
		$rowspan = $row["cuentatipo2"];

		if($rowspan > 0){
			//Contador de puntos
			$contP = 1;
			//Obteniendo AVG de valores
			$sql3 = 'SELECT  ROUND(AVG(`valor`),2) AS avgvalor
				FROM `variable` 
				WHERE `idMedicionGlobal` = '.$idg.' 
					AND `idMedicion` = '.$id.' 
					AND `tipo` = '.$tipo.';';
			$result = $con->query($sql3);
			$rowavg = $result->fetch_assoc();
			$avg = $rowavg["avgvalor"];
			//Obteniendo valores
			$sql2 = 'SELECT `valor` AS valor
				FROM `variable` 
				WHERE `idMedicionGlobal` = '.$idg.' 
					AND `idMedicion` = '.$id.' 
					AND `tipo` = '.$tipo.';';
			$result = $con->query($sql2);
			$rowvalor = $result->fetch_assoc();
			$valor = $rowvalor["valor"];
			//Verificando cumplimiento de estandar
			$cumplimiento = 0;
			$magnitud = "";
			switch ($tipo){
				case 2:	$magnitud = " Lux";
						if($avg<=600){
							$cumplimiento = 1;
						}
						break;
				case 4:	$magnitud = " Db";
						if($avg<=65){
							$cumplimiento = 1;
						}
						break;
				case 5:	$magnitud = " °C";
						if($avg>=22 && $avg<=26){
							$cumplimiento = 1;
						}
						break;
				case 6:	$magnitud = " %";
						if($avg>=30 && $avg<=60){
							$cumplimiento =1;
						}
						break;
			}
			
				
			$array_resume["pro"] = $avg;
			$array_resume["mag"] = $magnitud;
			$array_resume["cumple"] = $cumplimiento;
			
		}

		include 'sql-close.php';
		return $array_resume;
	}
	
	function paramelec_analisis($idg, $id, $idh, $ida){
		include 'sql-open.php';
		$sql = 'SELECT sv.polaridad, sv.vfaseneutro, sv.vneutrotierra, sv.vfasetierra
				FROM variable v, subvariable sv
				WHERE v.idVariable = sv.idVariable
					AND v.idVariableGlobal = sv.idVariableGlobal
					AND v.idMedicion = '.$id.'
					AND v.idMedicionGlobal = '.$idg.';';
			
		$result = $con->query($sql);
				
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				i_paramelec_analisis($idg, $id, $idh, $ida, $row["polaridad"], $row["vfaseneutro"], $row["vneutrotierra"], $row["vfasetierra"]);
			}
		}
		include 'sql-close.php';
	}
	
	function i_paramelec_analisis($idg, $id, $idh, $ida, $polaridad, $vfaseneutro, $vneutrotierra, $vfasetierra){
		include 'sql-open.php';
		$stmt = $con->prepare("INSERT INTO `analisis_recelec`(`idMedicionGlobal`, `idMedicion`, `idHospital`, `idArea`, `polaridad`, `vfaseneutro`, `vneutrotierra`, `vfasetierra`) 
		VALUES (?,?,?,?,?,?,?,?);");
		$stmt->bind_param("iiiidddd", $idg, $id, $idh, $ida, $polaridad, $vfaseneutro, $vneutrotierra, $vfasetierra);
		$stmt->execute();
		$stmt->close();
		include "sql-close.php";
	}
	//Funciones utilizadas en el modulo export.php
	//*******************************************************************
?>