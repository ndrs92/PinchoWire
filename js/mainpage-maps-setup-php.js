<?php
			//Procesar todos los establecimientos y sus geoloc
			//Se pasan las geolocs a un array particular
			//Se calcula la geoloc media
if(isset($establecimientos)){
	foreach($establecimientos as $e){
		$geoloc[$e->getIdemail()]["lat"] = explode(", ", $e->getGeoloc())[0];
		$latarray[$e->getIdemail()] = explode(", ", $e->getGeoloc())[0];
		$geoloc[$e->getIdemail()]["lng"] = explode(", ", $e->getGeoloc())[1];
		$lngarray[$e->getIdemail()] = explode(", ", $e->getGeoloc())[1];
	}	
}

?>

var map;

<?php
if(isset($establecimientos)){
	?>
	function initMap() {
	var myLatLng = {lat: <?= (min($latarray) + max($latarray)) /2 ?>, lng: <?= (min($lngarray) + max($lngarray)) /2 ?>};

	// Create a map object and specify the DOM element for display.
	var map = new google.maps.Map(document.getElementById('gastromapa-map'), {
	//Need to be set to... whatever, the first establishment inserted or something
	center: myLatLng,
	scrollwheel: false,
	zoom: 14
});

// Create a marker and set its position.
// needs one for each establishment in the database
<?php
foreach($geoloc as $key=>$g){
	?>
	var marker = new google.maps.Marker({
	map: map,
	position: {lat: <?= $g["lat"] ?> , lng: <?= $g["lng"] ?>},
	title: '<?= $key ?>'
});	
	<?php	  	
}
}
?>

}