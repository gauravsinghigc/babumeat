<?php

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

session_start();

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if ($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		$Transaction_Details = "";
		$TxnId = "";
		$GATEWAYNAME = "";
		$PAYMENTMODE = "";
		$STATUS  = "";
		$TXNDATE = "";
		$BANKTXNID = "";
		$TXNAMOUNT = "";
		if (isset($_POST) && count($_POST) > 0) {
			foreach ($_POST as $paramName => $paramValue) {
				$Transaction_Details .= "$paramName = $paramValue - ";
				if ($paramName == "TXNID") {
					$TxnId = $paramValue;
				}
				if ($paramName == "GATEWAYNAME") {
					$GATEWAYNAME = $paramValue;
				}
				if ($paramName == "PAYMENTMODE") {
					$PAYMENTMODE = $paramValue;
				}
				if ($paramName == "STATUS") {
					$STATUS = $paramValue;
				}
				if ($paramName == "TXNDATE") {
					$TXNDATE = $paramValue;
				}
				if ($paramName == "BANKTXNID") {
					$BANKTXNID = $paramValue;
				}
				if ($paramName == "TXNAMOUNT") {
					$TXNAMOUNT = $paramValue;
				}
			}
		}

		//end of success

	} else {
		//start failed transaction
		echo "<br>Transaction status is failure</>" . "<br/>";
		$Transaction_Details = "";
		$TxnId = "";
		$GATEWAYNAME = "";
		$PAYMENTMODE = "";
		$STATUS  = "";
		$TXNDATE = "";
		$BANKTXNID = "";
		$TXNAMOUNT = "";
		if (isset($_POST) && count($_POST) > 0) {
			foreach ($_POST as $paramName => $paramValue) {
				$Transaction_Details .= "$paramName = $paramValue - ";
				if ($paramName == "TXNID") {
					$TxnId = $paramValue;
				}
				if ($paramName == "GATEWAYNAME") {
					$GATEWAYNAME = $paramValue;
				}
				if ($paramName == "PAYMENTMODE") {
					$PAYMENTMODE = $paramValue;
				}
				if ($paramName == "STATUS") {
					$STATUS = $paramValue;
				}
				if ($paramName == "TXNDATE") {
					$TXNDATE = $paramValue;
				}
				if ($paramName == "BANKTXNID") {
					$BANKTXNID = $paramValue;
				}
				if ($paramName == "TXNAMOUNT") {
					$TXNAMOUNT = $paramValue;
				}
			}
		}

		//end failed
	}

	$PaymentMode = $PAYMENTMODE;
	$PaymentDetails = "TXN-ID : $TxnId";
	$PaymentStatus = $STATUS;
	$PaidAt = $TXNDATE;
	$PaymentSource = $GATEWAYNAME;
	$SubscriptionsAmount = $TXNAMOUNT;
	$NetPayableAmount = $TXNAMOUNT;
	$PaidAmount = $TXNAMOUNT;
	$CompleteDetails = $Transaction_Details;

	session_start();

	//Session Data
	$_SESSION['PAYMENT_STATUS'] = $PaymentStatus;
	$_SESSION['TXNID'] = $PaymentDetails;
	$_SESSION['PAYMENT_MODE'] = $PaymentMode;
	$_SESSION['PAYMENT_SOURCE'] = $PaymentSource;
	$_SESSION['COMPLETE_DETAILS'] = $CompleteDetails;

	setcookie("PAYMENT_STATUS", $_SESSION['PAYMENT_STATUS'], time() + 60 * 60 * 365);
	setcookie("TXNID", $_SESSION['TXNID'], time() + 60 * 60 * 365);
	setcookie("PAYMENT_MODE", $_SESSION['PAYMENT_MODE'], time() + 60 * 60 * 365);
	setcookie("PAYMENT_SOURCE", $_SESSION['PAYMENT_SOURCE'], time() + 60 * 60 * 365);
	setcookie("COMPLETE_DETAILS", $_SESSION['COMPLETE_DETAILS'], time() + 60 * 60 * 365);


	header("location: order_mail.php");

	//if hastags or checksum is mismatched!
} else {

	echo "<>Checksum mismatched.</>";
	//Process transaction as suspicious.
	header("location: finalcheckout.php");
}
