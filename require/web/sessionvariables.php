<?php
if (isset($_SESSION['LOGIN_CustomerId'])) {
  $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];

  define("LOGIN_CustomerId", $_SESSION['LOGIN_CustomerId']);
  define("LOGIN_CustomerName", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerName"));
  define("LOGIN_CustomerEmailid", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerEmailid"));
  define("LOGIN_CustomerPassword", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerPassword"));
  define("LOGIN_CustomerPhoneNumber", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerPhoneNumber"));
  define("LOGIN_CustomerStreetAddress", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerStreetAddress"));
  define("LOGIN_CustomerArea", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerArea"));
  define("LOGIN_CustomerVillageBlock", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerVillageBlock"));
  define("LOGIN_CustomerCity", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerCity"));
  define("LOGIN_CustomerState", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerState"));
  define("LOGIN_CustomerPincode", FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerPincode"));
}
