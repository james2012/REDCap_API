//	bool isBoolean(input) Returns true if input is either “true” or “false”

function isBoolean(input)
{
	return input=="true"||input=="false"
	       || input == "TRUE" || input == "FALSE"
}




function isYesNo(input)
{
	return input=="yes" || input=="no"
		|| input=="YES" || input=="NO"

}



function correctYesNo(input)
{
	if(input == "yes" || input == "YES")
		return true;
	else if(input == "no" || input == "NO")
		return false;
		
}