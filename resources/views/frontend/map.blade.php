<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', app_name())">
        <meta name="author" content="@yield('meta_author', 'Valid Works')">
        @yield('meta')

        <!-- Styles -->
        <style>
		  /* Always set the map height explicitly to define the size of the div
		   * element that contains the map. */
		  #map {
			height: 100%;
		  }
		  /* Optional: Makes the sample page fill the window. */
		  html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		  }
		</style>
    </head>
    <body>
        <div id="map"></div>
		<script>

	  function initMap() {

		var map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 13,
		  center: {lat: 2.910232, lng: 101.654659}
		});

		// Create an array of alphabetical characters used to label the markers.
		var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// Add some markers to the map.
		// Note: The code uses the JavaScript Array.prototype.map() method to
		// create an array of markers based on a given "locations" array.
		// The map() method here has nothing to do with the Google Maps API.
		var markers = locations.map(function(location, i) {
		  return new google.maps.Marker({
			position: location,
			label: labels[i % labels.length]
		  });
		});

		// Add a marker clusterer to manage the markers.
		var markerCluster = new MarkerClusterer(map, markers,
			{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	  }
	  var locations = [
		{lat: 2.910232, lng: 101.654659},
        {lat: 2.912941, lng: 101.656260},
        {lat: 2.914152, lng: 101.651217},
        {lat: 2.906440, lng: 101.656255},
        {lat: 2.911167, lng: 101.656615},
        {lat: 2.915470, lng: 101.657450},
        {lat: 2.914917, lng: 101.675760},
        {lat: 2.913721, lng: 101.683677},
	  ]
	</script>
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
	</script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPl9YmWREYZ6FLFa03YVXp4rH92uAtBJY&callback=initMap">
	</script>
  </body>
</html>
