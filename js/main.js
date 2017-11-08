/* 
 * main.js
 * Assignment4: common javaScript for all pages
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
function SetJsonParam(searchInfo, checkedItemList, orderInfo, summaryInfo)
{
	var param = new Object();
	param.searchInfo = searchInfo;
	param.checkedItemList = checkedItemList;
	param.orderInfo = orderInfo;
	param.summaryInfo = summaryInfo;
	
	$("#jsonParam").val(JSON.stringify(param));
}


function AddJsonParam(strJsonParam, orderInfo, summaryInfo)
{
	var parsedParam = JSON.parse(strJsonParam);

	var param = new Object();
	param.searchInfo = parsedParam.searchInfo;
	param.checkedItemList = parsedParam.checkedItemList;
	param.orderInfo = orderInfo;
	param.summaryInfo = summaryInfo;
	
	$("#jsonParam").val(JSON.stringify(param));
}


function AddSummary(strJsonParam, summaryInfo)
{
	var parsedParam = JSON.parse(strJsonParam);

	var param = new Object();
	param.searchInfo = parsedParam.searchInfo;
	param.checkedItemList = parsedParam.checkedItemList;
	param.orderInfo = parsedParam.orderInfo;
	param.summaryInfo = summaryInfo;
	
	$("#jsonParam").val(JSON.stringify(param));
}

function GetSummaryInfo(itemTotal, taxRate, deliveryCost, totalPrice, deliveryDate){
	
	var summaryInfo = new Object();
	summaryInfo.itemTotal = itemTotal;
	summaryInfo.taxRate = taxRate;
	summaryInfo.deliveryCost = deliveryCost;
	summaryInfo.totalPrice = totalPrice;
	summaryInfo.deliveryDate = deliveryDate;

	return summaryInfo;
	
}


function GetSearchInfo(genreCD, platformCD, displayCount)
{
	var searchInfo = new Object();
	searchInfo.genreCD = genreCD;
	searchInfo.platformCD = platformCD;
	searchInfo.displayCount = displayCount;
	return searchInfo;
}

function GetCheckedItemList()
{
	var checkedItemList = new Array();
	var item = null;
	var checkedArray = $(".ckbOrder:checked");
	for(var i=0; i<checkedArray.length; i++)
	{
		item = new Object();
		item.itemID = $(checkedArray[i]).val();
		item.quantity = $(checkedArray[i]).next().val();
		item.price = $(checkedArray[i]).next().next().val();
		checkedItemList.push(item);
	}
	return checkedItemList;
}


function GetOrderInfo(firstName, lastName, address, city, province, zipcode, phone, email)
{
	
	var orderInfo = new Object();
	orderInfo.firstName = firstName;
	orderInfo.lastName = lastName;
	orderInfo.address = address;
	orderInfo.city = city;
	orderInfo.province = province;
	orderInfo.zipcode = zipcode;
	orderInfo.phone = phone;
	orderInfo.email = email;
	
	return orderInfo;
}


