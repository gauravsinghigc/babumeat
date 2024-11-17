<?php
//POST DATA
function POST($data)
{
 $results = SECURE(htmlentities($_POST["$data"]), "e");
 if ($_POST["$data"] == null or $_POST["$data"] == "") {
  return null;
 } else {
  return $results;
 }
}


//GET DATA
function GET($data)
{
 $results = SECURE(htmlentities($_GET["$data"]), "e");
 if ($_GET["$data"] == null or $_GET["$data"] == "") {
  return null;
 } else {
  return $results;
 }
}

//Request DATA
function REQUEST($data)
{
 $results = SECURE(htmlentities($_REQUEST["$data"]), "e");
 if ($_REQUEST["$data"] == null or $_REQUEST["$data"] == "") {
  return null;
 } else {
  return $results;
 }
}

//if request
function IfRequested($method = "GET", $name, $sec = true)
{

 //check request and return values via get
 if ($method == "GET") {
  if (isset($_GET["$name"])) {
   $RequestedValue = $_GET["$name"];
  } else {
   $RequestedValue = null;
  }

  // check request and return values vai post
 } elseif ($method == "POST") {
  if (isset($_POST["$name"])) {
   $RequestedValue = $_POST["$name"];
  } else {
   $RequestedValue = null;
  }

  //check request and return values via any request
 } elseif ($method == "REQUEST") {
  if (isset($_POST["$name"])) {
   $RequestedValue = $_REQUEST["$name"];
  } else {
   $RequestedValue = null;
  }

  //with no request 
 } else {
  $RequestedValue = null;
 }

 //securiyt or enct
 if ($sec == true) {
  $RequestedValue = SECURE($RequestedValue, "e");
 } elseif ($sec == false) {
  $RequestedValue = $RequestedValue;
 } else {
  $RequestedValue = $RequestedValue;
 }

 return $RequestedValue;
}
