function enable_text(status)
{
status =! status;	
	document.billingInfo.billName.disabled = status;
	document.billingInfo.billAddress1.disabled = status;
	document.billingInfo.billCountry.disabled = status;
	document.billingInfo.billCityState.disabled = status;
	document.billingInfo.billZip.disabled = status;
}