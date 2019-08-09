<?php
	include 'functions.php';
?>

<head>
	<?php include 'meta.php';?>
	
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
									<h4><span>Sistema de registro</span></h4>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <?php include 'user-profile.php';?>
                        </ul>
                    </div>
                </div>
            </nav>

            
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <?php include 'menu.php';?>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-yellow update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">21%</h4>
                                                                <h6 class="text-white m-b-0">Progreso</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-1" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Avance general de este proyecto</p>
                                                    </div>
                                                </div>
                                            </div>
											
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">
																	<?php
																	include 'sql-open.php';
																	
																	$sql = "SELECT COUNT(*) as cuenta
																			FROM (SELECT h.nombre as hos, a.nombreArea, u.nombre, m.fecha2, m.hora, m.idMedicionGlobal,m.idMedicion
																			FROM medicion m, area a, hospital h, usuario u, variable v
																			WHERE m.idArea = a.idArea 
																				AND a.idHospital = h.idHospital 
																				AND m.idUsuario = u.idUsuario 
																				AND m.idMedicionGlobal = v.idMedicionGlobal
																				AND m.idMedicion = v.idMedicion
																				AND (v.tipo = 2 OR v.tipo = 4 OR v.tipo = 5 OR v.tipo = 6)
																			GROUP BY m.idMedicionGlobal,m.idMedicion
																			ORDER BY m.fecha2 ASC) medambdetail																	";
																	$result = $con->query($sql);

																	if ($result->num_rows > 0) {
																		while($row = $result->fetch_assoc()) {
																			echo $row["cuenta"];
																		}
																	}
																	include 'sql-close.php';
																	?>
																</h4>
                                                                <h6 class="text-white m-b-0">Registros</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-2" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
													<a href="dt-condamb.php">
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Verificación de condiciones ambientales</p>
                                                    </div>
													</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-pink update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">
																<?php
																	include 'sql-open.php';
																	
																	$sql = "
																	SELECT COUNT(*) as cantidad_medelec
																	FROM (
																		SELECT COUNT(*)
																		FROM medicion m, area a, hospital h, usuario u, variable v
																		WHERE m.idArea = a.idArea 
																			AND a.idHospital = h.idHospital 
																			AND m.idUsuario = u.idUsuario 
																			AND m.idMedicionGlobal = v.idMedicionGlobal
																			AND m.idMedicion = v.idMedicion
																			AND v.tipo = 1
																		GROUP BY m.idMedicionGlobal,m.idMedicion
																		ORDER BY m.fecha2 ASC) tbl;";
																	$result = $con->query($sql);

																	if ($result->num_rows > 0) {
																		while($row = $result->fetch_assoc()) {
																			echo $row["cantidad_medelec"];
																		}
																	}
																	include 'sql-close.php';
																?>
																</h4>
                                                                <h6 class="text-white m-b-0">Registros</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-3" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
													<a href="dt-recelec.php">
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>
														Verificación de recetáculos eléctricos</p>
                                                    </div>
													</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">
																<?php
																	include 'sql-open.php';
																	
																	$sql = "SELECT COUNT(*) cantidad_mediciones FROM segelectrica;";
																	$result = $con->query($sql);

																	if ($result->num_rows > 0) {
																		while($row = $result->fetch_assoc()) {
																			echo $row["cantidad_mediciones"];
																		}
																	}
																	include 'sql-close.php';
																?>
																</h4>
                                                                <h6 class="text-white m-b-0">Registros</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
													<a href="dt-segelec.php">
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>
														Verificación de seguridad eléctrica
														</p>
                                                    </div>
													</a>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->

            

                                            <div class="col-xl-8 col-md-12">
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>Reportes</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover  table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Reporte</th>
                                                                        <th>Detalle</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-inline-block align-middle">
                                                                                <h6>Verificación de condiciones ambientales</h6>
                                                                                <p class="text-muted m-b-0">Iluminación, Ruido, Temperatura y Humedad relativa</p>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-c-blue">Ver</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-inline-block align-middle">
                                                                                <h6>Verificación de recetáculos eléctricos</h6>
                                                                                <p class="text-muted m-b-0">Tomas de corriente</p>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-c-blue">Ver</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-inline-block align-middle">
                                                                                <h6>Verificación de seguridad eléctrica</h6>
                                                                                <p class="text-muted m-b-0">Seguridad en equipo médico</p>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-c-blue">Ver</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="text-center">
                                                                <a href="#!" class=" b-b-primary text-primary">Ver todo</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card user-activity-card">
                                                    <div class="card-header">
                                                        <h5>Actividad de usuarios</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <?php get_top3_activity();?>

                                                        <div class="text-center">
                                                            <a href="#!" class="b-b-primary text-primary"><a href="actividad-usuarios-2.php">Ver todo</a></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

											
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script data-cfasync="false" src="..\..\..\cdn-cgi\scripts\5c5dd728\cloudflare-static\email-decode.min.js"></script><script type="text/javascript" src="..\files\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="..\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\modernizr.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="..\files\bower_components\chart.js\js\Chart.js"></script>
    <!-- amchart js -->
    <script src="..\files\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="..\files\assets\pages\widget\amchart\serial.js"></script>
    <script src="..\files\assets\pages\widget\amchart\light.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="..\files\assets\js\SmoothScroll.js"></script>
    <script src="..\files\assets\js\pcoded.min.js"></script>
    <!-- custom js -->
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="..\files\assets\pages\dashboard\custom-dashboard.js"></script>
    <script type="text/javascript" src="..\files\assets\js\script.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>

</html>
