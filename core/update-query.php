<?php
//order highlights table creations
$orderhighlights = "CREATE TABLE IF NOT EXISTS `visitors` (
  `VisitorsId` int(100) NOT NULL AUTO_INCREMENT,
  `VisitorsIP` varchar(1000) NOT NULL,
  `VisitorDeviceType` varchar(200) NOT NULL,
  `VisitorsType` varchar(100) NOT NULL,
  `VisitorDeviceDetails` varchar(10000) NOT NULL,
  `VisitorVisitingDate` varchar(200) NOT NULL,
  `VisitorCustomerId` varchar(100) NOT NULL,
  PRIMARY KEY (`VisitorsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$UpdateQueryResponse = mysqli_query($DBConnection, $orderhighlights);
