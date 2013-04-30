function isNull(input){
  return input==null || 
    input=="" || 
    input<0 ||
    input=='NA' ||
    input=='na' ||
    input=='Na' ||
    input=='NaN' ||
    input=='none' ||
    input=='999'
}


// Yanhui's codes are from here

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



function isInteger(input) {
  if((parseFloat(input) == parseInt(input)) && !isNaN(input)){
      return true;
  } else {
      return false;
  }

}

function isNumber(input) {
  return (isInteger(input) && input > 0);

}

function withinRange(input, min, max) {
     return (input > min && input <= max);   
}

function isIntegerWithinRange(input, min, max) {
  return (isInteger(input) && withinRange(input, min, max));

}





function validate() {
	var col_dic = new Array();
	mygrid.forEachRow(function (id) {
		var dict_col = mygrid.cells(id, 1).getValue();
		if (dict_col != "") {
		    col_dic.push(dict_col)
		};
	});

	for (var i = 0; i < atlas_grid.getColumnsNum(); i++) { 
			var col_id = atlas_grid.getColumnLabel(i); 
			var col_index = col_dic.indexOf(col_id);
			if (col_index == -1) {  
				atlas_grid.forEachRow(function (id) {     
					atlas_grid.setCellTextStyle(id, i, "background-color: grey");
				});
			}
			else {//do the harlem shake
				atlas_grid.forEachRow(function (id) {
					var cell_value=atlas_grid.cells(id, i).getValue();
					//validation for NULL
					if (isNull(cell_value)){
						atlas_grid.setCellTextStyle(id, i, "background-color: orange");
					}
					//ADD YOUR FUNCTIONS FOR OTHER TYPES OF VALIDATION


					// Yanhui's validation
					//	bool isBoolean(input) Returns true if input is either “true” or “false”
					if(isBoolean(cell_value)){
						atlas_grid.setCellTextStyle(id,i,"background-color: green");
					}
					//	bool isYesNo(input)	Returns true if input is either “yes” or “no”
					if(isYesNo(cell_value)){
						atlas_grid.setCellTextStyle(id,i,"background-color: green");
					}
					//	bool correctYesNo(input)	Returns true if yes and false if no.
					if(correctYesNo(cell_value)){
						atlas_grid.setCellTextStyle(id,i,"background-color: green");
					}

					if(isInteger(cell_value)){
						atlas_grid.setCellTextStyle(id,i,"background-color: green");
					}
					if(isNumber(cell_value)){
						atlas_grid.setCellTextStyle(id,i,"background-color: green");
					}


				});
			}
	}
}

