<?php
//require files
require '../../require/modules.php';

//page variables
if (isset($_GET['orderid'])) {
	$Orderid = SECURE($_GET['orderid'], "d");
	$_SESSION['VIEW_INVOICE_ID'] = $Orderid;
} else {
	$Orderid = $_SESSION['VIEW_INVOICE_ID'];
}

//invoice details;
$TxnIdInvoice = FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentReferenceId", false);
$NetPayableAmountInvoice = FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount", false);
$PaymentModeInvoice = FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderPaymentMode", false);
$PaymentDetailsInvoice = FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDetails", false);
$PaymentStatusInvoice = FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentStatus", false);
$PaymentDateInvoice = FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDate", false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "CustomOrderId"); ?>@<?php echo APP_NAME; ?></title>
</head>

<body onload="doConvert()" style="padding:2rem;color: black;font-size:13px !important;margin:auto;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;">

	<section style="border-style:groove; border-width:thin;margin: auto; width: 900px;border: 1px solid green;padding: 1rem;height:850px;">
		<center>
			<img src="<?php echo $MAIN_LOGO; ?>" style="width: 100px;">
			<h5 style="margin-bottom: 0px;margin-top: -2px;font-size:20px;"><?php echo APP_NAME; ?></h5>
			<p style="font-size: 13px;margin-bottom: 0px;margin-top: -2px;"><b>Office Address</b> <?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></p>
			<p style="font-size: 13px;margin-bottom: 0px;margin-top: -2px;">
				<b>Phone:</b> <?php echo PRIMARY_PHONE; ?>
				<b>Email:</b> <?php echo PRIMARY_EMAIL; ?>
				<b>Website:</b> <?php echo DOMAIN; ?>
			</p>
			<p style="margin-bottom: 0px;margin-top: -2px;"><b>GST No:</b> <?php echo PRIMARY_GST; ?></p>
			<br>
			<p style="margin-bottom: 0px;margin-top: -2px;background-color:lightgrey;padding:4px;"><b>INVOICE</b></p>
		</center>
		<br>
		<div style="display: flex;justify-content: space-between;">
			<p style="margin-bottom: 0px;margin-top: -2px;width: 35%;"><b>Shipping Address</b><br>
				<?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderShippingAddress"), "d"); ?>
			</p>
			<p style="margin-bottom: 0px;margin-top: -2px;width: 35%;"><b>Billing Address</b><br>
				<?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderBillingAddress"), "d"); ?>
			</p>
			<p style="margin-bottom: 0px;margin-top: -2px;width: 30%;">
				<span style="display: flex;justify-content: space-between;">
					<span><b>InvoiceNo:</b></span>
					<span> <?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "CustomOrderId"); ?></span>
				</span>
				<span style="display: flex;justify-content: space-between;">
					<span><b>Ref Id:</b></span>
					<span> <?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderReferenceid"); ?></span>
				</span>
				<span style="display: flex;justify-content: space-between;">
					<span><b>Order Date:</b></span>
					<span> <?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderCreateDate"); ?></span>
				</span>
				<span style="display: flex;justify-content: space-between;">
					<span><b>Invoice Amount:</b></span>
					<span>Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></span>
				</span>
				<span style="display: flex;justify-content: space-between;">
					<span><b>Payment Mode:</b></span>
					<span><?php echo $PaymentModeInvoice; ?></span>
				</span>
				<span style="display: flex;justify-content: space-between;">
					<span><b>Payment Date:</b></span>
					<span><?php echo $PaymentDateInvoice; ?></span>
				</span>
				<span style="display: flex;justify-content: space-between;">
					<span><b>Payment Status:</b></span>
					<span><?php echo $PaymentStatusInvoice; ?></span>
				</span>
			</p>
		</div>
		<p style="font-size: 13px;margin-bottom: 0px;margin-top: 10px;text-align:center;text-transform:uppercase;"><b>ITEM DETAILS</b></p>
		<hr style="margin-bottom: 1px;margin-top: 1px;background-color: #80808024;color: aquamarine;height: 1px;border: none;">
		<table style="width:100%;font-size:12px;">
			<thead style="background-color: #8080803d;">
				<tr>
					<th>S.No</th>
					<th>Img</th>
					<th>ItemDetails</th>
					<th>SellPrice</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>GST(Taxes)</th>
					<th>TotalPrice</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$fetchItems = SELECT("SELECT * FROM ordered_products where OrderOrderId='$Orderid' ORDER BY OrderProductId ASC");
				$CountSno = 0;
				while ($fetch = mysqli_fetch_array($fetchItems)) {
					$CountSno++; ?>
					<tr style="box-shadow: 0px 1px 0px 0px #8080800f;">
						<td><?php echo $CountSno; ?></td>
						<td align="center">
							<img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $fetch['OrderProductImage']; ?>" style="width: 32px;height: 32px;">
						</td>
						<td>
							<b style="font-size: 13px;"><?php echo $fetch['OrderProductName']; ?></b><br>
							<span>Item Code: <?php echo $fetch['ProductRefernceCodes']; ?></span>
							<br>
							<?php echo SECURE($fetch['OrderDetails'], "d"); ?>
						</td>
						<td align="center">
							Rs.<?php echo $fetch['OrderProductSellPrice']; ?>
						</td>
						<td align="center">
							x <?php echo $fetch['OrderProductQty']; ?>
						</td>
						<td align="center">
							Rs.<?php echo $SellingPrice = (int)$fetch['OrderProductSellAmount']; ?>
						</td>
						<td align="center">
							<?php
							$OrderProProductId = $fetch['OrderProProductId'];
							(int)$ProductApplicableTaxes = FETCH("SELECT * FROM products where ProductId='$OrderProProductId'", "ProductApplicableTaxes");
							(int)$TaxAmount = round($SellingPrice / 100 * $ProductApplicableTaxes);
							echo "+ Rs.$TaxAmount<br>
						GST $ProductApplicableTaxes %"; ?>
						</td>

						<td align="right">
							<b>Rs.<?php echo (int)$fetch['OrderProductSellAmount'] + $TaxAmount; ?></b>
						</td>
					<?php } ?>
			</tbody>
		</table>
		<hr style="margin-bottom: 3px;margin-top: 3px;background-color: #80808024;color: aquamarine;height: 1px;border: none;">
		<table style="width:100% !important;font-size:13px;text-align:right;">
			<tr>
				<th>Total Amount</th>
				<td style="font-size:13px;">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderAmount"); ?></td>
			</tr>
			<tr>
				<th>Delivery Charge</th>
				<td style="font-size:13px;">
					<?php if (FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges") == "Free") {
						echo "Free";
					} else {
						echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges");
					}; ?>
				</td>
			</tr>
			<tr>
				<th>Coupon Details</th>
				<td>
					<?php echo html_entity_decode(FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentCoupons")); ?>
				</td>
			</tr>
			<tr>
				<th>Net Payable Amount</th>
				<td style="font-size:15px;">
					<b>Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></b>
				</td>
			</tr>
		</table>
		<hr style="margin-bottom: 3px;margin-top: 3px;background-color: #80808024;color: aquamarine;height: 1px;border: none;">
		<p style="font-size: 13px;margin-bottom: 0px;margin-top: -2px;text-align:right;"><b>Amount in Words : </b> <span id="priceinwords"></span></p>
		<p style="font-size: 11px;margin-bottom: 0px;margin-top: 50px;text-align:center;">
			This is a computer generated invoice no need of physical signature
		</p>
	</section>

	<script>
		function doConvert() {
			var numberInput = <?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?>;


			var oneToTwenty = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ',
				'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '
			];
			var tenth = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

			if (numberInput.toString().length > 7) return myDiv.innerHTML = 'overlimit';
			console.log(numberInput);
			//let num = ('0000000000'+ numberInput).slice(-10).match(/^(\d{1})(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
			var num = ('0000000' + numberInput).slice(-7).match(/^(\d{1})(\d{1})(\d{2})(\d{1})(\d{2})$/);
			console.log(num);
			if (!num) return;

			var outputText = num[1] != 0 ? (oneToTwenty[Number(num[1])] || `${tenth[num[1][0]]} ${oneToTwenty[num[1][1]]}`) + ' million ' : '';

			outputText += num[2] != 0 ? (oneToTwenty[Number(num[2])] || `${tenth[num[2][0]]} ${oneToTwenty[num[2][1]]}`) + 'hundred ' : '';
			outputText += num[3] != 0 ? (oneToTwenty[Number(num[3])] || `${tenth[num[3][0]]} ${oneToTwenty[num[3][1]]}`) + ' thousand ' : '';
			outputText += num[4] != 0 ? (oneToTwenty[Number(num[4])] || `${tenth[num[4][0]]} ${oneToTwenty[num[4][1]]}`) + 'hundred ' : '';
			outputText += num[5] != 0 ? (oneToTwenty[Number(num[5])] || `${tenth[num[5][0]]} ${oneToTwenty[num[5][1]]} `) : '';

			document.getElementById("priceinwords").innerHTML = outputText;
		}
	</script>
</body>

</html>