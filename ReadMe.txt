SmartYield

Mapping for SmartYield THis contains the fields needed for the Stand-alone version of the code.



ON YOUR SERVER 

BkgdReadPig.php 
  The command prompt is > php BkgdReadPig.php It displays no values if it is reading correctly. All changes are occuring inside the DB. Errors would cause display messages.

db.php 

  db.php contains the password info needed to connect the program to your MySQL database. You MUST change this to match your Database. I don't use a password; you probably should.

cacert.pem 
  cacert.pem contains the unique id needed for the 'https' part of DigitalAnimls' API. The BkgdReadPig.php contains the username/password




ON YOUR WEBSERVER 

PigMap.php needs to sit on a Webserver so that a browser can display the map that Google returns.