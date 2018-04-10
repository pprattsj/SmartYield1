<?php
 //php 5.5.12
 //mySQL 5.6.17
 //Author: Paul Pratt
 //Date: 4-2-2018
 define ('DB_HOST', 'localhost');
 define('DB_USER','root');
 define('DB_PASSWORD','');
 define('DB_SCHEMA', 'PigTracker');

  $GLOBALS['DB']=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_SCHEMA );

 if (! $GLOBALS["DB"])
   {
     die('error:  unable to connect to a database');
        
   }

?>