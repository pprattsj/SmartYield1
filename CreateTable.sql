
Create database 'pigtracker';


CREATE TABLE 'PigTracker' (
  'Collar_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
                             `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                             `Lat` float(14,9) NOT NULL,
                             `Lng` float(14,9) NOT NULL
						)
 ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `PigTracker`
  ADD KEY `CollarTime` (`Timestamp`);


COMMIT;
