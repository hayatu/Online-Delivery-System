<!DOCTYPE html>
<html>
   <head>
       <title>Calculate the distance between two locations</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
       <style type="text/css">
            .formbg { background-color: #66CCFF; padding: 10px 0 10px 20px; color: #191919;
                    border-radius: 10px;  border: 2px solid #6D0839; width: 780px; margin: 0 auto;
            }
	   label { font-size: 18px; }
	   h1 {color: #003366;}
       </style>
   </head>

   <body>
      <?php 
      function getRouteDistance($source_adrs, $dest_adrs, $unit){

          // Your API Key
          $apiKey = 'Your_Google_API_Key';

          //Send request and receive json data
          // Geocoding API request with source address
          $s_geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$source_adrs.'&sensor=false&key='.$apiKey');
          $s_latlong = json_decode($s_geocode);

          // Geocoding API request with destinationaddress
          $d_geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$dest_adrs.'&sensor=false&key='.$apiKey');
          $d_latlong = json_decode($d_geocode);

          //Get latitude and longitude
          $lat1 = $s_latlong->results[0]->geometry->location->lat;
          $long1 = $s_latlong->results[0]->geometry->location->lng;
          $lat2 = $d_latlong->results[0]->geometry->location->lat;
          $long2 = $d_latlong->results[0]->geometry->location->lng;

          //Calculate the distance from latitude and longitude
          $theta = $long1 - $long2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515; 
          $unit = strtoupper($unit);

          // Convert unit and return distance
          if ($unit == "K") {
              return ($miles * 1.609344).' KM';
          } else {
              return $miles.' MI';
          }
      } 
      ?>
      <div class="form-group row formbg">
          <?php

          // display the distance between locations on web page
          if(($_POST['source'] != '') && ($_POST['destination'] != '')) {
              $source = $_POST['source'];
              $destination = $_POST['destination'];
              $unit = $_POST['unit'];
              $source_adrs = str_replace(' ', '+', $source);
              $dest_adrs = str_replace(' ', '+', $destination);
              $distance = getRouteDistance($source_adrs, $dest_adrs, $unit);
              if($distance != '') {
                echo 'Distance Between <b>'.$source.'</b> and <b>'.$destination.' : </b><b>'.$distance.'</b>'
                    .'<br/><br/>';
              }
          }
          ?>

          <form action="" method="post">
             <div class="form-group row">
                <label class="col-xs-3 col-form-label">Enter Source Address: </label>
                <div class="col-xs-5">
                 <input class="form-control" type="text" name="source" value="" placeholder="Source">
                </div>
             </div>
             <div class="form-group row">
                <label class="col-xs-3 col-form-label">Enter Destination Address: </label>
                <div class="col-sm-5">
                 <input class="form-control" type="text" name="destination" value="" placeholder="Destination">
                </div>
              </div>
              <div class="form-group row">
                 <label class="col-xs-3 col-form-label">Unit: </label>
                 <div class="col-sm-5">
                  <select name="unit" class="form-control">
                      <option value="k">Kilometer</option>
                      <option value="m">Mile</option>
                  </select>
              </div>
             </div>
             <div class="form-group row">
                 <label class="col-xs-3 col-form-label"> </label>
                  <div class="col-sm-5">
                   <input class="btn btn-primary" type="submit" value="Submit"/>
                  </div>
                </div>
          </form>
      </div>
 </body>
</html>