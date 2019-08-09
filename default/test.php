	<?php
	include 'sql-open.php';
	
	$sql = "SELECT COUNT(*) cantidad_mediciones FROM medicion;";
	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<br>".$row["cantidad_mediciones"];
		}
	}
	include 'sql-close.php';
	?>
