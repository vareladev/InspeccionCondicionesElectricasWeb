<?php
	include "reporte-detail-sql.php";
	
	
	$values_polaridad = get_param_recelec_data($_GET['idh'],"polaridad");
	$values_vfaseneutro = get_param_recelec_data($_GET['idh'],"vfaseneutro");
	$values_vneutrotierra = get_param_recelec_data($_GET['idh'],"vneutrotierra");
	$values_vfasetierra = get_param_recelec_data($_GET['idh'],"vfasetierra");
	$values_total = array_fill(0, 2, 0);
	$total_t = $values_total[0] = $values_polaridad[0] + $values_vfaseneutro[0] + $values_vneutrotierra[0] + $values_vfasetierra[0];
	$total_f = $values_total[1] = $values_polaridad[1] + $values_vfaseneutro[1] + $values_vneutrotierra[1] + $values_vfasetierra[1];
	
	echo "
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
		
		//datos para general
		var data_tot = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage_recelec($values_total,0)."%)', ".$total_t."],
		  ['No cumple (".get_percentage_recelec($values_total,1)."%)', ".$total_f."],
		]);
		var options_tot = {
		  title: 'Revisión general',
		  is3D: true
		};
		var chart_tot = new google.visualization.PieChart(document.getElementById('piechart_tot'));
		chart_tot.draw(data_tot, options_tot);

		//datos para polaridad
		var data_pol = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage_recelec($values_polaridad,0)."%)', ".$values_polaridad[0]."],
		  ['No cumple (".get_percentage_recelec($values_polaridad,1)."%)', ".$values_polaridad[1]."],
		]);
		var options_pol = {
		  title: 'Parámetro 1: Polaridad',
		  is3D: true
		};
		var chart_pol = new google.visualization.PieChart(document.getElementById('piechart_pol'));
		chart_pol.draw(data_pol, options_pol);
		
		//datos para vfaseneutro
		var data_vfaseneutro = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage_recelec($values_vfaseneutro,0)."%)', ".$values_vfaseneutro[0]."],
		  ['No cumple (".get_percentage_recelec($values_vfaseneutro,1)."%)', ".$values_vfaseneutro[1]."],
		]);
		var options_vfaseneutro = {
		  title: 'Parámetro 2: vfaseneutro',
		  is3D: true
		};
		var chart_vfaseneutro = new google.visualization.PieChart(document.getElementById('piechart_vfaseneutro'));
		chart_vfaseneutro.draw(data_vfaseneutro, options_vfaseneutro);

		//datos para vneutrotierra
		var data_vneutrotierra = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage_recelec($values_vneutrotierra,0)."%)', ".$values_vneutrotierra[0]."],
		  ['No cumple (".get_percentage_recelec($values_vneutrotierra,1)."%)', ".$values_vneutrotierra[1]."],
		]);
		var options_vneutrotierra = {
		  title: 'Parámetro 3: vneutrotierra',
		  is3D: true
		};
		var chart_vneutrotierra = new google.visualization.PieChart(document.getElementById('piechart_vneutrotierra'));
		chart_vneutrotierra.draw(data_vneutrotierra, options_vneutrotierra);
		
		//datos para vfasetierra
		var data_vfasetierra = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage_recelec($values_vfasetierra,0)."%)', ".$values_vfasetierra[0]."],
		  ['No cumple (".get_percentage_recelec($values_vfasetierra,1)."%)', ".$values_vfasetierra[1]."],
		]);
		var options_vfasetierra = {
		  title: 'Parámetro 3: vfasetierra',
		  is3D: true
		};
		var chart_vfasetierra = new google.visualization.PieChart(document.getElementById('piechart_vfasetierra'));
		chart_vfasetierra.draw(data_vfasetierra, options_vfasetierra);
	}
	";
?>