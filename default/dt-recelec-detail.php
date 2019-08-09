<?php
	if (!isset($_GET['idg']) || !isset($_GET['id'])) {
		header('Location: index.php');
	}
?>
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
                                                    <h4>Registro de verificacion ambiental</h4>
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
													<?php
														echo '
															<div class="card-block">
																<a href="dt-recelec.php">
																	<button class="btn btn-primary">Regresar</button>
																</a>
															</div>
														';
													?>
													<div class="card-header">
														<h4>Detalles de inspección</h4>
													</div>
													<div class="card-block table-border-style" id="my-node">
														<div class="table-responsive">
															<table class="table col-sm-21" >
															    
																<tbody>
																	<?php
																		$id = '';
																		$idg = '';
																		
																		$id = $_GET['id'];
																		$idg = $_GET['idg'];
																		
																		include 'sql-open.php';
																	
																		$sql = 'SELECT h.nombre as hos, a.nombreArea, u.nombre, m.fecha2, m.hora, m.idMedicionGlobal,m.idMedicion,
																					m.responsable, m.fechasincro, m.comentario
																				FROM medicion m, area a, hospital h, usuario u 
																				WHERE m.idArea = a.idArea 
																					AND a.idHospital = h.idHospital 
																					AND m.idUsuario = u.idUsuario 
																					AND m.idMedicionGlobal = '.$idg.' 
																					AND m.idMedicion = '.$id.' 
																				ORDER BY m.fecha2 ASC;';
																				
																		$result = $con->query($sql);
																		$comentario = '--';
																		
																		if ($result->num_rows > 0) {
																			
																			while($row = $result->fetch_assoc()) {
																				if($row["comentario"] != 'NULL'){
																					$comentario = $row["comentario"];
																				}
																				echo '
																					<tr>
																						<td colspan="2"><b>Hospital: </b></td>
																						<td colspan="3">'.$row["hos"].'</td>
																					</tr>
																					<tr>
																						<td colspan="2"><b>Área: </b></td>
																						<td colspan="3">'.$row["nombreArea"].'</td>
																					</tr>
																					<tr>
																						<td colspan="2"><b>Servicio análizado: </b></td>
																						<td colspan="3">servicio analizado</td>
																					<tr>
																					</tr>
																						<td colspan="2"><b>Responsable: </b></td>
																						<td colspan="3">'.$row["responsable"].'</td>
																					</tr>
																					<tr>
																						<td colspan="2"><b>Fecha de realización: </b></td>
																						<td colspan="3">'.$row["fecha2"].'</td>
																					<tr>
																					</tr>
																						<td colspan="2"><b>Hora de realización: </b></td>
																						<td colspan="3">'.$row["hora"].'</td>
																					</tr>
																					<tr>
																						<td colspan="2"><b>Inspector: </b></td>
																						<td colspan="3">'.$row["nombre"].'</td>
																					</tr>
																					<tr>
																						<td colspan="2"><b>Fecha de sincronización con el servidor: </b></td>
																						<td colspan="3">'.$row["fechasincro"].'</td>
																					</tr>
																					<tr>
																						<td colspan="5">&nbsp;&nbsp;&nbsp;</td>
																					</tr>
																					<tr>
																						<td colspan="5"><b>Resultados de verificación de receptáculos eléctricos en las instalaciones:</b></td>
																					</tr>
																					';										
																			}
																		}
																		
																		echo '<tr>
																				<td><b><center>Punto</center></b></td>
																				<td><b><center>Parámetro</center></b></td>
																				<td><b><center>Valor</center></b></td>
																				<td><b><center>Estándar</center></b></td>
																				<td><b><center>Cumple</center></b></td>
																			</tr>';
																		
																		include 'sql-close.php';																	
																		
																		include 'functions.php';
																		paramelecreport($idg, $id);
																			
																		echo '
																			<tr>
																				<td colspan="5">&nbsp;&nbsp;&nbsp;</td>
																			</tr>
																			<tr>
																				<td colspan="5"><b>Comentarios:</b></td>
																			</tr>
																			<tr>
																				<td colspan="5">'.$comentario.'</td>
																			</tr>
																		';
																		
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<?php
														echo '
															<div class="card-block">
																<a href="dt-recelec.php">
																	<button class="btn btn-primary">Regresar</button>
																</a>
															</div>
														';
													?>
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
