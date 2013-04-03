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
datadict_grid.forEachRow(function (id) {
    var dict_col = datadict_grid.cells(id, 1).getValue();
    if (dict_col != "") {
        col_dic.push(dict_col)
    };
});

var length = mygd.getColumnsNum()
for (var i = 0; i < mygd.getColumnsNum(); i++) { 
    var col_id = mygd.getColumnLabel(i); 
    var col_index = col_dic.indexOf(col_id)  if (col_index == -1) {  
        mygd.forEachRow(function (id) {     
            mygd.setCellTextStyle(id, i, "background-color: yellow");
        }); 
    }
}