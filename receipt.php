<?php
/* 
 * receipt.php
 * Assignment4: receipt page
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
	session_start();

	$jsonParam = empty($_POST['jsonParam']) ? "" : $_POST['jsonParam'];
	
	if(empty($jsonParam))
	{
		//$_SESSION['errorMessage'] = "You are trying to access in abnormal way. please start with our TOP page.";
		header("location:index.php");
		exit;
	}

	$decodeParam = json_decode($jsonParam, true);
	if(empty($decodeParam["orderInfo"]) || empty($decodeParam["checkedItemList"]) || empty($decodeParam["summaryInfo"]))
	{
		//$_SESSION['errorMessage'] = "You are trying to access in abnormal way. please start with our TOP page.";
		header("location:index.php");
		exit;		
	}
	
	$orderInfo = $decodeParam["orderInfo"];
	$checkedItemList = $decodeParam["checkedItemList"];
	$summaryInfo = $decodeParam["summaryInfo"];	
	require "getData.php";
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>G8Games || Receipt</title>
    <link rel="icon" type="image/ico" href="img/favicon.ico" alt="Logo"> <!-- Jay add -->
	<link rel="stylesheet" type="text/css" href="css/main.css"  />
    <link rel="stylesheet" type="text/css" href="css/receipt.css" />
	<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/receipt.js"></script>
</head>

<body>
    <!-- header start -->
	<?php include "header.html"; ?>
    <!-- header end -->
	
    <hr class="line" />

    <!-- main start -->
    <main>
        <div id="progressbar"><img src="img/progressbar3.png" alt="Progress Bar" width="980px"></div>
		<h2>&nbsp;&nbsp;Your order has been processed. Please verify the information.</h2><br>

		<div id="shippingInfo">
			<h3>Shipping To: </h3>
			<table id="receiptAddr">
				<tr>
					<td><?php echo $orderInfo["firstName"]."&nbsp;".$orderInfo['lastName']; ?></td>
				</tr>
				<tr>
					<td><?php echo $orderInfo["address"]; ?></td>
				</tr>
				<tr>
					<td><?php echo $orderInfo['city']."&nbsp;".$orderInfo['province']; ?></td>
				</tr>
				<tr>
					<td><?php echo $orderInfo["zipcode"]; ?></td>
				</tr>
				<tr>
					<td>Phone:&nbsp;<?php echo $orderInfo["phone"]; ?></td>
				</tr>
			</table>
		</div><br>

		<div id="items">
			<h3>Order Information: </h3>
			<table class="itemListTbl">
				<thead>
					<tr class="tblHeader">
						<th class="itemTh">ITEM</th>
						<th class="quantityTh">QUANTITY</th>
						<th class="priceTh">PRICE</th>
						<th class="TotalTh">TOTAL</th>
					</tr>
				</thead>
				<tbody id="orderItem"> <!-- order item list-->
					<?php 
						$itemTotal = 0;
						foreach($checkedItemList as $item)
						{
							$itemInfo = GetItemInfo($item["itemID"]);
							$itemTotal += floatval($item["price"]) * intval($item["quantity"]);
					?>
						<tr>
							<td><?php echo $itemInfo["title"]; ?></td>
							<td><?php echo $item["quantity"]; ?></td>
							<td>$&nbsp;<?php echo number_format($item["price"], 2); ?></td>
							<td>$&nbsp;<?php echo number_format($item["price"] * $item["quantity"], 2); ?></td>
						</tr>							
					<?php
						}
					?>
				</tbody> 
			</table>
			<br><br><br>

			<table id="amount" >
				<tr>
					<td class="textRight">Item Total:&nbsp;</td>
					<td>$&nbsp;<?php echo number_format($summaryInfo["itemTotal"], 2); ?></td>				
				</tr>
				<tr>
					<td class="textRight">Tax:&nbsp;</td>
					<td>$&nbsp;<?php echo number_format($summaryInfo["itemTotal"]*$summaryInfo["taxRate"], 2); ?></td>
				</tr>			
				<tr>
					<td class="textRight">Delivery:&nbsp;</td>
					<td>$&nbsp;<?php echo number_format($summaryInfo["deliveryCost"], 2); ?></td>
				</tr>
				<tr>
					<td class="textRight">Total:&nbsp;</td>
					<td>$&nbsp;<?php echo number_format($summaryInfo["totalPrice"], 2); ?></td>
				</tr>
			</table>
		</div>
		<br><br><br>
		<div class="receiptDiv">Estimated Delivery Date:&nbsp;<?php echo $summaryInfo["deliveryDate"];?></div>
		<div class="receiptDiv">
			<a href="index.php"><input type="button" value="HOME" class="btnSizeL"></a>
		</div>
        <div class="clear"></div>
    </main>
    <!-- main end -->
	
    <hr class="line" />

    <!-- footer start-->
	<?php include "footer.html"; ?>
    <!-- footer end -->

</body>
</html>
<?php session_unset(); ?>