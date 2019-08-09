<?php
$date1 = new DateTime("2019-01-31");
$date2 = new DateTime("2019-10-31");
$today = new DateTime(date("Y-m-d"));
//total de dias del proyeto
$tiempo_total = $date1->diff($date2);
//total de dias pasados
$tiempo_parcial = $date1->diff($today);
//dividiendo:
$avance = ($tiempo_parcial->days / $tiempo_total->days) * 100;


?>