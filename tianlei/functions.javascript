#match column name, bool, true if input = columnName
function matchColumnName(input, columnName){
  return input == columnName
}

#check Null, bool, true if input is any type of comman NA indicator
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
