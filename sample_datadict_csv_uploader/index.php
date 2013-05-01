<?php 
$title = '';
//Check if there are any files ready for upload
if(isset($_FILES['uploaded_dict_files']))
{
	//For each file get the $key so you can check them by their key value
	foreach($_FILES['uploaded_dict_files']['name'] as $key => $value)
	{
	
		//If the file was uploaded successful and there is no error
		if(is_uploaded_file($_FILES['uploaded_dict_files']['tmp_name'][$key]) && $_FILES['uploaded_dict_files']['error'][$key] == 0)
        {
            
			//Create an unique name for the file using the current timestamp, an random number and the filename			
			$name = $_FILES['uploaded_dict_files']['name'][$key];
			$ext = end(explode(".", $name));
			if ($ext == 'csv') {
				$title = time().rand(0,999);
				$filename = $title.".".$ext;
				
				
				$today = date("m.d.y.G.i.s");
				$filename = $today.".".$ext;

				#$orig_filename = "meh"
				
				//Check if the file was moved
				if(move_uploaded_file($_FILES['uploaded_dict_files']['tmp_name'][$key], 'uploads/dictionary/'. $filename))
				{
					echo 'The file ' . $_FILES['uploaded_dict_files']['name'][$key].' was uploaded successful <br/>';
				}
				else
				{
					echo move_uploaded_file($_FILES['uploaded_dict_files']['tmp_name'][$key], 'uploads/dictionary/'. $filename);
					echo 'The file was not moved.';
				}
			}
			else {
				echo 'Cannot upload file other than csv.';
			}
				
        }
		else
        {
			echo 'The file was not uploaded.';
        }
	}
}

//Check if there are any files ready for upload
if(isset($_FILES['uploaded_data_files']))
{
	//For each file get the $key so you can check them by their key value
	foreach($_FILES['uploaded_data_files']['name'] as $key => $value)
	{
	
		//If the file was uploaded successful and there is no error
		if(is_uploaded_file($_FILES['uploaded_data_files']['tmp_name'][$key]) && $_FILES['uploaded_data_files']['error'][$key] == 0)
        {
            
			//Create an unique name for the file using the current timestamp, an random number and the filename			
			$dname = $_FILES['uploaded_data_files']['name'][$key];
			$dext = end(explode(".", $dname));
			if ($dext == 'csv') {
				if ($_POST['txtdictionary'] == '') {
					echo 'Please select dictionary file before uploading data file.';
				}
				else {
					$fname = $_POST['txtdictionary']."_".time().rand(0,999).".".$dext;
					
					//Check if the file was moved
					if(move_uploaded_file($_FILES['uploaded_data_files']['tmp_name'][$key], 'uploads/data/'. $fname))
					{
						echo 'The file ' . $_FILES['uploaded_data_files']['name'][$key].' was uploaded successful <br/>';
					}
					else
					{
						echo move_uploaded_file($_FILES['uploaded_data_files']['tmp_name'][$key], 'uploads/data/'. $fname);
						echo 'The file was not moved.';
					}				
				}
			}
			else {
				echo 'Cannot upload file other than csv.';
			}
				
        }
		else
        {
			echo 'The file was not uploaded.';
        }
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css" media="screen, projection"/>
	<link rel="STYLESHEET" type="text/css" href="codebase/dhtmlx.css">
	<script src="codebase/dhtmlx.js"></script>
	<script src="codebase/csv2array.js"></script>
	<script src="validate.js"></script>
	<script src="redletr_helper_functions.js"></script>
<!--	<script src="jquery-1.8.2.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	<script src="jquery.csv-0.71.js"></script>-->

<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<link href="http://code.jquery.com/ui/1.9.0/themes/cupertino/jquery-ui.css" rel="stylesheet" />
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script></script>
<script src="http://jquery-csv.googlecode.com/git/src/jquery.csv.js"></script>
	
	<style>
	.upload_box
		{
		margin: 2px;
		border: 1px solid blue;
		}
	</style>

<script type="text/javascript">

	//define global variables here
	var csvdatafile_grid ;
	var csv_data_grid;
	var data_dictionary_as_str;
	
	
	var redcap_datadict = new Object();
	
	/* This object will contain all of the data and parameters associated with the grid that holds the redcap_datadict object...
	To make the grid look nice certain properties need to be configured such as column sorting, alignment, etc... these will be computed
	and then set via the object 
	properties such as column alignment, column names, sorting, etc are configured in the helper functions
	dhtmlx configures the grid using a comma separates list such as  center,center,center,center
	*/ 
	

	<?php include 'validate.php'; ?>
      function get() {

      // retrieve data--- first get the data dictionary for the data set
      redcap_datadict.raw_csv_data = document.getElementById("textbox").value;
      // convert data to array
       convert_csvstring_to_object( redcap_datadict  );

   		
		datadict_grid = new dhtmlXGridObject('datadict_gridbox');
		datadict_grid.selMultiRows = true;
		datadict_grid.imgURL = "codebase/imgs/icons_greenfolders/";
		
		
		/* Now set the alignment, widths, header, etc.. for the current datagrid */
		datadict_grid.setHeader(redcap_datadict.Header);
		datadict_grid.setInitWidths(redcap_datadict.InitWidths );
		datadict_grid.setColAlign(redcap_datadict.ColAlign);
		datadict_grid.setColTypes(redcap_datadict.ColTypes);
		datadict_grid.setColSorting(redcap_datadict.ColSorting);
		datadict_grid.attachHeader("#text_filter,#select_filter,#numeric_filter");

		datadict_grid.init();
		datadict_grid.setSkin("dhx_skyblue");
		
/* move below to the function */
		var parent_id = "";
		var counter = 0;
		var txtRow = "";
	   arr = redcap_datadict.data_as_array;
 
 	/* It would be much more elegant to simply prune the string at the end of the loop */

	cols_in_datadict = arr[1].length;
	rows_in_datadict = arr.length;
	
 	//ert( rows_in_datadict+'and cols:'+cols_in_datadict);

	/*please recheck this syntax-- unclear if the counter is doing anything or not.... */
 	
	      for (row = 1; row < arr.length; row++) {
		var txtRow="";
		
		
			for (col = 0; col < arr[row].length; col++) {
			  if (col == (arr[row].length - 1)) {
				txtRow += arr[row][col];
			  }
			  else {
				txtRow += arr[row][col] + ",";			  
			  }
			}

			try {
				datadict_grid.addRow((arr[row][0] + counter),txtRow,0,null);
			}
			catch (exception) {
				alert("Error failing in bottom grid: " + exception);
			}						
			//alert ((array[row][1] + counter) + " : " + txtRows + " : " + parent_id);
		}

 
 
	
	/* Now loading and populating the data for the CSV data */
	
      var gd = document.getElementById("tbox").value;
	  datafile_csv = new Object();
	  datafile_csv.raw_csv_data = gd;     
	   convert_csvstring_to_object( datafile_csv  );
     
        arr = datafile_csv.data_as_array;

      
		csvdatafile_grid = new dhtmlXGridObject('data_gridbox');
		csvdatafile_grid.selMultiRows = true;
		csvdatafile_grid.imgURL = "codebase/imgs/icons_greenfolders/";
		
		/*Set Grid configuration parameters */
		csvdatafile_grid.setHeader(datafile_csv.Header);
		csvdatafile_grid.setInitWidths(datafile_csv.InitWidths);
		csvdatafile_grid.setColAlign(datafile_csv.ColAlign);
		csvdatafile_grid.setColTypes(datafile_csv.ColTypes);
		csvdatafile_grid.setColSorting(datafile_csv.ColSorting);
		
		csvdatafile_grid.init();
		csvdatafile_grid.setSkin("dhx_skyblue");
//		add_data_to_grid( csvdatafile_grid, datafile_csv);
        for (row = 1; row < arr.length; row++) {
		var txtRow = "";

			for (col = 0; col < arr[row].length; col++) {
			  if (col == (arr[row].length - 1)) {
				txtRow += arr[row][col];
			  }
			  else {
				txtRow += arr[row][col] + ",";			  
			  }
			}
			try {
				csvdatafile_grid.addRow((arr[row][0] + counter),txtRow,0,null);
			}
			catch (exception) {
				alert("Error: " + exception);
			}						
			//alert ((array[row][1] + counter) + " : " + txtRows + " : " + parent_id);
		}
		

	  }
  </script>
	
	
	<script type="text/javascript">
	$(document).ready(function(){
		$.get('list-files.php', function(result) {
			var flist =  $("#flist");
			var myArr = result.split(','); 
			for (var i=0; i<myArr.length; i+=1) { 
				flist.append($("<option></option>").val(myArr[i]).html(myArr[i] + '.csv'));
			}
		});
		
		$('#flist').change(function() {
			var str = "";
			$("select option:selected").each(function () {
				str += $(this).text();
            });
			var myArr = str.split('_');
			$.get('uploads/dictionary/' + myArr[0] + '.csv', function(result) {
					$('#textbox').val(result);
			});
			$.get('uploads/data/' + str, function(result) {
					$('#tbox').val(result);
			});
			
		});
		
		
		
	
	});
	
	</script>
</head>

<body>
<div id="header_box" style="border: 1px solid black">
<h1>Welcome to RED Lettr!! LOGO and help buttons go here</h1>

<div id="button_ctrls">
	<button id="bobs_button" onClick="bobs_function()"  name="BOB ROCKS">Generate Grid Stats</button>
	<button id="validate_button" onClick="validate_function()" name="Validate">Validata Data Grid</button>
  </div>

</div>

<script >
function bobs_function()
	{
	box_visibility = $("#upload_file_box")[0]
	box_visibility.hidden? box_visibility.hidden= false : box_visibility.hidden = true 
	}
</script>

<div id="upload_file_box" class="upload_box">
<table style="padding: 0px; margin: 0px; border: 0px; width: 100%" border="0">
<tr><td style="text-align: left; width: 50%">
<div class="left_header">Upload Dictionary File:</div></td>
<td style="text-align: left; width: 50%"><div class="right_header">Upload Data File:</div></td></tr>

<tr>
<td style="text-align: left; width: 50%"><div class="left_header">&nbsp;</div></td>
<td style="text-align: left; width: 50%">
<div class="right_header">&nbsp;</div></td>
</tr>

<tr><td style="text-align: left; width: 50%">
<form action="upload.php" method="POST" enctype="multipart/form-data">
	<div class="input_holder">
		<input type="file" name="uploaded_dict_files[]" id="input_clone" />
	</div>
	<input type="submit" value="add_files" />
</form>
</td>
<td style="text-align: left; width: 50%">
<form action="upload.php" method="POST" enctype="multipart/form-data">
	<div class="holder_input">
		<input type="file" name="uploaded_data_files[]" id="clone_input" />
		<input type="hidden" name="txtdictionary" id="txtdict" value="<?php echo $title; ?>">
	</div>
	<input type="submit" value="add_files" />
</form>
</td>
</tr>
<table>
</div>


<div>
<table style="padding: 0px; margin: 0px; border: 0px; width: 100%" border="0">
<tr><td colspan="2" style="text-align: left; width: 100%">
<div id="files-list">
<select id="flist"><option value="">Select from uploaded files</option></select>
<input type="button" value="Get Array from CSV" onclick="get();">
</div>
<!-- this is a weird way to store data and will be removed in the near future...
currently we are saving read in input into textboxes which seems a bit odd
-->


<!-- style="display: none"-->
<textarea rows="40" cols="400" id="textbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="xmlbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="databox" style="display: none"></textarea>

<textarea rows="40" cols="400" id="tbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="xbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="dbox" style="display: none"></textarea>

</td></tr>
</table></div>

<!-- need to refactor this to not use a table layout at some point -->

<div id="bottom_containers">
<tr>
<td colspan="2" style="text-align: left; width: 100%">
<div id="datadict_gridbox" width="100%" height="250px" style="background-color:white;"></div>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: left; width: 100%">
<div id="data_gridbox" width="100%" height="250px" style="background-color:white;"></div>
</td>
</tr>
</div>
</div>


<div id="bobs_stats">
Stats:
Number of elements in data dict:<br>
Number of rows in uploaded data file:<br>
Number of columsn in uploaded data dict:<br>

<div id="form_filter_div"></div>

<!-- and then set the  $("#myfirstnum").innerHTML = SOMENUMBER  -->

</div>


</body>


</html>
