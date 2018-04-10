<!DOCTYPE html>
<!--      
 //Apache 2.4.9
 //php 5.5.12
 //mySQL 5.6.17
 //Author: Paul Pratt
 //Date: 4-2-2018
-->
<html>
  <head>
    <meta charset="utf-8">
    <title>HI Pig Heatmap</title>
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
      #floating-panel {
        position: relative;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        border-radius: 40px 40px 10px 10px;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 25%;
        padding: 5px;
        position: absolute;
        top: 10px;
        z-index: 5;
      }
    </style>
  </head>

  <body>
  

   
    <div id="floating-panel">
      <center><h1>PIG   MAP  Of   HAWAII</h1></Center>
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
    </div>


    <div id="map"></div>

    <script>

      // This example requires the Visualization library. Include the libraries=visualization
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">

      var map, heatmap;

//button Function
//  calls initMap() implicitly 
      function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }
	  
//button Function
//  calls initMap() implicitly 
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
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }
//button Function
//  calls initMap() implicitly 
      function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }
//button Function  
//  calls initMap() implicitly 
      function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }


      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 20.50, lng: -155.797004051},
          mapTypeId: 'satellite'
        });
		// Debug tool
        //document.getElementById("LatLng").innerHTML = getPoints();
        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getDBPoints(),
          map: map
        });
        heatmap.set('radius',20);
      }

      // Heatmap data: 500 Points
      function getDBPoints() {
      
       var datapoints = [];
	     // fetch the datapoint from DB 
		 <?php 
            include 'db.php';
  
            session_start();
            ob_start();
            //$start=time();
           $ar= array();
           $query = sprintf('Select lat as lat, lng as lng from PigTracker');

           $results = $GLOBALS['DB']->query($query); 
 
           while($row = $results->fetch_assoc()) {
              array_push($ar,$row["lat"] ,$row["lng"]);        
           }
     
           //  debug tool 
           //$end = time() ; $lapse = $start - $end; 
           //echo "<br>  read db took ".$lapse . " seconds! ". $ar[0].",". $ar[1]

           echo 'datapoints.push('.$ar[0].');'; 
	           for ($x = 1; $x < count($ar) ; $x++) {  
			      echo 'datapoints.push('.$ar[$x].');';
		       } 
		 ?> 
        
         var ar =  [ ];                  
         var i = 0;
         
         for (;datapoints[i];) {
		 //  debug tool
		 // var text = "Datapoints ";"
         // text += i+ ":"+  datapoints[i] +","+ datapoints[i+1];
         //  text=datapoints[1];
           
           ar.push( new google.maps.LatLng( datapoints[i], datapoints[i+1]));
		  //  debug tool 
          // document.getElementById("LatLng").innerHTML = ar;
           i++;i++;
         }
 
         return   ar; 
         
      }
      

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHiHDBe2J3NznstkbbXYHNnsFhJAltl14&libraries=visualization&callback=initMap">
	    //  Key= must be replaced with SmartYeild's key
		//  calls initMap() explicitly 
    </script>
  </body>
</html>