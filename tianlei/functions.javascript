//match column name, bool, true if input = columnName
function matchColumnName(input, columnName){
  return input == columnName
}

//check Null, bool, true if input is any type of comman NA indicator
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


//column name validation
//on webpage "upload.php"
var col_dic = new Array();
mygrid.forEachRow(function (id) {
   	var dict_col = mygrid.cells(id, 1).getValue();
   	if (dict_col != "") {
       	col_dic.push(dict_col)
   	};
});

for (var i = 0; i < mygd.getColumnsNum(); i++) { 
		var col_id = mygd.getColumnLabel(i); 
		var col_index = col_dic.indexOf(col_id);
		if (col_index == -1) {  
			mygd.forEachRow(function (id) {     
				mygd.setCellTextStyle(id, i, "background-color: grey");
			});
		}
		else {
			//do the harlem shake
			mygd.forEachRow(function (id) {
				var cell_value=mygd.cells(id, i).getValue();
				//validation for NULL
				if (isNull(cell_value)){
					mygd.setCellTextStyle(id, i, "background-color: red");
				}
				//ADD YOUR FUNCTIONS FOR OTHER TYPES OF VALIDATION
			});
		}
}