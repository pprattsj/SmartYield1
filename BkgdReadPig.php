<?php
// Pulling data from Digitanimal to store in Database.
//$url = 'http://35.165.31.250/digitanimal3/digitanimal/php/api/get_digitanimal_devices.php';

include 'db.php';

/* Debug Tool
   Read the current count of records to show accessibilty of the DB
$ar= array();
  $query = sprintf('Select count(collar_id) as thecount from PigTracker');
    $results = $GLOBALS['DB']->query($query); //mysql_query($query,$GLOBALS['DB']); 
 
 
   while($row = $results->fetch_assoc()) {
        $thecount = $row["thecount"];        
    }
   echo "DataPoint Count : ".$thecount."\n";
*/ 
   
//Fetch Data
$url='https://digitanimalapp.com/api/get_digitanimal_devices.php';

$username ='vincentfh';
$password = 'kimuras2m';

while ( true) {   //infinite loop

//Debug tool 
//echo time();

$ch = curl_init();

if (curl_setopt($ch, CURLOPT_URL, $url) === false) { echo "url opt1 failed<br>";}
if (curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)=== false) { echo "url opt2 failed<br>";};
if (curl_setopt($ch, CURLOPT_USERPWD, "$username:$password")=== false) { echo "url opt3 failed<br>";};
if (curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC)=== false) { echo "url opt4 failed<br>";};
if (curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem") == false )  { echo "url opt5 failed<br>";};     

if (( $output = curl_exec($ch)) === false )
     {echo "url opt6 failed: ".curl_errno($ch)."<br>".curl_error($ch)."<br>"; }
else {
	 curl_close($ch);
     $contents = utf8_encode($output); 
	 $current_collars = json_decode($contents);
  	 foreach ($current_collars->{"data"}->{"devices"} as $collar) {
		   $collarid = $collar->DEVICE_COLLAR;
		   $collartime= $collar->DEVICE_TIME;
		   $collarlat = $collar->LAT;
		   $collarlng = $collar->LNG;
		   //debug tool
		   // echo $collarid.":::".$collartime.":::".$collarlat.":::".$collarlng."\n" ; 
		   $query = sprintf( 
		                 "INSERT INTO PigTracker (Collar_ID, Timestamp, Lat, Lng)
                          VALUES ('%s','%s',%s,%s)",$collarid,
						  $collartime,
						  $collarlat,
						  $collarlng );   
		//echo $query."\n";
           if (!( $results = $GLOBALS['DB']->query($query) )) 
              {  if ($GLOBALS['DB']->errno == 1062){
				   //debug tool
				   // echo $collarid." repeat record ignored\n";
				 }
				 else {
				  die("failed:".$GLOBALS['DB']->errno."::".mysqli_error($GLOBALS['DB']));
				 }
			}
			else
				 {
				  //debug tool
				  //echo $collarid." inserted\n";
				 }       
	   }

	 };
 sleep(600); //Wait 10 minutes (600 seconds) Then repeat.
}

?>