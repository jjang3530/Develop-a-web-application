/* 
 * confirm.js
 * Assignment4: javaScript for confirm page
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
$(document).ready(function () {
	
	$("#back").click( function(){
		document.confirmForm.action = "order.php";
		document.confirmForm.submit();
	});
	
	$(":submit").click( function(){
		
		var summaryInfo = GetSummaryInfo(
			parseFloat($("#itemTotal").val()),
			parseFloat($("#taxRate").val()),
			parseFloat($("#deliveryCost").val()),
			parseFloat($("#totalPrice").val()),
			$("#deliveryDate").val()
		);	
		
		AddSummary($("#jsonParam").val(), summaryInfo);
		return true;
	});
	
});