<?php
/* 
 * order.php
 * Assignment4: order page
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
	session_start();

	$jsonParam = "";
	$errorMessage = empty($_SESSION['errorMessage']) ? "" : $_SESSION['errorMessage'];
	$checkedItemList;
	$decodeParam;
	if(!empty($errorMessage))
	{

		if(empty($_SESSION['jsonParam']))
		{
			//$_SESSION['errorMessage'] = "You are trying to access in abnormal way. please start with our TOP page.";
			header("location:index.php");
			exit;
		}
		
		$jsonParam = $_SESSION['jsonParam'];
		$decodeParam = json_decode($jsonParam, true);
		
		if(empty($decodeParam["checkedItemList"]) || empty($decodeParam["orderInfo"]))
		{
			//$_SESSION['errorMessage'] = "You are trying to access in abnormal way. please start with our TOP page.";
			header("location:index.php");
			exit;
		}
		
		$checkedItemList = $decodeParam["checkedItemList"];
		$orderInfo = $decodeParam["orderInfo"];
	}
	else
	{

		if(empty($_POST['jsonParam']))
		{
			//$_SESSION['errorMessage'] = "You are trying to access in abnormal way. please start with our TOP page.";
			header("location:index.php");
			exit;
		}
		
		$jsonParam = $_POST['jsonParam'];
		$_SESSION["jsonParam"] = $jsonParam;
		$decodeParam = json_decode($jsonParam, true);
		
		if(empty($decodeParam["checkedItemList"]) || empty($decodeParam["orderInfo"]))
		{
			$_SESSION['errorMessage'] = "You should choose at least one item.";
			header("location:index.php");
			exit;
		}	
		
		$checkedItemList = $decodeParam["checkedItemList"];
		$orderInfo = $decodeParam["orderInfo"];
		$messageArray = array();
		foreach($checkedItemList as $item)
		{
			
			if(!is_numeric($item["quantity"]))
			{
				array_push($messageArray, "You should enter a number between 1 and 9.");
				continue;
			}

			if(intval($item["quantity"]) != floatval($item["quantity"]))
			{
				array_push($messageArray, "You should enter an integer between 1 and 9.");
				continue;
			}
			
			if($item["quantity"] < 1 || $item["quantity"] > 9)
			{
				array_push($messageArray, "The quantity should be between 1 and 9.");
				continue;
			}
			
		}
		
		$message = "";
		for($i=0; $i<count($messageArray); $i++)
		{
			if($i!=0)
			{
				$message = $message."<BR>";
			}
			$message = $message.$messageArray[$i];
		}

		if(!empty($message))
		{
			$_SESSION['errorMessage'] = $message;
			header("location:index.php");
			exit;
		}

	}

	require "getData.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>G8Games || Order</title>
    <link rel="icon" type="image/ico" href="img/favicon.ico" alt="Logo"> <!-- Jay add -->
	<link rel="stylesheet" type="text/css" href="css/main.css"  />
    <link rel="stylesheet" type="text/css" href="css/order.css"  />
    <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
    <script src="js/order.js"></script>
</head>
<body>

    <!-- header start -->
	<?php include "header.html"; ?>
    <!-- header end -->

    <hr class="line" />
	
	<!-- section: display message -->
	<section id="messageArea">
	<?php 
		if(!empty($errorMessage))
		{
			echo "<div class='message'><h3>$errorMessage</h3></div>";
		}
	?>
	</section>

    <!-- main start -->
    <main>
        <div id="progressbar"><img src="img/progressbar1.png" alt="Progress Bar" width="980px"></div>

        <form name="orderForm" action="confirm.php" method="post">
            <div id="shippingInfo">
                <fieldset id="fieldset">
                    <legend id="legend">Shipping Address</legend>

                    <table>
                        <tr>
                            <td><label id="firstNameLB" class="required">First Name:</label></td>
                            <td><input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($orderInfo['firstName']); ?>" onblur="this.value = RemoveWhiteSpace(this.value); this.value = Capitalize(this.value);"></td>
                        </tr>

                        <tr>
                            <td><label id="lastNameLB" class="required">Last Name:</label></td>
                            <td><input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($orderInfo['lastName']); ?>" onblur="this.value = RemoveWhiteSpace(this.value); this.value = Capitalize(this.value);"></td>
                        </tr>

                        <tr>
                            <td><label id="addressLB" class="required">Address:</label></td>
                            <td><input type="text" name="address" id="address" value="<?php echo htmlspecialchars($orderInfo['address']); ?>" onblur="this.value = RemoveWhiteSpace(this.value); this.value = ToUpper(this.value);"></td>
                        </tr>

                        <tr>
                            <td><label id="cityLB" class="required">City:</label></td>
                            <td><input type="text" name="city" id="city" value="<?php echo htmlspecialchars($orderInfo['city']); ?>" onblur="this.value = RemoveWhiteSpace(this.value); this.value = ToUpper(this.value);"></td>
                        </tr>

                        <tr>
                            <td><label id="provinceLB" class="required">Province:</label></td>
                            <td>
								<select id="province" name="province">
									<option value="">Choose a province</option>
								<?php
								
									foreach($provinceList as $province)
									{
										$selected = !empty($orderInfo['province']) && $orderInfo['province'] == $province['provinceCD'] ? "selected" : ""; 
										echo "<option value='".$province["provinceCD"]."' ".$selected." >".$province["provinceNM"]."</option>";
									}
								?>
								</select>
                            </td>
                        </tr>

                        <tr>
                            <td><label id="zipcodeLB" class="required">Zipcode:</label></td>
                            <td><input type="text" name="zipcode" id="zipcode" value="<?php echo htmlspecialchars($orderInfo['zipcode']); ?>" placeholder="ex) A1AB2B" onblur="this.value = RemoveWhiteSpace(this.value); this.value = ToUpper(this.value);"></td>
                        </tr>

                        <tr>
                            <td><label id="phoneLB" class="required">Phone Number:</label></td>
                            <td><input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($orderInfo['phone']); ?>" placeholder="ex) 1002003456" onblur="this.value = RemoveWhiteSpace(this.value);"></td>
                        </tr>

                        <tr>
                            <td><label id="emailLB" class="required">Email:</label></td>
                            <td><input type="text" name="email" id="email" value="<?php echo htmlspecialchars($orderInfo['email']); ?>" placeholder="ex) name@example.com" onblur="this.value = RemoveWhiteSpace(this.value);"></td>
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
								$itemTotal = 0;
								foreach($checkedItemList as $item)
								{
									$itemInfo = GetItemInfo($item["itemID"]);
									$itemTotal += floatval($item["price"]) * intval($item["quantity"]);
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
									<td class="bold blue">&nbsp;$&nbsp;<?php echo number_format($itemTotal, 2); ?></td>
								</tr>
                        </tbody> 
                       </table>
                </fieldset>
            </div>
            <br>
            <div>
                <input type="button" id="back" value="Back">
                <input type="submit" id="checkout" value="Conditue Checkout">
            </div>
			<input type="hidden" id="itemTotal" value="<?php echo $itemTotal; ?>" />
			<input type="hidden" name="jsonParam" id="jsonParam" value='<?php echo $jsonParam; ?>' />
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

