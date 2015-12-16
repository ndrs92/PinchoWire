
var map;
function initMap() {
var myLatLng = {lat: <?= $lat ?>, lng: <?= $lng ?>};

// Create a map object and specify the DOM element for display.
var map = new google.maps.Map(document.getElementById('map'), {
center: myLatLng,
scrollwheel: false,
zoom: 17
});

// Create a marker and set its position.
var marker = new google.maps.Marker({
map: map,
position: myLatLng,
title: 'Hello World!'
});
}
