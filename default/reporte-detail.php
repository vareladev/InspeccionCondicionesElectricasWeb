<?php
	if (!isset($_GET['idh'])) {
		header('Location: index.php');
	}
	include 'functions.php';
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
	

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="..\files\assets\js\my.js"></script>

	
	<!-- DIV 2 IMG -->
	<script type="text/javascript" src="div2img/jquery-1.9.1.js.descarga"></script>
	<script type="text/javascript" src="div2img/dom-to-image.min.js.descarga"></script>
	<script type="text/javascript">
	<?php
		include 'reporte-detail-chart.php';
	?>
	</script>
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
	
	<link rel="stylesheet" type="text/css" href="..\files\assets\css\mycss.css">
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
														<h4>Inspecciones ambientales realizadas en: <br><?php echo get_hospital_name($_GET['idh']); ?> </h4>
														<span>Los parámetros análizados son: Temperatura, Ruido, Luz y Humedad ambiental.</span>
													</div>
 													<div style="width:100%; padding:20px;">
														Evaluación general del cumplimiento del estándar, tomando en cuenta todas las mediciones realizadas en el hospital, relacionadas a los parámetros ambientales: Temperatura, Ruido, Luz y Humedad ambiental.
													</div>
													<table style="width:100%;" border="0">
														<tr>
															<td align="center" style="width:100%; display: inline-block;"  >
																<div id="piechart_tot" style="width: 50%; height: 300px; margin: 0 auto;"></div>
															</td>
														</tr>
													</table>
													<div style="width:100%; padding:20px;">
														Evaluación de cada parámetro, tomando en cuenta todas las mediciones realizadas en el hospital.
													</div>
													<table style="width:100%;" border="0">
														<tr>
														<td style="width:50%; display: inline-block;">
															<div id="piechart" style="width: 100%; height: 300px;"></div>
														</td>
														<td style="width:50%; display: inline-block;">
															<div id="piechartRuido" style="width: 100%; height: 300px;"></div>
														</td>
														</tr>
														<tr>
														<tr>
														<td style="width:50%; display: inline-block;">
															<div id="piechartTemp" style="width: 100%; height: 300px;"></div>
														</td>
														<td style="width:50%; display: inline-block;">
															<div id="piechartHum" style="width: 100%; height: 300px;"></div>
														</td>
														</tr>
														<tr>
													</table>
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
    <!-- Chart js -->
    <script type="text/javascript" src="..\files\bower_components\chart.js\js\Chart.js"></script>
    <!-- amchart js -->
    <script src="..\files\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="..\files\assets\pages\widget\amchart\serial.js"></script>
    <script src="..\files\assets\pages\widget\amchart\light.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="..\files\assets\js\SmoothScroll.js"></script>
    <script src="..\files\assets\js\pcoded.min.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="..\files\assets\pages\dashboard\analytic-dashboard.min.js"></script>
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
