<?php
# the class that performs the API call
require_once('RestCallRequest.php');

# OPTION 1: place your data here in between <<<DATA and DATA, formatted according to the type and format you've set below
$YOUR_DATA = <<<DATA
aacd_studyid
"test_001"
"test_007"
"test_008"
DATA;

# or OPTION 2: fill the variable with data from a file
//$YOUR_DATA = file_get_contents(YOUR_FILE)

# an array containing all the elements that must be submitted to the API
$data = array('content' => 'record', 'type' => 'flat', 'format' => 'csv', 'token' => '837A31CE3C01D304D9370F6F612990B8', 
	'data' => $YOUR_DATA);

# create a new API request object
$request = new RestCallRequest("http://redcap-dev.neuro.emory.edu/redcap/api/", 'POST', $data);

# initiate the API request
$request->execute();

# the following line will print out the entire HTTP request object 
# good for testing purposes to see what is sent back by the API and for debugging 
//echo '<pre>' . print_r($request, true) . '</pre>';

# print the output from the API 
echo $request->getResponseBody();
?>
