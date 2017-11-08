/* 
 * index.js
 * Assignment4: javaScript for index page
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
$(document).ready(function () {
	
	/* initialize start */
	if($(".ckbOrder:checked").length == 0)
	{
		$("#order").attr("disabled", true);
	}
	else
	{
		var checkedArray = $(".ckbOrder:checked");
		for(var i=0; i<checkedArray.length; i++)
		{
			$(checkedArray[i]).next().attr("disabled", false);
			//$("#quantity" + checkedArray[i].value).attr("disabled", false);
		}

	}
	/* initialize end */

	/**
	 * search button event
	 */
	$("#search").click(function(){
		
		var searchInfo = GetSearchInfo($("#genreCD").val(), $("#platformCD").val(), "");
		SetJsonParam(searchInfo, "", "", "");
		document.mainForm.action = "index.php";
		document.mainForm.submit();
		
	});

	/**
	 * order button(submit) event
	 */	
	$(":submit").click(function(){

		var message = "";
		var checkedArray = $(".ckbOrder:checked");
	
		if(checkedArray.length == 0)
		{
			message += "You should choose at least one item.11";
		}
		
		for(var i=0; i<checkedArray.length; i++)
		{
			var quantity = $(checkedArray[i]).next().val();
		
			if(isNaN(quantity)){
				message += message.length > 0 ? "<br>" : "";
				message += "Quantity must be a number between 1 to 9.";
			}
			else
			{
				if(parseInt(quantity) != parseFloat(quantity))
				{
					message += message.length > 0 ? "<br>" : "";
					message += "Quantity must be an Integer between 1 to 9.";
				}
				else
				{

					if(quantity < 1 || quantity > 9)
					{
						message += message.length > 0 ? "<br>" : "";
						message += "Quantity must be between 1 to 9.";
					}
					
				}

			}
		}

		if(message.length > 0)
		{
			$("#messageArea").html("<div class='message'><h3>" + message + "</h3></div>");
			return false;
		}

		var searchInfo = GetSearchInfo($("#condGenreCD").val(), $("#condPlatformCD").val(), $("#displayCount").val());
		var checkedItemList = GetCheckedItemList();
		var orderInfo = GetOrderInfo("", "", "", "", "", "", "", "");
		SetJsonParam(searchInfo, checkedItemList, orderInfo, "");
						
		return true;
		
	});

	
	/**
	 * detail button event
	 */	
	$(".btnDetail").click(function (e) {
		
		var $this = $(e.target);
		$this.parent().addClass("relative");
		$this.next().fadeIn(200);
		
	});

	/**
	 * 
	 */		
	$(".img_small").mouseover(function (e) {
		
		var $this = $(e.target);
		$(".img_large").hide();
		$this.parent().addClass("relative");
		$this.next().show();
		
	});

	/**
	 * 
	 */		
	$(".divDetail, .img_large").mouseout(function (e) {
		
		var $this = $(e.target);
		$(this).hide();
		$this.parent().removeClass("relative");
		
	});			

	/**
	 * 
	 */	
	$(".ckbOrder").click(function (e) {

		var $this = $(e.target);
		$this.next().attr("disabled", !this.checked);

		// order button
		$("#order").attr("disabled", $(".ckbOrder:checked").length == 0 ? true : false);
		
	});

	/**
	 * 
	 */		
	$("#showMore").click(function() {

		var param = new Object();
		param.genre = $("#condGenreCD").val();
		param.platform = $("#condPlatformCD").val();
		
		var begin = parseInt($("#displayCount").val());
		param.begin = begin;
		
		var jsonParam = JSON.stringify(param);

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200) 
			{
				
				var retValue = JSON.parse(this.responseText);
				var totalCount = retValue.totalCount;
				var resultList = retValue.resultList;
				
				$("#displayCount").val(begin + resultList.length);
				
				if(totalCount <= $("#displayCount").val())
				{
					$("#showMore").hide();
				}

				var html = "<tr>";
				for(var i in resultList)
				{
					
					html += "<td>";
					html += 	"<table class='subTbl'>";
					html += 		"<tr>";
					html += 			"<td>";
					html += 				"<img class='img_small' src='" + resultList[i].imgAddr + "'  />";
					html += 				"<img class='invisible img_large' src='" + resultList[i].imgAddr + "' />";
					html += 			"</td>";
					html += 		"</tr>";
					html += 		"<tr height='40px'><td><h4>" + resultList[i].title + "</h4></td></tr>";
					
					html += 		"<tr>";
					html += 			"<td>";
										for(var j=0; j<5; j++)
										{
											var starAddr = j < resultList[i].rate ? "img/starOn.png" : "img/starOff.png";
											html += "<img class='star' src='" + starAddr +"' />";
										}
					html += 			"</td>";
					html += 		"</tr>";
					html += 		"<tr><td><h4 class='red'>CDN$&nbsp;" + resultList[i].price + "</h4></td></tr>";
					html += 		"<tr><td>" + resultList[i].genre + "&nbsp;/&nbsp;" + resultList[i].platform + "</td></tr>";
					html += 		"<tr>";
					html += 			"<td>";
					html += 				"<input type='button' class='btnDetail widthM' value='Detail' />";
					html += 				"<div class='invisible divDetail'>" + resultList[i].detail + "</div>";
					html += 			"</td>";
					html += 		"</tr>";
					html += 		"<tr>";
					html += 			"<td>";
					html += 				"<input type='checkbox' class='ckbOrder' value='" + resultList[i].itemID + "'/>&nbsp;&nbsp;&nbsp;";
					html += 				"<input type='number' value='1' min='1' max='9' step='1' class='widthXXS quantity' disabled ondrop='return false;' onkeydown='return false;'/>";
					html +=					"<input type='hidden' value='" + resultList[i].price + "' />";
					html += 			"</td>";
					html += 		"</tr>";
					html += 	"</table>";
					html += "</td>";
					
					if((parseInt(i)+1) % 4 == 0){
						html += "</tr><tr>";
					}
				}
				
				$(html).appendTo("#mainTbl");
				
				// event off
				$(".btnDetail").off("click");					
				$(".img_small").off("mouseover");
				$(".divDetail, .img_large").off("mouseout");
				$(".ckbOrder").off("click");

				// event on
				$(".btnDetail").on("click", function (e) {
					var $this = $(e.target);
					$this.parent().addClass("relative");
					$this.next().fadeIn(200);
				});
				
				$(".img_small").on("mouseover", function (e) {
					var $this = $(e.target);
					$(".img_large").hide();
					$this.parent().addClass("relative");
					$this.next().show();
				});
				
				$(".divDetail, .img_large").on("mouseout", function (e) {
					var $this = $(e.target);
					$(this).hide();
					$this.parent().removeClass("relative");
				});	

				//ckbOrder
				$(".ckbOrder").on("click", function (e) {
					var $this = $(e.target);
					$this.next().attr("disabled", !this.checked);

					// order button
					$("#order").attr("disabled", $(".ckbOrder:checked").length == 0 ? true : false);
				});
				
			}
		};

		xmlhttp.open("POST", "moreData.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("jsonParam=" + jsonParam);

	});

});