google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

//datos para luz
var data = google.visualization.arrayToDataTable([
  ['Cumplimiento', 'Cantidad'],
  ['Cumple',     11],
  ['No cumple',      2],
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
  ['Cumple',     5],
  ['No cumple',      12],
]);
var optionsRuido = {
  title: 'Parámetro 2: Ruido ambiental',
  is3D: true
};
var chartRuido = new google.visualization.PieChart(document.getElementById('piechartRuido'));
chartRuido.draw(dataRuido, optionsRuido);
}