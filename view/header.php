<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

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

									if(empty($row)){
										echo "<li><a href='enviarpropuesta.php'>".$l["view_list_send_proposal"]."</a></li>";
									}
									else{
										if($row["estadoPropuesta"] == 0){
											echo "<li><a href='editpropuesta.php'>".$l["view_list_edit_proposal"]."</a></li>";
										}
										else{
											if($row["estadoPropuesta"] == 1){
												echo " <li><a>". $l["header_pincho_denied"] ."</a></li>";
											}
											else{
												echo " <li><a>". $l["header_pincho_allowed"] ."</a></li>";

												echo "<li><a href='./view_establishment_codes.php'>".$l["view_list_establishment_codes"]."</a></li>";
											}
										}
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
					<li><a><i class="fa fa-search"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-globe"></i><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="../controller/lang.php?l=es"><img class="lang" src="../images/lang/es.png" />Español</a></li>
							<li><a href="../controller/lang.php?l=en"><img class="lang" src="../images/lang/gb.png" />English</a></li>
							<li><a href="../controller/lang.php?l=de"><img class="lang" src="../images/lang/de.png" />Deusch</a></li>
							<li><a href="../controller/lang.php?l=jp"><img class="lang" src="../images/lang/jp.png" />日本人</a></li>
							<li><a href="../controller/lang.php?l=pt"><img class="lang" src="../images/lang/pt.png" />Português</a></li>
							<li><a href="../controller/lang.php?l=fr"><img class="lang" src="../images/lang/fr.png" />Français</a></li>
							<li><a href="../controller/lang.php?l=sy"><img class="lang" src="../images/lang/sy.png" />العربية</a></li>

						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav>
</header>
	<!-- /HEADER -->