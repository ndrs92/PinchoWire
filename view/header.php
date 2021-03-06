<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../controller/pw.php";
include_once __DIR__."/../controller/pwctrl_competition.php";
include_once __DIR__."/../resources/code/lang_coverage.php";


$currentConcurso = CompetitionController::getconcurso();
$estado = -1;

$estado = $currentConcurso->getEstado();



?>

<!-- HEADER -->
<header id="header">
	<nav class="navbar st-navbar navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#st-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="./list.php"><img class="icon-logo" src="../images/icon.png" alt=""></a>
			</div>

			<div class="collapse navbar-collapse" id="st-navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<?php if($estado != 2){ ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $l["header_contest"] ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="./list.php#pinchos"><?= $l["header_pinchos"] ?></a></li>
							<li><a href="./list.php#stats"><?= $l["header_stats"] ?></a></li>
							<li class="divider"></li>
							<li><a href="./list.php#gastromapa"><?= $l["header_gastromapa"] ?></a></li>
						</ul>
					</li>

					<li><a href="./list.php#about"><?= $l["header_about"] ?></a></li>





					<?php
					if(!isset($_SESSION["user"])){
						?>
						<li><a href="./login.php"><?= $l["header_login"] ?></a></li>
						<?php
					}else{
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $_SESSION["user"]->getNombre() ?> <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">	
								<?php
								if(get_class($_SESSION["user"]) == "Establecimiento"){
									$row = $_SESSION["user"]->havePropuesta();

									if(empty($row) && $estado < 1){
										echo "<li><a href='enviarpropuesta.php'>".$l["view_list_send_proposal"]."</a></li>";
									}
									else{
										if($row["estadoPropuesta"] == 0 && $estado < 1){
											echo "<li><a href='editpropuesta.php'>".$l["view_list_edit_proposal"]."</a></li>";
										}
										else{
											if($row["estadoPropuesta"] == 1){
												echo " <li><a>". $l["header_pincho_denied"] ."</a></li>";
											}
											else if($row["estadoPropuesta"] == 2){
												echo " <li><a>". $l["header_pincho_allowed"] ."</a></li>";

												echo "<li><a href='./view_establishment_codes.php'>".$l["view_list_establishment_codes"]."</a></li>";
											}
										}
									}

								}
								if(get_class($_SESSION["user"]) == "Administrador"){
									echo "<li><a href='./view_administrar.php'>".$l["view_list_admin_event"]."</a></li>";
								}
								if(get_class($_SESSION["user"]) == "JuradoProfesional"){
									$concurso= CompetitionController::getConcurso();
									if($concurso->getEstado() == 0){
										echo "<li><a href='./view_votacionprofesional.php'>".$l["view_list_profesional_votacion_promociona"]."</a></li>";
									}
									if($concurso->getEstado() == 1){
										echo "<li><a href='./view_votacionprofesionalfinal.php'>".$l["view_list_profesional_votacion_finalista"]."</a></li>";
									}
								}	
								echo "<li><a href='profile.php?idemail=".$_SESSION['user']->getIdemail()."'>".$l["view_list_view_profile"]."</a></li>";
								echo "<li><a href='../controller/pw.php?controller=user&action=logout'>".$l["view_list_disconnect"]."</a></li>";
								?>		          
							</ul>
						</li>
						<?php
					}
					?>
					<li><a href="#" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search hidden-xs"></i>  <span class="visible-xs"><i class="fa fa-search"></i> Buscar</span></a></li>
					<?php } ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-globe"></i><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="../controller/pw.php?controller=user&action=setLanguage&l=es"><img class="lang" src="../images/lang/es.png" />Español</a></li>
							<li><a href="../controller/pw.php?controller=user&action=setLanguage&l=en"><img class="lang" src="../images/lang/gb.png" />English</a></li>
							
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav>
</header>
<!-- /HEADER -->

<!-- SEARCH MODAL -->
<div id="searchModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content search">
			<form role="form" action="../view/search.php" method="post"> 
				<div class="form-group has-feedback has-feedback-left search-form">
					<input type="text" name="search-data" class="form-control input-lg" placeholder="<?= $l["header_search_modal"] ?>" />
					<i class="form-control-feedback fa fa-search"></i>
				</div>
			</form>
		</div>
	</div>
</div>

	<!-- /SEARCH MODAL -->