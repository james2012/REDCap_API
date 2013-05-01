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
	//used to be == array
	datagrid_config_object.data_as_array =  $.csv.toArrays(datagrid_config_object.raw_csv_data);
//	datagrid_config_object.data_as_array =  array;
	
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
	
function redcap_datadict_infogen( dhtmlxgrid_object ) 
	{
		var datadictProps = {};
		var numRowsInGrid = dhtmlxgrid_object.getRowsNum();
		for (var i = 0; i < numRowsInGrid; i++) {
		        var fieldTypeVal = dhtmlxgrid_object.cellByIndex(i, 3).getValue();
		        var fieldLabelVal = dhtmlxgrid_object.cellByIndex(i, 4).getValue();
		        var choicesVal = dhtmlxgrid_object.cellByIndex(i, 5).getValue();
			var fieldNameVal = dhtmlxgrid_object.cellByIndex(i, 0).getValue();
			datadictProps[fieldNameVal] = {}
			datadictProps[fieldNameVal].fieldType = fieldTypeVal;
			datadictProps[fieldNameVal].fieldLabel = fieldLabelVal;
			datadictProps[fieldNameVal].choices = choicesVal;
		}
		console.log(datadictProps);

	}

function add_data_to_grid ( dhtmlxgrid_object, csvdata_object)
	{
	/* This function will add data contained in the uploaded CSV files to the dhtmlx data grid */

	var arr = csvdata_object.data_as_array;
	//skip the header
	  for (row = 1; row < arr.length; row++) {
        
        
/*              for (col = 0; col < arr[row].length; col++) {
			cur_col = arr[row][col];/* Need to encapsulate current column if it contains commas... *
			if(cur_col.indexOf(',')=== -1) { txtRow += cur_col +',';}
			else { txtRow += '"' + cur_col + '",' }	
*/		
		
		  try {   dhtmlxgrid_object.addRow((arr[row][0] + row),arr[row],0,null);         }
		catch (exception) {   alert("Error: " + exception); 	              }
	                }
	                
                
	    }
	
	
