Create database pigtracker;

CONNECT pigtracker;

CREATE TABLE pigtracker (
  Collar_ID varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  
                             Timestamp datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
                             Lat float(14,9) NOT NULL,
  
                             Lng float(14,9) NOT NULL
)
 ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE UNIQUE INDEX Collar_Time on pigtracker (collar_id,Timestamp);


COMMIT;
