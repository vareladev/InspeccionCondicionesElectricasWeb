<?php
	/*
	$tipo, $parametro
		2-iluminacion ambiental
		4-ruido ambiental
		5-temperatura ambiental
		6-humedad relativa ambiental
	$idg = id medicion global
	$id = id medicion
	$estandar = definición de estándar
	
	
	*/
	function paramelecreport($idg, $id){
		$rcontador = 1;
		include 'sql-open.php';
		$sql = 'SELECT 
				CASE
				WHEN sv.polaridad = 1 THEN "Si"
				ELSE "No"
				END as polaridad
				, sv.vfaseneutro, sv.vneutrotierra, sv.vfasetierra
				FROM variable v, subvariable sv
				WHERE v.idVariable = sv.idVariable
					AND v.idVariableGlobal = sv.idVariableGlobal
					AND v.idMedicion = '.$id.'
					AND v.idMedicionGlobal = '.$idg.';';
			
		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$c_polaridad = "No cumple";
				$c_vfaseneutro = "No cumple";
				$c_vneutrotierra = "No cumple";
				$c_vfasetierra = "No cumple";
				if($row["polaridad"] == "Si")
					$c_polaridad = "Cumple";
				if($row["vfaseneutro"] > 117 && $row["vfaseneutro"] < 123)
					$c_vfaseneutro = "Cumple";
				if(($row["vneutrotierra"] < 1) || ($row["vneutrotierra"] >= 1.5 && $row["vneutrotierra"] <= 2.4))
					$c_vneutrotierra = "Cumple";
				if($row["vfasetierra"] > 117 && $row["vfasetierra"] < 123)
					$c_vfasetierra = "Cumple";
				
				echo '<tr>
						<td rowspan="4" style="text-align: center; vertical-align: middle; position: relative;"><b><center>R'.$rcontador.'</center></b></td>
						<td><center>Polaridad</center></td>
						<td><center>'.$row["polaridad"].'</center></td>
						<td><center>Si</center></td>
						<td><center>'.$c_polaridad.'</center></td>
					</tr>
					<tr>
						<td><center>Vfase-neutro</center></td>
						<td><center>'.$row["vfaseneutro"].'</center></td>
						<td><center>120 VAC Aprox.</center></td>
						<td><center>'.$c_vfaseneutro.'</center></td>
					</tr>
					<tr>
						<td><center>Vneutro-tierra</center></td>
						<td><center>'.$row["vneutrotierra"].'</center></td>
						<td><center>Menor a 1VAC.<br>Máximo entre <br>1.5 a 2.4 VAC</center></td>
						<td><center>'.$c_vneutrotierra.'</center></td>
					</tr>
					<tr>
						<td><center>Vfase-tierra</center></td>
						<td><center>'.$row["vfasetierra"].'</center></td>
						<td><center>120 VAC Aprox.</center></td>
						<td><center>'.$c_vfasetierra .'</center></td>
					</tr>';
				$rcontador = $rcontador + 1;
			}
		}
		include 'sql-close.php';
	}
	
	function paramareport($idg, $id, $tipo, $parametro, $estandar) {
		
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
			$cumplimiento = "No cumple";
			$magnitud = "";
			switch ($tipo){
				case 2:	$magnitud = " Lux";
						if($avg<=600){
							$cumplimiento = "Cumple";
						}
						break;
				case 4:	$magnitud = " Db";
						if($avg<=65){
							$cumplimiento = "Cumple";
						}
						break;
				case 5:	$magnitud = " °C";
						if($avg>=22 && $avg<=26){
							$cumplimiento = "Cumple";
						}
						break;
				case 6:	$magnitud = " %";
						if($avg>=30 && $avg<=60){
							$cumplimiento = "Cumple";
						}
						break;
			}
			
			
			
			echo '
				<tr>
					<td rowspan="'.$rowspan.'" style="text-align: center; vertical-align: middle; position: relative;">'.$parametro.'</td>
					<td><center>P'.$contP.'</center></td>
					<td><center>'.$valor.'</center></td>
					<td rowspan="'.$rowspan.'" style="text-align: center; vertical-align: middle; position: relative;">'.$avg.$magnitud.'</td>
					<td rowspan="'.$rowspan.'" style="text-align: center; vertical-align: middle; position: relative;">'.$estandar.'</td>
					<td rowspan="'.$rowspan.'" style="text-align: center; vertical-align: middle; position: relative;">'.$cumplimiento.'</td>
				</tr>';
				
			
			for ($x = 0; $x < ($rowspan - 1); $x++) {
				$contP = $contP + 1;
				$rowvalor = $result->fetch_assoc();
				$valor = $rowvalor["valor"];
				echo '
					<tr>
						<td><center>P'.$contP.'</center></td>
						<td><center>'.$valor.'</center></td>
					</tr>';
			} 
		}
		else{
			echo '
				<tr>
					<td><center>'.$parametro.'</center></td>
					<td><center>-</center></td>
					<td><center>-</center></td>
					<td><center>-</center></td>
					<td><center>-</center></td>
					<td><center>-</center></td>
				</tr>';			
		}
		include 'sql-close.php';
	}
	
	function get_top3_activity(){
		include 'sql-open.php';
		$stmt = $con->prepare("SELECT data.id, data.global, data.tipo, data.usuario, data.fechasincro
								FROM (
								SELECT se.idSegElectrica as id, se.idSegElectricaGlobal as global,2 as tipo, u.nombre as usuario, se.fechasincro 
								FROM `segelectrica` se, `usuario` u
								WHERE u.idUsuario = se.idUsuario
								union ALL
								SELECT m.idMedicion as id,m.idMedicionGlobal as global,1 as tipo, u.nombre as usuario, m.fechasincro
								FROM `medicion` m, usuario u
								WHERE m.idUsuario = u.idUsuario) AS data
								ORDER BY data.fechasincro DESC LIMIT 3;");
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows> 0) {
			while($row = $result->fetch_assoc()) {
				$tiporeporte = "";
				if($row["tipo"] == 1)
					$tiporeporte = "verificación ambiental";
				else
					$tiporeporte = "seguridad eléctrica";
				
				
				echo '
					<div class="row m-b-25">
					<div class="col-auto p-r-0">
						<div class="u-img">
							<img src="..\files\assets\images\breadcrumb-bg.jpg" alt="user image" class="img-radius cover-img">
							<img src="..\files\assets\images\avatar-2.jpg" alt="user image" class="img-radius profile-img">
						</div>
					</div>
					<div class="col">
						<h6 class="m-b-5">'.$row["usuario"].'</h6>
						<p class="text-muted m-b-0">Agregó un reporte de '.$tiporeporte.'.</p>
						<p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i>'.$row["fechasincro"].'</p>
					</div>
					</div>				
				';
			}
		}
		$stmt->close();
		include "sql-close.php";
	}
	
	function get_all_activity(){
		include 'sql-open.php';
		$stmt = $con->prepare("SELECT data.id, data.global, data.tipo, data.usuario, data.fechasincro
								FROM (
								SELECT se.idSegElectrica as id, se.idSegElectricaGlobal as global,2 as tipo, u.nombre as usuario, se.fechasincro 
								FROM `segelectrica` se, `usuario` u
								WHERE u.idUsuario = se.idUsuario
								union ALL
								SELECT m.idMedicion as id,m.idMedicionGlobal as global,1 as tipo, u.nombre as usuario, m.fechasincro
								FROM `medicion` m, usuario u
								WHERE m.idUsuario = u.idUsuario) AS data
								ORDER BY data.fechasincro DESC;");
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows> 0) {
			while($row = $result->fetch_assoc()) {
				$tiporeporte = "";
				if($row["tipo"] == 1)
					$tiporeporte = "verificación ambiental";
				else
					$tiporeporte = "seguridad eléctrica";
				
				
				echo '
				<tr class=" user-activity-card card-block"><td style="background-color: white; width=90%;">
							<div class="row">
								<div class="col-auto p-r-0">
									<div class="u-img">
										<img src="..\files\assets\images\breadcrumb-bg.jpg" alt="user image" class="img-radius cover-img">
										<img src="..\files\assets\images\avatar-2.jpg" alt="user image" class="img-radius profile-img">
									</div>
								</div>
								<div class="col">
									<h6 class="m-b-5">'.$row["usuario"].'</h6>
									<p class="text-muted m-b-0">Agregó un reporte de '.$tiporeporte.'.</p>
									<p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i>'.$row["fechasincro"].'</p>
								</div>
							</div>

				</tr></td>
				';
			}
			
			echo '</div> </div>';
		}
		$stmt->close();
		include "sql-close.php";
	}
	
?>