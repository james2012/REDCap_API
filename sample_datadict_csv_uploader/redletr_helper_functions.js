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
	datagrid_config_object.gridHeader_string = generate_grid_header( datagrid_config_object );
	

	return(array);
	}
	
	
function generate_grid_header( datagrid_config_object )
	{
	/* For this function-- I pass it the first line of the array containing all of the data for either the data dictionary or CSV data file itself */
	
	header_line = datagrid_config_object.data_as_array[0];
	
	
	  grid_Header = "";
	  strInitWidths = "";
	  strColAlign = "";
	  strColTypes = "";
	   strColSorting = "";
		for (col = 0; col < header_line.length; col++) {
		  if (col == (header_line.length - 1)) {
			grid_Header += header_line[col].replace(/,/g,';');
			strInitWidths += "200";
			strColAlign += "center";
			strColTypes += "txt";	
			strColSorting += "str";			
		  }
		  else {
			if (col == 0) {
				strColTypes += "tree,";			
			}
			else {
				strColTypes += "txt,";			
			}
			if (col == 1) {
				grid_Header += header_line[0].replace(/,/g,';') + ",";
			}
			if (col == 0) {
				grid_Header += header_line[1].replace(/,/g,';') + ",";
			}
			if (col > 1) {
				grid_Header += header_line[col].replace(/,/g,';') + ",";
			}

			strInitWidths += "200,";
			strColAlign += "left,";
			strColSorting += "str,";
		  }	

		  
		}
		
		 datagrid_config_object.Header = grid_Header;		
		 datagrid_config_object.InitWidths = strInitWidths;
		 datagrid_config_object.ColAlign = strColAlign;
		 datagrid_config_object.ColSorting = strColSorting;
		 datagrid_config_object.ColTypes = strColTypes;
		
		return(grid_Header);
	
	}	
	
function add_data_to_grid ( dhtmlxgrid_object, csvdata_object)
	{
	/* This function will add data contained in the uploaded CSV files to the dhtmlx data grid */

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
	
	
