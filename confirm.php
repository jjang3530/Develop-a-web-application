<?php
/* 
 * confirm.php
 * Assignment4: confirm page
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
	
	$_SESSION['jsonParam'] = $jsonParam;
	$decodeParam = json_decode($jsonParam, true);
	
	if(empty($decodeParam["checkedItemList"]) || empty($decodeParam["orderInfo"]) || empty($decodeParam["summaryInfo"]))
	{
		//$_SESSION['errorMessage'] = "You are trying to access in abnormal way. please start with our TOP page.";
		header("location:index.php");
		exit;
	}		

	$checkedItemList = $decodeParam["checkedItemList"];
	$orderInfo = $decodeParam["orderInfo"];
	$summaryInfo = $decodeParam["summaryInfo"];
	$messageArray = array();
	
	if(empty($orderInfo["firstName"]))
	{
		array_push($messageArray, "First Name is required.");
	}else{
	
		if(strlen(trim($orderInfo["firstName"])) > 30)
		{
			array_push($messageArray, "First Name must be less than 30 characters in length.");
		}
	}

	if(empty($orderInfo["lastName"]))
	{
		array_push($messageArray, "Last Name is required.");
	}else{
	
		if(strlen(trim($orderInfo["lastName"])) > 30)
		{
			array_push($messageArray, "Last Name must be less than 30 characters in length.");
		}
	}

	if(empty($orderInfo["address"]))
	{
		array_push($messageArray, "Address is required.");
	}else{
	
		if(strlen(trim($orderInfo["address"])) > 50)
		{
			array_push($messageArray, "Address must be less than 50 characters in length.");
		}
	}

	if(empty($orderInfo["city"]))
	{
		array_push($messageArray, "City is required.");
	}else{
	
		if(strlen(trim($orderInfo["city"])) > 30)
		{
			array_push($messageArray, "City must be less than 30 characters in length.");
		}
	}

	if(empty($orderInfo["province"]))
	{
		array_push($messageArray, "Province is required.");
	}

	if(empty($orderInfo["zipcode"]))
	{
		array_push($messageArray, "Zipcode is required.");
	}else{
	
		if(strlen(trim($orderInfo["zipcode"])) != 6)
		{
			array_push($messageArray, "Zipcode must be 6 characters in length.");
		}else{

			if(!preg_match_all("/[A-z]{1}\d{1}[A-z]{1}\d{1}[A-z]{1}\d{1}/", $orderInfo["zipcode"]))
			{
				array_push($messageArray, "Zipcode is not formatted correctly.");
			}
		}
	}

	if(empty($orderInfo["phone"]))
	{
		array_push($messageArray, "Phone Number is required.");
	}else{
	
		if(strlen(trim($orderInfo["phone"])) != 10)
		{
			array_push($messageArray, "Phone Number must be 10 characters in length.");
		}else{
			if(!preg_match('/[0-9]{10}/', $orderInfo["phone"]))
			{
				array_push($messageArray, "Phone Number is not formatted correctly.");
			}
		}
	}	
	
	if(empty($orderInfo["email"]))
	{
		array_push($messageArray, "Email is required.");
	}else{
	
		if(strlen(trim($orderInfo["email"])) > 50)
		{
			array_push($messageArray, "Email must be less than 50 characters in length.");
		}else{
			
			if(!preg_match('/[A-z0-9]+[\-\.\_]?[A-z0-9]+[\@]{1}[A-z0-9]{2,}[\.]+[A-z0-9]{2,}/', $orderInfo["email"]))
			{
				array_push($messageArray, "Email is not formatted correctly.");
			}
		}
	}	

	
	if(!empty($messageArray))
	{
		$message = "";
		for($i=0; $i<count($messageArray); $i++)
		{
			if($i!=0)
			{
				$message = $message."<BR>";
			}
			$message = $message.$messageArray[$i];
		}
		
		$_SESSION['errorMessage'] = $message;
		header("location:order.php");
		exit;
	}


	$itemTotal = empty($summaryInfo["itemTotal"]) ? 0 : floatval($summaryInfo["itemTotal"]);
	require "getData.php";
		
	$summaryInfo = GetSummaryInfo($orderInfo["province"], $itemTotal);
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>G8Games || Confirmation</title>
    <link rel="icon" type="image/ico" href="img/favicon.ico" alt="Logo"> <!-- Jay add -->
	<link rel="stylesheet" type="text/css" href="css/main.css"  />
    <link rel="stylesheet" type="text/css" href="css/confirm.css" />
	<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
	<script src="js/confirm.js"></script>
</head>

<body>

    <!-- header start -->
	<?php include "header.html"; ?>
    <!-- header end -->

    <!-- main start -->
    <main>
	<form name="confirmForm" action="receipt.php" method="post">
        <div id="progressbar"><img src="img/progressbar2.png" alt="Progress Bar" width="980px"></div>

            <div id="shippingInfo">
                <fieldset id="fieldset">
                    <legend id="legend">Shipping Address</legend>

                    <table>
                        <tr>
                            <td><label id="firstNameLB">First Name:</label></td>
                            <td><?php echo $orderInfo["firstName"]; ?></td>
                        </tr>

                        <tr>
                            <td><label id="lastNameLB">Last Name:</label></td>
							<td><?php echo $orderInfo["lastName"]; ?></td>
                        </tr>

                        <tr>
                            <td><label id="addressLB">Address:</label></td>
							<td><?php echo $orderInfo["address"]; ?></td>
                        </tr>

                        <tr>
                            <td><label id="cityLB">City:</label></td>
							<td><?php echo $orderInfo["city"]; ?></td>
                        </tr>

                        <tr>
                            <td><label id="provinceLB">Province:</label></td>
							<td><?php echo $orderInfo["province"]; ?></td>
                        </tr>

                        <tr>
                            <td><label id="zipcodeLB">Zipcode:</label></td>
							<td><?php echo $orderInfo["zipcode"]; ?></td>
                        </tr>

                        <tr>
                            <td><label id="phoneLB">Phone Number:</label></td>
							<td><?php echo $orderInfo["phone"]; ?></td>
                        </tr>

                        <tr>
                            <td><label id="emailLB">Email:</label></td>
							<td><?php echo $orderInfo["email"]; ?></td>
                        </tr>

                    </table>
                </fieldset>
            </div>

            <div id="items">
                <fieldset id="fieldset">
                    <legend id="legend">Order Item</legend>
                    <table class="itemListTbl">
                        <thead>
                            <tr class="tblHeader">
                                <th colspan="2" class="itemTh">ITEM</th>
                                <th class="quantityTh">QUANTITY</th>
                                <th class="priceTh">PRICE</th>
                                <th class="TotalTh">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody id="orderItem"> <!-- order item list-->
							<?php 

								foreach($checkedItemList as $item)
								{
									$itemInfo = GetItemInfo($item["itemID"]);
							?>
								<tr>
									<td width="100px"><img src="<?php echo $itemInfo["imgAddr"]; ?>" alt="G8Games_logo" style="width:100px"></td>
									<td><?php echo $itemInfo["title"]; ?></td>
									<td><?php echo $item["quantity"]; ?></td>
									<td>$&nbsp;<?php echo number_format($item["price"], 2); ?></td>
									<td>$&nbsp;<?php echo number_format($item["price"] * $item["quantity"], 2); ?></td>
								</tr>							
							<?php
								}
							?>
								<tr class="total">
									<td style="border-left-color:white; border-bottom-color:white;" colspan="3"></td>
									<td class="bold blue" >ITEM TOTAL</td>
									<td class="bold blue">&nbsp;$&nbsp;<?php echo number_format($summaryInfo["itemTotal"], 2); ?></td>
								</tr>
								<tr class="total">
									<td style="border-left-color:white; border-bottom-color:white;" colspan="3"></td>
									<td class="bold blue" >TAX(<?php echo $orderInfo["province"]; ?>:<?php echo ($summaryInfo["taxRate"]*100)."%"; ?>)</td>
									<td class="bold blue">&nbsp;$&nbsp;<?php echo number_format($summaryInfo["itemTotal"]*$summaryInfo["taxRate"], 2);?></td>
								</tr>								
								
                        </tbody> 
                       </table>
                </fieldset>
            </div>


            <div id="ShippingCost">
                <fieldset id="fieldset">
                    <legend id="legend">Delivery </legend>
                    <table class="shippingCostTbl">
						<tr class="total">
							<td class="bold blue shippingTd"  >Estimated Delivery Date: <?php echo $summaryInfo["deliveryDate"]; ?></td>
							<td class="bold blue center" >DELIVERY</td>
							<td class="bold blue center">&nbsp;$&nbsp;<?php echo number_format($summaryInfo["deliveryCost"], 2); ?></td>
						</tr>
                    </table>					
				</fieldset>
            </div>
            <br>
            <div>
				<table id="amount">
					<tr>
						<td>Amount Total&nbsp;:</td>
						<td>$&nbsp;<?php echo number_format($summaryInfo["totalPrice"], 2); ?></td>
					</tr>
				</table>
			</div>
            <br>
            <div id="submit" name="registForm">
                <input type="button" id="back" value="Back">
                <input type="submit" id="checkout" value="Complete Checkout">
				<input type="hidden" name="jsonParam" id="jsonParam" value='<?php echo $jsonParam; ?>' />
				<input type="hidden" id="itemTotal" value='<?php echo $summaryInfo["itemTotal"]; ?>' />
				<input type="hidden" id="taxRate" value='<?php echo $summaryInfo["taxRate"]; ?>' />
				<input type="hidden" id="deliveryCost" value='<?php echo $summaryInfo["deliveryCost"]; ?>' />
				<input type="hidden" id="totalPrice" value='<?php echo $summaryInfo["totalPrice"]; ?>' />
				<input type="hidden" id="deliveryDate" value='<?php echo $summaryInfo["deliveryDate"]; ?>' />
            </div>		
			
        </form>	
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

