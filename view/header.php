<?php
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";

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
				<a class="logo" href="./pinchowire.php"><img src="../images/logo.png" alt=""></a>
			</div>

			<div class="collapse navbar-collapse" id="st-navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="./pinchowire.php#header"><?= $l["header_home"] ?></a></li>
					<li><a href="./pinchowire.php#pinchos"><?= $l["header_pinchos"] ?></a></li>
					<li><a href="./pinchowire.php#stats"><?= $l["header_stats"] ?></a></li>
					<li><a href="./pinchowire.php#about"><?= $l["header_about"] ?></a></li>

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
									if(!$_SESSION["user"]->havePinchoAccepted()){
										?>
										<li><a href='enviarpropuesta.php'><?= $l["view_list_send_proposal"] ?></a><br/></li>
										<li><a href='editpropuesta.php'><?= $l["view_list_edit_proposal"] ?></a><br/></li>
										<?php
									}else{
										$nombrePincho = $_SESSION["user"]->getAssociatedPincho()->getIdnombre();
										?>
										<li><a href="viewPincho.php?id=<?= $nombrePincho ?>">Tu pincho está en concurso!</a></li>
										<li><a href='./view_establishment_codes.php'><?= $l["view_list_establishment_codes"] ?></a></li>
										<?php
									}
								}
								if(get_class($_SESSION["user"]) == "Administrador"){
									echo "<li><a href='./view_administrar.php'>".$l["view_list_admin_event"]."</a></li>";
								}	
								echo "<li><a href='profile.php?idemail=".$_SESSION['user']->getIdemail()."'>".$l["view_list_view_profile"]."</a></li>";
								echo "<li><a href='../controller/logout_controller.php'>".$l["view_list_disconnect"]."</a></li>";
								?>		          
							</ul>
						</li>
						<?php
					}
					?>

				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav>
</header>
	<!-- /HEADER -->