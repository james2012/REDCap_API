<?php
$connection = new MongoClient();
$db = $connection->patient_sample_reg;
$collection = $db->sample_data_registery;
$data = $_POST['object'];


$json_data = json_decode($data, true);

//error_log($json_data);
error_log($json_data);
$collection->insert($json_data);
?>
