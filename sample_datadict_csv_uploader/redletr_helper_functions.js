function convert_csvstring_to_object(  datagrid_config_object )
	{
	/* The CSV reader apparently returns an input string which I need to reconvert back into a useful object */
	
	  try {
        var array = csv2array( datagrid_config_object.raw_csv_data);
      }
      catch (exception) {
        alert("Error: " + exception);
        return;
      }
	datagrid_config_object.data_as_array = array;
	
	/*I now have the csv file back as an array-- the first line of the data dictionary should contain the necessary header information */
	 generate_grid_config( datagrid_config_object );
	}
	
	
function generate_grid_config( datagrid_config_object )
	{
	/* For this function-- I pass it the first line of the array containing all of the data for either the data dictionary or CSV data file itself */

	/* need to think through this carefully-- in one case the data is in rows.. in the other case it's in columns as the
	data dictionary and the uplaoded csv file are oriented idfffernely !!! */
	header_line = datagrid_config_object.data_as_array[0];
	
	
	var   grid_Header = "";
	var   strInitWidths = "";
	var   strColAlign = "";
	var   strColTypes = "";
	var   strColSorting = "";
	/*To parse the header I really only need to parse the first line..... */

		for (col = 0; col < header_line.length; col++) {
		strColTypes += "txt,";	
		strInitWidths += "200,";
			strColAlign += "center,";
			strColSorting += "str,";
		grid_Header += header_line[col].replace(/,/g,';') + ",";
	
	/* need to change the code to remove the trailing commas... this is a hack below */
		  if (col == (header_line.length - 1)) {
			grid_Header += header_line[col].replace(/,/g,';');
			strInitWidths += "200";
			strColAlign += "center";
			strColTypes += "txt";	
			strColSorting += "str";			
		  }
		
		  }	

		  	/*Now actually copy the default configuration for the grid to the grid configuration  object */		
		 datagrid_config_object.Header = grid_Header;		
		 datagrid_config_object.InitWidths = strInitWidths;
		 datagrid_config_object.ColAlign = strColAlign;
		 datagrid_config_object.ColSorting = strColSorting;
		 datagrid_config_object.ColTypes = strColTypes;
		
	}	
	

function add_data_to_grid ( dhtmlxgrid_object, csvdata_object)
	{
	/* This function will add data contained in the uploaded CSV files to the dhtmlx data grid */

	var counter = 0;
	var txtRow = "";
	var arr = csvdata_object.data_as_array;
	
	
	  for (row = 1; row < arr.length; row++) {
              for (col = 0; col < arr[row].length; col++) {
      if (col == (arr[row].length - 1)) {
  txtRow += arr[row][col];
  }
     else {
    txtRow += arr[row][col] + ",";
}
}  try {
	                dhtmlxgrid_object.addRow((arr[row][0] + counter),txtRow,0,null);
	          }
catch (exception) {
	  alert("Error: " + exception);
	              }
	        //alert ((array[row][1] + counter) + " : " + txtRows + " : " + parent_id);
	                }
	                
                
	    }
	
	
