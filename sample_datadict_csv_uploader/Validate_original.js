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
						atlas_grid.setCellTextStyle(id, i, "background-color: red");
					}
					//ADD YOUR FUNCTIONS FOR OTHER TYPES OF VALIDATION
				});
			}
	}
}

