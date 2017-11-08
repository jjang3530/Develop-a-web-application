<?php 
/* 
 * index.php
 * Assignment4: index page
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
	session_start();
	
	$jsonParam = "";
	$errorMessage = empty($_SESSION['errorMessage']) ? "" : $_SESSION['errorMessage'];

	if(empty($errorMessage))
	{
		$jsonParam = empty($_POST['jsonParam']) ? "" : $_POST['jsonParam'];
	}
	else
	{
		$jsonParam = empty($_SESSION['jsonParam']) ? "" : $_SESSION['jsonParam'];
	}

	require "getData.php";
	
	$decodeParam = json_decode($jsonParam, true);
	$genreCD = empty($decodeParam["searchInfo"]["genreCD"]) ? "" : $decodeParam["searchInfo"]["genreCD"];
	$platformCD = empty($decodeParam["searchInfo"]["platformCD"]) ? "" : $decodeParam["searchInfo"]["platformCD"];
	$displayCount = empty($decodeParam["searchInfo"]["displayCount"]) ? "" : $decodeParam["searchInfo"]["displayCount"];
	$checkedItemList = empty($decodeParam["checkedItemList"]) ? "" : $decodeParam["checkedItemList"];

	$totalCount = GetItemListCount($genreCD, $platformCD);
	$resultList = GetItemList($genreCD, $platformCD, 0, $displayCount);
	$moreItemClass = $totalCount > count($resultList) ? "" : "invisible";
	$orderClass = "";
	if($totalCount == 0)
	{
		$orderClass = "invisible";
		$errorMessage = "Sorry, We don't have any item under the condition.<BR>Change the condition and search again, please. ";
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>G8Games || HOME</title>
	<link rel="icon" type="image/ico" href="img/favicon.ico" alt="Logo">
    <link rel="stylesheet" type="text/css" href="css/main.css"  />
	<link rel="stylesheet" type="text/css" href="css/index.css"  />
    <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
    <script src="js/index.js"></script>
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
		<form name="mainForm" action="order.php" method="POST">
			<div class="leftCol leftMenu">
					<h4>Genre</h4>
					<div>
						<select name="genreCD" id="genreCD" class="widthS">
							<option value=''></option>
							<?php
								for($i=0; $i<count($genreList); $i++)
								{
									$val = $i+1;
									$selected = !empty($genreCD) && $genreCD == $val ? "selected" : ""; 
									echo "<option value='$val' $selected >$genreList[$i]</option>";
								}
							?>
						</select>
					</div>
					<br />
					<h4>Platform</h4>
					<div>
						<select name="platformCD" id="platformCD" class="widthS">
							<option value=''></option>
							<?php
								for($i=0; $i<count($platformList); $i++)
								{
									$val = $i+1;
									$selected = !empty($platformCD) && $platformCD == $val ? "selected" : ""; 
									echo "<option value='$val' $selected>$platformList[$i]</option>";
								}
							?>
						</select>
					</div>
					<br />
					<input type="button" id="search" value="SEARCH" class="widthS" />
			</div>

			<div class="rightCol">
				<div id="itemList">
					<table id="mainTbl" class="leftAlign">
						<tr>
					<?php
						$columnCount = 0;
						foreach($resultList as $subArray)
						{
							$checked = "";
							$quantity = 1;
							$disabled = "disabled";
							if(!empty($checkedItemList))
							{
								foreach($checkedItemList as $checkedItem)
								{
									if($subArray["itemID"] == $checkedItem["itemID"]){
										$checked = "checked";
										$quantity = $checkedItem["quantity"];
										$disabled = "";
									}
								}								
							}
					?>
							<td>
								<table class="subTbl">
									<tr>
										<td>
											<img class="img_small" src="<?php echo $subArray['imgAddr'] ?>"  />
											<img class="invisible img_large" src="<?php echo $subArray['imgAddr'] ?>" />
										</td>
									</tr>
									<tr height="40px"><td><h4><?php echo $subArray['title']; ?></h4></td></tr>
									
									<tr>
										<td>
											<?php 
												for($i=0; $i<5; $i++)
												{
													$starAddr = $i < $subArray['rate'] ? "img\starOn.png" : "img\starOff.png";
											?>
													<img class="star" src="<?php echo $starAddr; ?>" />
											<?php		
												}
											?>
										</td>
									</tr>
									<tr><td><h4 class="red">CDN$&nbsp;<?php echo $subArray['price']; ?></h4></td></tr>
									<tr><td><?php echo $subArray['genre']; ?>&nbsp;/&nbsp;<?php echo $subArray['platform']; ?></td></tr>
									<tr>
										<td>
											<input type="button" class="btnDetail widthM" value="Detail" />
											<div class="invisible divDetail"><?php echo $subArray['detail']; ?></div>
										</td>
									</tr>
									<tr>
										<td>
											<input type="checkbox" class="ckbOrder" value="<?php echo $subArray['itemID']; ?>" <?php echo $checked; ?> />
											<input type="number" value="<?php echo $quantity; ?>" <?php echo $disabled; ?> min="1" max="9" step="1" class="widthXXS quantity" ondrop="return false;" onkeydown="return false;" />
											<input type="hidden" value="<?php echo $subArray['price']; ?>" />
										</td>
									</tr>
								</table>
							</td>
					<?php	
							$columnCount++;
							if($columnCount % 4 == 0){
								echo "</tr><tr>";
							}
						}
					?>
						</tr>
					</table>

					<div id="buttonArea">
						<table id="buttonTbl">
							<tr>
								<td class="buttonTd">&nbsp;</td>
								<td class="buttonTd"><input type="button" id="showMore" value="More Items" class="btnSizeL <?php echo $moreItemClass; ?>"/></td>
								<td class="buttonTd"><input type="submit" id="order" value="ORDER" class="btnSizeM <?php echo $orderClass; ?>"/></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="clear"></div>
			<!-- hidden -->
			<input type="hidden" id="condGenreCD" value="<?php echo $genreCD; ?>" />
			<input type="hidden" id="condPlatformCD" value="<?php echo $platformCD; ?>" />
			<input type="hidden" id="displayCount" value="<?php echo count($resultList); ?>" />			
			<input type="hidden" name="jsonParam" id="jsonParam" value='<?php echo $jsonParam; ?>' />

		</form>
    </main>
    <!-- main end -->

    <hr class="line" />

    <!-- footer start-->
	<?php include "footer.html"; ?>
    <!-- footer end -->

</body>
</html>
<?php session_unset(); ?>
