<?php
//date formates
function DATE_FORMATE($format, $date)
{
 $newdateformate = date("$format", strtotime($_REQUEST["$date"]));
 return $newdateformate;
}

//date formates
function DATE_FORMATE2($format, $date)
{
 $newdateformate = $date;
 if ($date == null  || $date == "") {
  $newdateformate = "No Update";
 } else {
  $newdateformate = date("$format", strtotime($date));
 }
 return $newdateformate;
}
