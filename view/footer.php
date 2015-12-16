<?php
include_once "../resources/code/models.php";
include_once "../controller/pwctrl_competition.php";

$concurso = CompetitionController::getConcurso();
?>

<!-- FOOTER -->
<footer id="footer">
	<div class="container">
		<div class="row">
			<img class="logo-footer" src="../images/logo-inverted.png" alt="">
		</div>
		<div class="row">
			<!-- SOCIAL ICONS -->
			<div class="col-sm-6 col-sm-push-6 footer-social-icons">
				<span><?= $l["footer_followus"] ?></span>
				<!-- Show social icons only if the competition have links to them -->				
				<?php if($concurso->getFacebook() != NULL){
					echo "<a href='".$concurso->getFacebook()."'><i class='fa fa-facebook'></i></a>";
				} ?>
				<?php if($concurso->getTwitter() != NULL){
					echo "<a href='".$concurso->getTwitter()."'><i class='fa fa-twitter'></i></a>";
				} ?>
				<?php if($concurso->getGoogleplus() != NULL){
					echo "<a href='".$concurso->getGoogleplus()."'><i class='fa fa-google-plus'></i></a>";
				} ?>
				<br/>
				<span>Bitbucket: </span> <a href="https://bitbucket.org/ndrs92/pinchowire"><i class="fa fa-bitbucket"></i></a>
			</div>
			<!-- /SOCIAL ICONS -->
			<div class="col-sm-6 col-sm-pull-6 copyright">
				<p>&copy; <?= $l["footer_message"] ?></p>
				<p><a href="./eula.php"><?= $l["eula"] ?></a> - <?= $l["cookies"] ?></p>
			</div>
		</div>
	</div>
</footer>
	<!-- /FOOTER -->