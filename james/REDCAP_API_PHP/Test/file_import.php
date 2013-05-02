<?php
error_reporting(-1);

# the class that performs the API call
require_once('RestCallRequest.php');

# full path and filename of the file to upload
$file = 'testForExportFile.test';
$filepath = '/srv/www/laravel/public/';
# an array containing all the elements that must be submitted to the API
$data = array('content' => 'file', 'action' => 'import', 'record' => '', 
			  'field' => '', 'event' => '', 'token' => '837A31CE3C01D304D9370F6F612990B8', 'file' => "@$file");

# create a new API request object
$request = new RestCallRequest("http://redcap-dev.neuro.emory.edu/redcap/api/", 'POST', $data);

# initiate the API request
$request->execute();

# Display the response from the API
echo $request->getResponseBody();
