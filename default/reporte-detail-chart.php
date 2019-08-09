<?php
	include "reporte-detail-sql.php";
	
	//lux
	$param_t = [];
	$param_f = [];
	$param_t_total = 0;
	$param_f_total = 0;
	for ($i = 2; $i <= 6; $i++){
		if($i != 3){ //parametro definido con id 3 no fue tomado en cuenta
			$res_t = get_param_amb_data($_GET['idh'],$i,1);
			$res_f = get_param_amb_data($_GET['idh'],$i,0);
			$param_t_total = $param_t_total + $res_t;
			$param_f_total = $param_f_total + $res_f;
			array_push($param_t,$res_t);
			array_push($param_f,$res_f);
		}
	}
	
	echo "
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			
		//datos para total
		var data_tot = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage($param_t_total,$param_f_total,true)."%)', ".$param_t_total."],
		  ['No cumple (".get_percentage($param_t_total,$param_f_total,false)."%)', ".$param_f_total."],
		]);
		var options_tot = {
		  title: 'Resultado general',
		  is3D: true
		};
		var chart_tot = new google.visualization.PieChart(document.getElementById('piechart_tot'));
		chart_tot.draw(data_tot, options_tot);

		//datos para luz
		var data = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage($param_t[0],$param_f[0],true)."%)', ".$param_t[0]."],
		  ['No cumple (".get_percentage($param_t[0],$param_f[0],false)."%)', ".$param_f[0]."],
		]);
		var options = {
		  title: 'Parámetro 1: Iluminación ambiental',
		  is3D: true
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);

		//datos para ruido
		var dataRuido = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage($param_t[1],$param_f[1],true)."%)', ".$param_t[1]."],
		  ['No cumple (".get_percentage($param_t[1],$param_f[1],false)."%)', ".$param_f[1]."],
		]);
		var optionsRuido = {
		  title: 'Parámetro 2: Ruido ambiental',
		  is3D: true
		};
		var chartRuido = new google.visualization.PieChart(document.getElementById('piechartRuido'));
		chartRuido.draw(dataRuido, optionsRuido);

		
		//datos para Temperatura
		var data_temp = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage($param_t[2],$param_f[2],true)."%)', ".$param_t[2]."],
		  ['No cumple (".get_percentage($param_t[2],$param_f[2],false)."%)', ".$param_f[2]."],
		]);
		var options_temp = {
		  title: 'Parámetro 3: Temperatura ambiental',
		  is3D: true
		};
		var chart_temp = new google.visualization.PieChart(document.getElementById('piechartTemp'));
		chart_temp.draw(data_temp, options_temp);
		
		//datos para humedad
		var data_hum = google.visualization.arrayToDataTable([
		  ['Cumplimiento', 'Cantidad'],
		  ['Cumple (".get_percentage($param_t[3],$param_f[3],true)."%)', ".$param_t[3]."],
		  ['No cumple (".get_percentage($param_t[3],$param_f[3],false)."%)', ".$param_f[3]."],
		]);
		var options_hum = {
		  title: 'Parámetro 4: Humedad ambiental',
		  is3D: true
		};
		var chart_hum = new google.visualization.PieChart(document.getElementById('piechartHum'));
		chart_hum.draw(data_hum, options_hum);
	}
	";
?>