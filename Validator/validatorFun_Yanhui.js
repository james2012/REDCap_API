//	bool isBoolean(input) Returns true if input is either “true” or “false”

function isBoolean(input)
{
	return input=="true"||input=="false"
	       || input == "TRUE" || input == "FALSE"
}


//	bool isYesNo(input)	Returns true if input is either “yes” or “no”

function isYesNo(input)
{
	return input=="yes" || input=="no"
		|| input=="YES" || input=="NO"

}

//	bool correctYesNo(input)	Returns true if yes and false if no.

function correctYesNo(input)
{
	if(input == "yes" || input == "YES")
		return true;
	else if(input == "no" || input == "NO")
		return false;
		
}