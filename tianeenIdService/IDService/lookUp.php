<?php
$connection = new MongoClient();
#$connection = new MongoClient( "mongodb:://node15.cci.emory.edu");
$db = $connection->patient_sample_reg;
$collection = $db->sample_data_registry;
$firstName = $_GET['firstname'];
$lastName = $_GET['lastname'];
$arrFind = array("name_first"=>$firstName,"name_last"=>$lastName,);
$cursor = $collection->find($arrFind);
$document = "";
foreach ($cursor as $doc)
{
	$document = $doc;
}

if($document != NULL && $document != "")
{
	echo json_encode($document);
}

else
	echo json_encode("{\"value\" : \"nosuchpatient\"}");
?>
