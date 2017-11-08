/* 
 * order.js
 * Assignment4: javaScript for order page
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */

/* Const Area */
// Regular Expression
const REG_EXP_EMAIL = /[A-z0-9]+[\-\.\_]?[A-z0-9]+[\@]{1}[A-z0-9]{2,}[\.]+[A-z0-9]{2,}/;
const REG_EXP_PASSWORD_NUMBER = /[0-9]+/;
const REG_EXP_PASSWORD_UPPER = /[A-Z]+/;
const REG_EXP_PASSWORD_LOWER = /[a-z]+/;
const REG_EXP_PHONE_NUMBER = /\D+/;
const REG_EXP_ZIPCODE = /[A-z]{1}\d{1}[A-z]{1}\d{1}[A-z]{1}\d{1}/;
// Message
const MSG_REQUIRED = "{0} is required."; //empty field required
const MSG_LENGTH_LESS = "{0} must be less than {1} characters in length.";
const MSG_LENGTH_EQUAL = "{0} must be {1} characters in length.";
const MSG_LENGTH_BETWEEN = "{0} must be between {1} and {2} characters in length.";
const MSG_FORMAT = "{0} is not formatted correctly.";
const MSG_CONFIRM = "{0} must be the same as {1}.";

/* Global variable */
// error message
var errorMessage;


function Init()
{

	errorMessage = new Array();
	SetFocus("firstName");

}
	

function Validate()
{

	errorMessage = new Array();

	CheckName("firstName", "First Name", false);
	CheckName("lastName", "Last Name", false);
	CheckAddress();
	CheckCity();
	CheckProvince();
	CheckZipcode();
	CheckPhoneNumber();
	CheckEmail();
	
	if(errorMessage.length > 0)
	{
		DisplayErrorMessage();
		return false;
	}
	
	return true;
	
}


function CheckName(id, fieldName)
{	
	// name
	var name = document.getElementById(id).value;
	if(IsEmpty(name))
	{
	    SetError(id, MSG_REQUIRED, [fieldName]);
		return;
	}
	
	if(name.trim().length > 30){
		SetError(id, MSG_LENGTH_LESS , [fieldName, "30"]);
		return;
	}

	ClearColor(id);
}


function CheckEmail()
{
	// email
	var id = "email";
	var fieldName = "Email";
	var email = document.getElementById(id).value;
	if(IsEmpty(email))
	{
		SetError(id, MSG_REQUIRED , [fieldName]);
		return;
	}
	
	if(email.trim().length > 50){
		SetError(id, MSG_LENGTH_LESS , [fieldName, "50"]);
		return;
	}
	
	if(!REG_EXP_EMAIL.test(email)){
		SetError(id, MSG_FORMAT , [fieldName]);
		return;
	}
	
	ClearColor(id);

}


function CheckPhoneNumber()
{

	// phone
	var id = "phone";
	var fieldName = "Phone Number";
	var phoneNumber = document.getElementById(id).value;
	if(IsEmpty(phoneNumber))
	{
		SetError(id, MSG_REQUIRED, [fieldName]);
		return;
	}
	
	if(phoneNumber.trim().length != 10){
		SetError(id, MSG_LENGTH_EQUAL, [fieldName, "10"]);
		return;
	}
	
	if(REG_EXP_PHONE_NUMBER.test(phoneNumber)){
		SetError(id, MSG_FORMAT, [fieldName]);
		return;
	}
	
	ClearColor(id);

}


function CheckAddress()
{
	var id = "address";
	var fieldName = "Address";
	var address = document.getElementById(id).value;
	
    // Address
	if (IsEmpty(address)) {
	    SetError(id, MSG_REQUIRED, [fieldName]);
	    return;
	}
	if(!IsEmpty(address) && address.trim().length > 50)
	{
	    SetError(id, MSG_LENGTH_LESS, [fieldName, "50"]);
	}else
	{
	    ClearColor(id);
	}
}

function CheckCity()
{
    var id = "city";
    var fieldName = "City";
    var city = document.getElementById(id).value;

    // City
    if (IsEmpty(city)) {
        SetError(id, MSG_REQUIRED, [fieldName]);
        return;
    }
    if (!IsEmpty(city) && city.trim().length > 30) {
        SetError(id, MSG_LENGTH_LESS, [fieldName, "30"]);
    } else {
        ClearColor(id);
    }
}

function CheckProvince()
{
    var id = "province";
    var fieldName = "Province";
    var province = document.getElementById(id).value;

    // Province	
    if (IsEmpty(province)) {
        SetError(id, MSG_REQUIRED, [fieldName]);
        return;
    }
}


function CheckZipcode()
{
    var id = "zipcode";
    var fieldName = "Zipcode";
    var zipcode = document.getElementById(id).value;

    // zipcode	
    if (IsEmpty(zipcode)) {
        SetError(id, MSG_REQUIRED, [fieldName]);
        return;
    }
	if (zipcode.trim().length != 6) {
		SetError(id, MSG_LENGTH_EQUAL, [fieldName, "6"]);

	} else {

		if (!REG_EXP_ZIPCODE.test(zipcode)) {
			SetError(id, MSG_FORMAT, [fieldName]);
		} else {
			ClearColor(id);
		}
	}
}

function DisplayErrorMessage()
{
	var message = "";
	for(var i=0; i<errorMessage.length; i++)
	{
		message += errorMessage[i] + "<BR>";
	
	}
	
	// display error messages
	document.getElementById("messageArea").innerHTML = "<div class='message'><h3>" + message + "</h3></div>";

}


function SetError(id, messageID, argArray)
{
	SetFocus(id);
	// set message;
	errorMessage.push(GetMessage(messageID, argArray));
	// set color
	SetErrorStyle(id);

}


function SetErrorStyle(id)
{
	// set color
	document.getElementById(id).style="background-color:pink; border-color: red;";
	var labelID = id + "LB";
	document.getElementById(labelID).style="color:red;";
			
}

function ClearColor(id)
{
	// set color
	document.getElementById(id).style="";
	var labelID = id + "LB";
	document.getElementById(labelID).style="";

}

/*
 * 
 */
function SetFocus(id)
{
	if(errorMessage.length == 0)
	{
		document.getElementById(id).focus();
	}
	
}		

function Capitalize(str)
{
	if(IsEmpty(str))
	{
		return str;
	}
	
	var strArray = str.split(" ");
	var ret = "";
	
	for(var i=0; i<strArray.length; i++)
	{
		if(i != 0)
		{
			ret += " ";
		}
		ret += strArray[i].charAt(0).toUpperCase() + strArray[i].slice(1).toLowerCase();
	}
	
	return ret;
}

function RemoveWhiteSpace(str)
{
	return str == null ? str : str.trim();
}


function ToUpper(str)
{
	return IsEmpty(str) ? str : str.toUpperCase();
}

function GetMessage(messageID, argArray)
{
	var message = messageID;
	if(argArray != null && argArray.length > 0 )
	{
		for(var i=0; i<argArray.length; i++)
		{
			
			message = message.replace("{" + i + "}", argArray[i]);
		}		
	}

	return message;
}

function IsEmpty(str)
{
	return str == null || str.trim().length == 0;
}		

$(document).ready(function () {
	
	$("#back").click( function(){
		document.orderForm.action = "index.php";
		document.orderForm.submit();
	});
	
	$(":submit").click( function(){
		
		// check validation
		if(Validate() == false)
		{
			return false;
		}
		
		var orderInfo = GetOrderInfo(
			$("#firstName").val(),
			$("#lastName").val(),
			$("#address").val(),
			$("#city").val(),
			$("#province").val(),
			$("#zipcode").val(),
			$("#phone").val(),
			$("#email").val()
		);
		
		var summaryInfo = GetSummaryInfo(
			$("#itemTotal").val(), 0, 0, 0, 0);
		
		AddJsonParam($("#jsonParam").val(), orderInfo, summaryInfo);
		
		return true;
	});
	
});
