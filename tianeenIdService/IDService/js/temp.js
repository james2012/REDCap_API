
   $('#signupbtn').click( function () {
   	 var patientKey = $('#patientkey').val();
	 var firstName = $('#firstname').val();
   	 var lastName = $('#lastname').val();
	 var dob = $('#dob').val();
	 var language = $('#language').val();
	 var marryStat = $('#marrystat').val();
	 var race = $('#race').val();
	 var gender = $('#gender').val();
	 
   	 var newPatient = '{"_id" : "'+patientKey+'", '+
		'"patient_key" : "'+patientKey+'", '+
		'"name_first" : "'+firstName+'", '+
		'"name_last" : "'+lastName+'", '+
		'"dob" : "'+dob+'", '+
		'"language" : "'+language+'", '+
		'"marital_status" : "'+marryStat+'", '+
		'"race" : "'+race+'", '+
		'"gender" : "'+gender+ '" '+
		'}';
	
	var json_object = JSON.stringify(newPatient);
	
	$.ajax({
		url : 'register.php',
		dataType : 'json',
		type : 'post',
		data : "object="+json_object,
		success : function(data)
		{alert("successful post");}
	});
   });
