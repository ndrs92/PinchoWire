<?php
include_once("../resources/code/bd_manage.php");

class ConcursoMapper{

	public static function retrieveMeanPrice(){
		global $connectHandler;
		$toRet = NULL;
		$query = "SELECT ROUND(AVG(precio), 2) as media  from pincho";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["media"];
	}

	public static function retrieveTotalSpent(){
		global $connectHandler;
		$toRet = NULL;
		$query = "SELECT SUM(p.precio) as totalGastado FROM codigo as co, canjea as ca, pincho as p WHERE co.idcodigo = ca.codigo_idcodigo AND co.pincho_idnombre = p.idnombre";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["totalGastado"];
	}

	public static function retrieveTotalConsumptions(){
		global $connectHandler;
		$toRet = NULL;
		$query = "SELECT count(*) as totales FROM canjea ";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["totales"];
	}

	public static function retrieveEstado(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select estado from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["estado"];
	}

	public static function retrieveNumFinalistas(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select numfinalistas from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);

		return $toRet["numfinalistas"];
	}

	public static function retrieveFacebook(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select facebook from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["facebook"];
	}

	public static function retrieveTwitter(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select twitter from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["twitter"];
	}

	public static function retrieveGoogleplus(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select googleplus from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["googleplus"];
	}

	public static function retrieveIdconcurso(){
		global $connectHandler;
		$query = "Select idconcurso from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["idconcurso"];

	}

	public static function retrieveDescripcion(){
		global $connectHandler;
		$query = "Select descripcion from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["descripcion"];

	}

	public static function retrieveFecha(){
		global $connectHandler;
		$query = "Select fecha from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["fecha"];

	}

	public static function retrieveRutaportada(){
		global $connectHandler;
		$query = "Select rutaportada from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["rutaportada"];

	}

	public static function retrieveTitulo(){
		global $connectHandler;
		$query = "Select titulo from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["titulo"];
	}

	public static function retrieveNumPinchos(){
		global $connectHandler;
		$query = "select count(*) from pincho";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['count(*)'];
	}

	public static function retrieveNumUsers(){
		global $connectHandler;
		$query = "SELECT (SELECT COUNT(*) FROM juradopopular)+(SELECT COUNT(*) FROM juradoprofesional)+(SELECT COUNT(*) FROM establecimiento)+(SELECT COUNT(*) FROM administrador) AS cuenta";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['cuenta'];
	}

	public static function retrieveNumEstablecimientos(){
		global $connectHandler;
		$query = "SELECT COUNT(*) FROM establecimiento";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['COUNT(*)'];
	}

	public static function retrieveNumVotosPopulares(){
		global $connectHandler;
		$query = "SELECT COUNT(*) FROM vota";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['COUNT(*)'];
	}

	public static function retrieveNumComments(){
		global $connectHandler;
		$query = "SELECT COUNT(*) FROM comentario";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['COUNT(*)'];
	}

	public static function updateEstado($newValue){
		global $connectHandler;
		$query = "UPDATE concurso SET estado = '$newValue' ";
		$result = mysqli_query($connectHandler, $query);
		return $result;
	}

	public static function updateConcurso($titulo, $descripcion, $rutaportada){
		global $connectHandler;
		$query = "UPDATE concurso SET titulo = '$titulo', descripcion = '$descripcion', rutaportada = '$rutaportada' ";
		$result = mysqli_query($connectHandler, $query);
		return $result;
	}
	public static function updateFinalistas($num){ 
		global $connectHandler;
		$query = "UPDATE concurso SET numfinalistas = $num ";
		$result = mysqli_query($connectHandler, $query);
		//Saco todos os pincho que podrian ser finalistas pondo como limite o numero de finalistas que se pasa
		$query = "SELECT pincho_idnombre, SUM( voto ) AS total FROM promociona GROUP BY pincho_idnombre ORDER BY total DESC LIMIT ".$num.";";
		$result = mysqli_query($connectHandler, $query);

		//Obteño o valor minimo da seleccion anterior
		$value = INF;
		while ($row = mysqli_fetch_assoc($result)) {
			if( $row["total"] < $value ) $value = $row["total"];
		}

		$query = "SELECT pincho_idnombre, SUM( voto ) AS total FROM promociona GROUP BY pincho_idnombre ORDER BY total DESC LIMIT ".$num.";";
		$resultado = mysqli_query($connectHandler, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {

			if( $row["total"] != $value ){
				$query = "UPDATE promociona SET esfinalista = 1 WHERE pincho_idnombre = '".$row["pincho_idnombre"]."'";
				
				$result = mysqli_query($connectHandler, $query) or die(mysqli_error());

			}
		}

		//Consigo o numero de elemento da seleccion anterior que teñen o valor minimo
		$query = "SELECT COUNT(*) AS pinchosMenorVotosParaFinalista FROM (SELECT pincho_idnombre, SUM( voto ) AS total FROM promociona GROUP BY pincho_idnombre ORDER BY total DESC LIMIT ".$num.") as A WHERE A.total = ".$value;
		$result = mysqli_query($connectHandler, $query);
		$row = mysqli_fetch_assoc($result);
		$pinchosMenorVotosParaFinalista = $row["pinchosMenorVotosParaFinalista"];
		
		//Obteño todos os elementos da tabla promociona que teñen o valor minimo, incluindo os que non saliron na primeira seleccion
		$query = "SELECT * from (SELECT pincho_idnombre, SUM( voto ) AS total FROM promociona GROUP BY pincho_idnombre) as minimo  where minimo.total = ".$value;
		$result = mysqli_query($connectHandler, $query);
		if( mysqli_num_rows($result) == 1 ){
			$row = mysqli_fetch_assoc($result);
			$query = "UPDATE promociona SET esfinalista = 1 WHERE pincho_idnombre = '".$row["pincho_idnombre"]."'";
			
			$result = mysqli_query($connectHandler, $query);
		}
		else{
			$listAux = array();

		//consigo os votos populares de cada pincho empatado e gardoos en un array
			while($row = mysqli_fetch_assoc($result)){
				$query = "SELECT pincho_idnombre, COUNT(*) AS votos FROM vota WHERE pincho_idnombre ='".$row["pincho_idnombre"]."' GROUP BY pincho_idnombre";
				$arrayAux = mysqli_query($connectHandler, $query);
				if( mysqli_num_rows($arrayAux) == 1 ){
					$aux = mysqli_fetch_assoc($arrayAux);
					$listAux[$aux["pincho_idnombre"]] = $aux["votos"];
				}
			}

			if(empty($listAux)){
				$query = "SELECT pincho_idnombre, SUM( voto ) AS total FROM promociona GROUP BY pincho_idnombre ORDER BY total DESC LIMIT ".$num.";";
				$res = mysqli_query($connectHandler, $query) or die(mysqli_error());
				while($row = mysqli_fetch_assoc($res)){
					print_r($row);
					$query = "UPDATE promociona SET esfinalista = 1 WHERE pincho_idnombre = '".$row["pincho_idnombre"]."'";
					
					$result = mysqli_query($connectHandler, $query);
				}		
			}else{
				arsort($listAux);
				$i = 0;
				foreach ($listAux as $key => $valor) {
					if($i < $pinchosMenorVotosParaFinalista){
						$query = "UPDATE promociona SET esfinalista = 1 WHERE pincho_idnombre = '".$key."'";
						
						$result = mysqli_query($connectHandler, $query);
						$i++;
					}
					else{
						break;
					}
				}
				
				while( $i < $pinchosMenorVotosParaFinalista){
					$query = "SELECT * from (SELECT pincho_idnombre, SUM( voto ) AS total, SUM(esfinalista) as esfinalista FROM promociona GROUP BY pincho_idnombre) as minimo  where minimo.total = ".$value." and (esfinalista < 1 OR esfinalista IS NULL) LIMIT 1 " ;
					$result = mysqli_query($connectHandler, $query);
					$row = mysqli_fetch_assoc($result);
					$query = "UPDATE promociona SET esfinalista = 1 WHERE pincho_idnombre = '".$row["pincho_idnombre"]."'";
					
					$result = mysqli_query($connectHandler, $query);
					$i++;
				}
			}
		}

		return $result;
	}

	public static function crearFinalistas($num){
		global $connectHandler;
		//Teño que cambialo para coller os que teñe 1 en promociona.esfinalista
		$toRet = array();
		$query = "SELECT pincho_idnombre, SUM( voto ) AS total FROM promociona WHERE esfinalista = 1 GROUP BY pincho_idnombre ORDER BY total DESC LIMIT ".$num.";";
		$result = mysqli_query($connectHandler, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$toRet[$row["pincho_idnombre"]] = $row;
		}
		return $toRet;

	}

	public static function setGanadorProfesional($num){
		global $connectHandler;

		//Saco todos os pincho que podrian ser ganadoresProfesional pondo como limite o numero de ganadores indicado
		$query = "SELECT pincho_idnombre, SUM(voto) AS total FROM finalista GROUP BY pincho_idnombre ORDER BY total DESC LIMIT ".$num.";";
		$result = mysqli_query($connectHandler, $query);
		$votos = array();
		while ($row = mysqli_fetch_assoc($result)) {
			if(empty($votos[$row["total"]])){
				$votos[$row["total"]]=$row["total"];
			}
		}
		arsort($votos);
		$toTieBreak = array();

		foreach ($votos as $key => $value) {
			$query = "SELECT * from (SELECT pincho_idnombre, SUM(voto) AS total FROM finalista GROUP BY pincho_idnombre ORDER BY total DESC) as lista  where lista.total = ".$value;
			$result = mysqli_query($connectHandler, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$pincho_idnombre = $row["pincho_idnombre"];
				$query = "SELECT pincho_idnombre, COUNT(*) AS total FROM vota WHERE pincho_idnombre = '".$pincho_idnombre."';";
				$resultado = mysqli_query($connectHandler, $query);
				$rowed = mysqli_fetch_assoc($resultado);
				$toTieBreak[$value][$pincho_idnombre] = $rowed["total"];
				
				
			}	
		}
		
		foreach ($votos as $key => $value) {
			arsort($toTieBreak[$value]);
		}

		print_r($toTieBreak);echo "<br>";echo "<br>";
		$i = 0;
		foreach ($votos as $key => $value) {
			foreach ($toTieBreak[$key] as $key2 => $value2){
				if($i < $num){
					$i++;
					$queries = 'UPDATE finalista SET ganadorFinalista = '.$i.' WHERE pincho_idnombre = "'.$key2.'"';
					//echo $queries."<br>";
					$result = mysqli_query($connectHandler, $queries) or die("Fallou o por o puesto $i");
				}else{
					break;break;
				}
			}
		}
		//die();
		return $result;
	}


	

	public static function setGanadorPopular($num){
		global $connectHandler;

		//Saco todos os pincho que podrian ser ganadoresPopular pondo como limite o numero de ganadores indicado
		$query = "SELECT pincho_idnombre, COUNT( * ) AS total FROM vota GROUP BY pincho_idnombre ORDER BY total DESC LIMIT ".$num.";";
		$result = mysqli_query($connectHandler, $query);
		$votos = array();
		while ($row = mysqli_fetch_assoc($result)) {
			if(empty($votos[$row["total"]])){
				$votos[$row["total"]]=$row["total"];
			}
		}
		arsort($votos);
		$toTieBreak = array();

		foreach ($votos as $key => $value) {
			$query = "SELECT * from (SELECT pincho_idnombre, COUNT( * ) AS total FROM vota GROUP BY pincho_idnombre ORDER BY total DESC) as lista  where lista.total = ".$value;
			$result = mysqli_query($connectHandler, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$query = "SELECT pincho_idnombre, SUM(voto) AS total FROM promociona WHERE pincho_idnombre = '".$row["pincho_idnombre"]."';";
				$resultado = mysqli_query($connectHandler, $query);
				$rowed = mysqli_fetch_assoc($resultado);
				$toTieBreak[$value][$rowed["pincho_idnombre"]] = $rowed["total"];
			}	
		}
		
		foreach ($votos as $key => $value) {
			arsort($toTieBreak[$value]);
		}

		$i = 0;
		foreach ($votos as $key => $value) {
			foreach ($toTieBreak[$key] as $key2 => $value2){
				if($i < $num){
					$i++;
					$queries = 'UPDATE pincho SET ganadorPopular = '.$i.' WHERE idnombre = "'.$key2.'"';
					echo $queries."<br>";
					$result = mysqli_query($connectHandler, $queries) or die("Fallou o por o puesto $i");
				}else{
					break;break;
				}
			}
		}

		return $result;
	}

}