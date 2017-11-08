/* 
 * receipt.js
 * Assignment4: javaScript for receipt page
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
$(document).ready(function () {
	
	$(":submit").click( function(){
		document.receiptForm.action = "index.php";
		document.receiptForm.method = "POST";
		document.confirmForm.submit();
	});
});