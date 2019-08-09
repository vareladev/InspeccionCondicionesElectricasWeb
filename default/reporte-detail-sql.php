<?php
	function get_hospital_name($idh){		
		$hospital_name = "";
		include 'sql-open.php';
		$stmt = $con->prepare("SELECT `nombre` FROM `hospital` WHERE `idHospital` = ?;");
		$stmt->bind_param("i", $idh);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('No rows');
		while($row = $result->fetch_assoc()) {
		  $hospital_name = $row['nombre'];

		}
		$stmt->close();
		include "sql-close.php";
		return $hospital_name;
	}
	
	/*
	get_percentage: get the percentage for each term, based on the sum of both terms,
	param $band indicate what term do you want to operate.
	*/
	function get_percentage($term1, $term2, $band){
		$term_f = 0;
		if ($band)
			$term_f = $term1;
		else
			$term_f = $term2;
		return round($term_f/($term1 + $term2) * 100, 2);
	}
	
	function get_percentage_recelec($values, $band){
		$term_f = 0;
		if ($band == 0)
			$term_f = $values[0];
		else
			$term_f = $values[1];
		return round($term_f/($values[0] + $values[1]) * 100, 2);
	}
	
	
	function get_param_amb_data($id_hospital, $id_param, $check){
		include 'sql-open.php';
		$stmt = $con->prepare("SELECT COUNT(*) as count FROM `analisis_condamb` 
								WHERE `idHospital` = ? AND `idParametro` = ? AND `cumple` = ?;");
		$stmt->bind_param("iii", $id_hospital, $id_param, $check);
		$stmt->execute();
		$result = $stmt->get_result();
		/*if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
			  
			}
		}*/
		$value = -1;
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$value = $row["count"];
		}
		$stmt->close();
		include "sql-close.php";
		return $value;
	}
	
	function get_param_recelec_data($id_hospital, $param){
		include 'sql-open.php';
		$stmt = $con->prepare("SELECT `".$param."`
								FROM `analisis_recelec` 
								WHERE `idHospital` = ?;");
		$stmt->bind_param("i", $id_hospital);
		$stmt->execute();
		$result = $stmt->get_result();
		//creando arreglos de respuestas
		$values = array_fill(0, 2, 0);

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				if(check_recelec_standard($param, $row[$param]))
					$values[0] += 1;
				else
					$values[1] += 1;
			}
		}
		$stmt->close();
		include "sql-close.php";
		return $values;
	}
	
	function check_recelec_standard($param, $value){
		if($param == "polaridad"){
			if ($value==1)
				return true;
			else
				return false;
		}
		else if($param == "vfaseneutro"){
			if ($value>=119 && $value<=121)
				return true;
			else
				return false;
		}
		else if($param == "vneutrotierra"){
			if ($value<=1)
				return true;
			else
				return false;
		}
		else if($param == "vfasetierra"){
			if ($value>=119 && $value<=121)
				return true;
			else
				return false;
		}
	}
?>