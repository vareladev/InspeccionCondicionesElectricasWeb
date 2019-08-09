<head>
	<?php include 'meta.php';?>
	
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
	<link rel="stylesheet" type="text/css" href="..\files\assets\css\mycss.css">
	
	<!-- DIV 2 IMG -->
	<script type="text/javascript" src="div2img/jquery-1.9.1.js.descarga"></script>
	<script type="text/javascript" src="div2img/dom-to-image.min.js.descarga"></script>
	<script type="text/javascript" src="div2img/FileSaver.min.js.descarga"></script>
	<script type="text/javascript">//<![CDATA[

	$(window).load(function(){
	  
	var node = document.getElementById('my-node');
	var btn = document.getElementById('foo');

	btn.onclick = function() {
	domtoimage.toBlob(document.getElementById('my-node'))
	.then(function(blob) {
	  window.saveAs(blob, 'my-node.png');
	});
	}


	});

	//]]></script>	
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
			
        <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                
                <nav class="pcoded-navbar">
                        <?php include 'menu.php';?>
                    </nav>
					
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Análisis de datos</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <!-- Page-body start -->
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
												<!-- Basic table card start -->
												<div class="card">
													<div class="card-header">
														<h4>Inspecciones ambientales realizadas en cada hospital</h4>
														<span>Los parámetros análizados son: Temperatura, Ruido, Luz y Humedad ambiental.</span>
													</div>
													<div class="card-block table-border-style">
														<div class="table-responsive">
															<table class="table">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Hospital</th>
																		<th>Cantidad de mediciones</th>
																		<th>Detalle</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		include 'sql-open.php';
																		$sql = "SELECT data.idHospital, data.nombre, COUNT(data.idMedicion) as cantidad
																				FROM (
																					SELECT h.idHospital, h.nombre,mediciones.idMedicionGlobal, mediciones.idMedicion
																					FROM
																					hospital h LEFT JOIN
																					(SELECT `idMedicionGlobal`, `idMedicion`, `idHospital`
																					FROM `analisis_condamb`  
																					WHERE `idParametro` IN (2,4,5,6)
																					GROUP BY `idMedicionGlobal`, `idMedicion`, `idHospital`) AS mediciones
																					ON h.idHospital = mediciones.idHospital
																					WHERE h.idHospital != 1) AS data
																				GROUP  BY data.idHospital, data.nombre
																				ORDER BY data.idHospital;";
																		$result = $con->query($sql);
																		$acc = 1;
																		while($row = $result->fetch_assoc()){
																			echo '<tr>
																					<th scope="row">'.$acc.'</th>
																					<td>'.$row["nombre"].'</td>
																					<td>'.$row["cantidad"].' mediciones</td>
																					<td><center><a href="reporte-detail.php?idh='.$row["idHospital"].'"><i class="feather icon-search"></i></a></center></td>
																				</tr>';
																			$acc +=1;
																		}
																		include 'sql-close.php';
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<br>
													<div class="card-header">
														<h4>Inspecciones de receptáculos eléctricos realizadas en cada hospital</h4>
														<span>Los parámetros análizados son: Polaridad, vfaseneutro, vneutrotierra y vfasetierra.</span>
													</div>
													<div class="card-block table-border-style">
														<div class="table-responsive">
															<table class="table">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Hospital</th>
																		<th>Cantidad de mediciones</th>
																		<th>Detalle</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		include 'sql-open.php';
																		$sql = "SELECT data.idHospital, data.nombre, COUNT(data.idMedicion) as cantidad
																				FROM (
																					SELECT h.idHospital, h.nombre,mediciones.idMedicionGlobal, mediciones.idMedicion
																					FROM
																					hospital h LEFT JOIN
																					(SELECT `idMedicionGlobal`, `idMedicion`, `idHospital`
																					FROM `analisis_recelec`  
																					GROUP BY `idMedicionGlobal`, `idMedicion`, `idHospital`) AS mediciones
																					ON h.idHospital = mediciones.idHospital
																					WHERE h.idHospital != 1) AS data
																				GROUP  BY data.idHospital, data.nombre
																				ORDER BY data.idHospital";
																		$result = $con->query($sql);
																		$acc = 1;
																		while($row = $result->fetch_assoc()){
																			echo '<tr>
																					<th scope="row">'.$acc.'</th>
																					<td>'.$row["nombre"].'</td>
																					<td>'.$row["cantidad"].' mediciones</td>
																					<td><center><a href="reporte-detail-rec.php?idh='.$row["idHospital"].'"><i class="feather icon-search"></i></a></center></td>
																				</tr>';
																			$acc +=1;
																		}
																		include 'sql-close.php';
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- Basic table card end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Required Jquery -->
<script type="text/javascript" src="..\files\bower_components\jquery\js\jquery.min.js"></script>
<script type="text/javascript" src="..\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
<script type="text/javascript" src="..\files\bower_components\popper.js\js\popper.min.js"></script>
<script type="text/javascript" src="..\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="..\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="..\files\bower_components\modernizr\js\modernizr.js"></script>
<script type="text/javascript" src="..\files\bower_components\modernizr\js\css-scrollbars.js"></script>

<!-- data-table js -->
<script src="..\files\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
<script src="..\files\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
<script src="..\files\assets\pages\data-table\js\jszip.min.js"></script>
<script src="..\files\assets\pages\data-table\js\pdfmake.min.js"></script>
<script src="..\files\assets\pages\data-table\js\vfs_fonts.js"></script>
<script src="..\files\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
<script src="..\files\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>
<script src="..\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="..\files\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="..\files\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="..\files\bower_components\i18next\js\i18next.min.js"></script>
<script type="text/javascript" src="..\files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="..\files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="..\files\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
<!-- Custom js -->
<script src="..\files\assets\pages\data-table\js\data-table-custom.js"></script>

<script src="..\files\assets\js\pcoded.min.js"></script>
<script src="..\files\assets\js\vartical-layout.min.js"></script>
<script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="..\files\assets\js\script.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script>
// tell the embed parent frame the height of the content
if (window.parent && window.parent.parent){
  window.parent.parent.postMessage(["resultsFrame", {
	height: document.body.getBoundingClientRect().height,
	slug: "4ef9t5un"
  }], "*")
}

// always overwrite window.name, in case users try to set it manually
window.name = "result"
</script>

</body>

</html>
