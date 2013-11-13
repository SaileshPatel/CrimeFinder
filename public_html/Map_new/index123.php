<!DOCTYPE html>
<html>
  <head>
   <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
   <meta name="robots" content="all">
	 <meta name="revisit-after" content="10mins">
	 <meta name="language" content="english" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="We help you find the safest route with the lowest areas of crime so cycling is easier for you.">
   <meta name="keywords" content="Crime Finder, HTML,CSS,XML,JavaScript,FlatUi,Crime,Finder,CrimeFinder,English, Nerds, YRS2013,YRS, 2013, YoungRewired,YoungRewiredState, young rewired state, Young Rewired State, Jaffas, Liza, Maley, Max, Matthew Boyce, Twitter,">
   <meta name="author" content="Max Solomon, Marley Plant, India Jane Barry, Edward Parkin, Matthew Boyce, Liza Amini, Sailesh Patel ">
   <meta charset="UTF-8">
   <meta charset="utf-8">
    <title>CrimeFinder | Map</title>
<link <link rel="stylesheet" type="text/css" href="http://crimefinder.co.uk/files/StyleSheets/Main.css">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    
    <script>
// Adding 500 Data Points
var map, pointarray, heatmap;
var curLat = 52;
var curLng = -1;

var crimeData = [];

var directionDisplay;
var directionsService = new google.maps.DirectionsService();



if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) { 
       curLat = position.coords.latitude;
       curLng = position.coords.longitude;
    });
}
    
getCrimeData();


function initialize() {  
 
  var pointArray = new google.maps.MVCArray(crimeData);

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(map);
  heatmap.setOptions({radius: heatmap.get('radius') ? null : 20});
  
  //Makes alert div say done
  document.getElementById("alert").innerHTML = "Done! Thanks for your patience.";
  
}


function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]
  heatmap.setOptions({
    gradient: heatmap.get('gradient') ? null : gradient
  });
}

function changeRadius() {
  heatmap.setOptions({radius: heatmap.get('radius') ? null : 20});
}

function changeOpacity() {
  heatmap.setOptions({opacity: heatmap.get('opacity') ? null : 0.2});
}






function getCrimeData(){

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function (position) {
            curLat = position.coords.latitude;
            curLng = position.coords.longitude;
            
             var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng(curLat, curLng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
    directionsDisplay = new google.maps.DirectionsRenderer();
  
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      
      directionsDisplay.setMap(map);
var marker = new google.maps.Marker({
  position: new google.maps.LatLng(curLat, curLng), 
  map: map,
  title: 'My workplace',
  clickable: false,
  icon: 'cycling.png'
}); 
      
      
            document.getElementById("alert").innerHTML = "Getting your crime data - just one second, please!";
            $.ajax({
                type: "POST",
                url: "getCrimeData.php",
                data: {
                    x: position.coords.latitude,
                    y: position.coords.longitude
            },
            success: function (data) {
    
                var c = $.parseJSON(data);
                var pointslat = new Array();
                var pointlng = new Array();
                for(var i=0; i<c.length;i++){
                    var x = new google.maps.LatLng( c[i].location.latitude, c[i].location.longitude);
                    crimeData.push(x);
                }
                
                document.getElementById("alert").innerHTML = "Creating Heat Map";
                initialize();
        
             }
            });
        });

        
        
    }
}

 function calcRoute() {
    var start = document.getElementById('start').value;
    var end = document.getElementById('end').value;
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.BICYCLING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }else{
        alert("Error. Either of the places entered can not be found, please check that they are entered correctly");
      }
    });
  }
    </script>
  </head>

  <body>
  <div class= "buttonplace">
  <center>
    <div id="panel">
    <br>
      <button class="buttonMap" onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button class="buttonMap" onclick="changeGradient()">Change gradient</button>
      <button class="buttonMap" onclick="changeRadius()">Change radius</button>
      <button class="buttonMap" onclick="changeOpacity()">Change opacity</button>
      <button class="buttonMap" onclick="getCrimeData()">Get Crime Data</button>
    </div>
    <br>
    <div id="map-canvas" style="width:500px; height:500px;"></div>
    <div id="alert"></div>
    <div id="start"></div>
    <div id="end"></div>
    <div id= "alert"><input class="InputText" id="start" placeholder= "Start"></input> to <input class="InputText" id="end" placeholder= "End" /></div><button class="buttonMap" onclick="calcRoute()">Calculate Route</button>
 </body>
  </center>
  </div>
</html>