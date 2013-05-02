  





 function get() {
	alert ("Start Function");
      // retrieve data
	// here should load a local file or a remote file?
	// var data = ".../bmi/data.csv";
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
		mygrid.setHeader(strHeader);
		mygrid.setInitWidths(strInitWidths);
		mygrid.setColAlign(strColAlign);
		mygrid.setColTypes(strColTypes);
		mygrid.setColSorting(strColSorting);
		mygrid.init();
		mygrid.setSkin("dhx_skyblue");
        	mygrid.parse(data,"csv");
		 
	
