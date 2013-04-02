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

<script type="text/javascript">
    function validate() {
        var length = mygd.getColumnsNum()
            for (var i = 0; i < mygd.getColumnsNum(); i++) { 
                    var col_id = mygd.getColumnLabel(i); 
                     var col_index = col_dic.indexOf(col_id)  if (col_index == -1) {  
                          mygd.forEachRow(function (id) {     
                               mygd.setCellTextStyle(id, i, "background-color: yellow");
                }); 
                 }
            }
    }

    function get() {
	  //alert ("Start Function");
      // retrieve data
      var data = document.getElementById("textbox").value;
      
      // convert data to array
      try {
        var array = csv2array(data);
      }
      catch (exception) {
        alert("Error: " + exception);
        return;
      }

      // convert the array back to a string
      var strHeader = "";
	  var strInitWidths = "";
	  var strColAlign = "";
	  var strColTypes = "";
	  var strColSorting = "";
		for (col = 0; col < array[0].length; col++) {
		  if (col == (array[0].length - 1)) {
			strHeader += array[0][col].replace(/,/g,';');
			strInitWidths += "200";
			strColAlign += "left";
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
				strHeader += array[0][0].replace(/,/g,';') + ",";
			}
			if (col == 0) {
				strHeader += array[0][1].replace(/,/g,';') + ",";
			}
			if (col > 1) {
				strHeader += array[0][col].replace(/,/g,';') + ",";
			}

			strInitWidths += "200,";
			strColAlign += "left,";
			strColSorting += "str,";
		  }
		}
		//alert ("Header Loaded");
	  
      
		mygrid = new dhtmlXGridObject('gridbox');
		mygrid.selMultiRows = true;
		mygrid.imgURL = "codebase/imgs/icons_greenfolders/";
		//alert (strHeader + " : " + strInitWidths + " : " + strColAlign + " : " + strColTypes + " : " + strColSorting);
		mygrid.setHeader(strHeader);
		mygrid.setInitWidths(strInitWidths);
		mygrid.setColAlign(strColAlign);
		mygrid.setColTypes(strColTypes);
		mygrid.setColSorting(strColSorting);
		/*mygrid.setHeader("Tree,Plain Text,Long Text,Color,Checkbox");
		mygrid.setInitWidths("150,100,100,100,100");
		mygrid.setColAlign("left,left,left,left,center");
		mygrid.setColTypes("tree,ed,txt,ch,ch");
		mygrid.setColSorting("str,str,str,na,str");*/		
		mygrid.init();
		mygrid.setSkin("dhx_skyblue");
		//mygrid.loadXML("codebase/test_list_1.xml");		
		//mygrid.enableAutoHeigth(true);
		//alert ("Header Printed");		
		/*mygrid.setSkin("dhx_skyblue");
		//alert ("Header Done");*/
		var parent_id = "";
		var counter = 0;
		var txtRows = "";
        for (row = 1; row < array.length; row++) {
			if (array[row][1] != parent_id) {
				//alert (array[row][1]);			
				try {
					mygrid.addRow(array[row][1],array[row][1],0,null,"folder.gif");
				}
				catch (exception) {
					alert("Error: " + exception);
				}			
				counter = 0;
				parent_id = array[row][1];
			}
			++counter;
			txtRows = array[row][1] + "," + array[row][0] + ",";
			for (col = 2; col < array[row].length; col++) {
			  if (col == (array[row].length - 1)) {
				txtRows += array[row][col];
			  }
			  else {
				txtRows += array[row][col] + ",";			  
			  }
			}
			try {
				mygrid.addRow((array[row][1] + counter),txtRows,0,parent_id);
			}
			catch (exception) {
				alert("Error: " + exception);
			}						
			//alert ((array[row][1] + counter) + " : " + txtRows + " : " + parent_id);
		}
		
	    //mygrid.parse(strXML);
		/*mygrid.init();*/				
		
      // show the data in an alert
      // alert(arrayStr)

      var gd = document.getElementById("tbox").value;
      
      // convert data to array
      try {
        var arr = csv2array(gd);
      }
      catch (exception) {
        alert("Error: " + exception);
        return;
      }

      // convert the array back to a string
      var strHead = "";
	  var strInitWidth = "";
	  var strColAl = "";
	  var strColType = "";
	  var strColSort = "";
		for (col = 0; col < arr[0].length; col++) {
		  if (col == (arr[0].length - 1)) {
			strHead += arr[0][col].replace(/,/g,';');
			strInitWidth += "200";
			strColAl += "left";
			strColType += "txt";	
			strColSort += "str";			
		  }
		  else {
			if (col == 0) {
				strColType += "tree,";			
			}
			else {
				strColType += "txt,";			
			}
			if (col == 1) {
				strHead += arr[0][0].replace(/,/g,';') + ",";
			}
			if (col == 0) {
				strHead += arr[0][1].replace(/,/g,';') + ",";
			}
			if (col > 1) {
				strHead += arr[0][col].replace(/,/g,';') + ",";
			}

			strInitWidth += "200,";
			strColAl += "left,";
			strColSort += "str,";
		  }
		}
		//alert ("Header Loaded");
	  
      
		mygd = new dhtmlXGridObject('gbox');
		mygd.selMultiRows = true;
		mygd.imgURL = "codebase/imgs/icons_greenfolders/";
		//alert (strHeader + " : " + strInitWidths + " : " + strColAlign + " : " + strColTypes + " : " + strColSorting);
		mygd.setHeader(strHead);
		mygd.setInitWidths(strInitWidth);
		mygd.setColAlign(strColAl);
		mygd.setColTypes(strColType);
		mygd.setColSorting(strColSort);
		/*mygrid.setHeader("Tree,Plain Text,Long Text,Color,Checkbox");
		mygrid.setInitWidths("150,100,100,100,100");
		mygrid.setColAlign("left,left,left,left,center");
		mygrid.setColTypes("tree,ed,txt,ch,ch");
		mygrid.setColSorting("str,str,str,na,str");*/		
		mygd.init();
		mygd.setSkin("dhx_skyblue");
		//mygrid.loadXML("codebase/test_list_1.xml");		
		//mygrid.enableAutoHeigth(true);
		//alert ("Header Printed");		
		/*mygrid.setSkin("dhx_skyblue");
		//alert ("Header Done");*/
		var txtRow = "";
        for (row = 1; row < arr.length; row++) {
			for (col = 0; col < arr[row].length; col++) {
			  if (col == (arr[row].length - 1)) {
				txtRow += arr[row][col];
			  }
			  else {
				txtRow += arr[row][col] + ",";			  
			  }
			}
			try {
				mygd.addRow((arr[row][0] + counter),txtRow,0,null);
			}
			catch (exception) {
				alert("Error: " + exception);
			}						
			//alert ((array[row][1] + counter) + " : " + txtRows + " : " + parent_id);
		}


	  }
  </script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	
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
		
		$('.add_field').click(function(){
	
			var input = $('#input_clone');
			var clone = input.clone(true);
			clone.removeAttr ('id');
			clone.val('');
			clone.appendTo('.input_holder'); 
			
		});

		$('.remove_field').click(function(){
		
			if($('.input_holder input:last-child').attr('id') != 'input_clone'){
				$('.input_holder input:last-child').remove();
			}
		
		});

		$('.field_add').click(function(){
	
			var input = $('#clone_input');
			var clone = input.clone(true);
			clone.removeAttr ('id');
			clone.val('');
			clone.appendTo('.holder_input'); 
			
		});

		$('.field_remove').click(function(){
		
			if($('.holder_input input:last-child').attr('id') != 'clone_input'){
				$('.holder_input input:last-child').remove();
			}
		
		});
		
	});
	
	</script>
</head>

<body>
<table style="padding: 0px; margin: 0px; border: 0px; width: 100%" border="0">
<tr>
<td style="text-align: left; width: 50%">
<div class="left_header">Upload Dictionary File:</div>
</td>
<td style="text-align: left; width: 50%">
<div class="right_header">Upload Data File:</div>
</td>
</tr>

<tr>
<td style="text-align: left; width: 50%">
<div class="left_header">&nbsp;</div>
</td>
<td style="text-align: left; width: 50%">
<div class="right_header">&nbsp;</div>
</td>
</tr>

<tr>
<td style="text-align: left; width: 50%">
<span class="add_field">+</span>
<span class="remove_field">-</span>
<form action="upload.php" method="POST" enctype="multipart/form-data">
	<div class="input_holder">
		<input type="file" name="uploaded_dict_files[]" id="input_clone" />
	</div>
	<input type="submit" value="add_files" />
</form>
</td>
<td style="text-align: left; width: 50%">
<span class="field_add">+</span>
<span class="field_remove">-</span>
<form action="upload.php" method="POST" enctype="multipart/form-data">
	<div class="holder_input">
		<input type="file" name="uploaded_data_files[]" id="clone_input" />
		<input type="hidden" name="txtdictionary" id="txtdict" value="<?php echo $title; ?>">
	</div>
	<input type="submit" value="add_files" />
</form>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: left; width: 100%">
<div id="files-list">
<select id="flist"><option value="">Select from uploaded files</option></select>
<input type="button" value="Get Array from CSV" onclick="get();">
</div>
<input type="button" value="Validate" onclick="validate();">
<textarea rows="40" cols="400" id="textbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="xmlbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="databox" style="display: none"></textarea>

<textarea rows="40" cols="400" id="tbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="xbox" style="display: none"></textarea>
<textarea rows="40" cols="400" id="dbox" style="display: none"></textarea>

</td>
</tr>
<tr>
<td colspan="2" style="text-align: left; width: 100%">
<div id="gridbox" width="100%" height="250px" style="background-color:white;"></div>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: left; width: 100%">
<div id="gbox" width="100%" height="250px" style="background-color:white;"></div>
</td>
</tr>

</table>
</body>

</html>
