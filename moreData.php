<?php
/* 
 * moreData.php
 * Assignment4: send item information list
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
	require "getData.php";

	// get parameter
	$jsonParam = empty($_POST["jsonParam"]) ? "" : $_POST["jsonParam"];
	// decode JSON param
	$condition = json_decode($jsonParam, true);
	// total count
	$totalCount = GetItemListCount($condition["genre"], $condition["platform"]);
	// search
	$resultList = GetItemList($condition["genre"], $condition["platform"], $condition["begin"], "");
	// return value
	$retValue = array();
	$retValue["totalCount"] = $totalCount;
	$retValue["resultList"] = $resultList;
	// encode result
	$retValueJSON = json_encode($retValue);

	echo $retValueJSON;

?>