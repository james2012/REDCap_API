<?php
/*
 * Converts CSV to JSON
*/
 
// Arrays
$keys = array();
$newArray = array();
 
// Function to convert CSV into associative array
function csvToArray($file, $delimiter) {
 
  ini_set('auto_detect_line_endings',TRUE);

  if (($handle = fopen($file, 'r')) !== FALSE) { 
    $i = 0; 
    while (($lineArray = fgetcsv($handle)) !== FALSE) {
        for ($j = 0; $j < count($lineArray); $j++) {
        $arr[$i][$j] = $lineArray[$j]; 
      }
    
      ini_set('auto_detect_line_endings',FALSE);

      $i++; 
    }
      
    fclose($handle); 
  } 
  return $arr; 
} 
 
// convert csv to array it
$data = csvToArray('testFile.csv', ',');
 
// Set number of elements (minus 1 because we shift off the first row)
$count = count($data) - 1;
  
//Use first row for names  
$labels = array_shift($data);  
 
foreach ($labels as $label) {
  $keys[] = $label;
}
 
// Add Ids, just in case we want them later
$keys[] = 'id';
 
for ($i = 0; $i < $count; $i++) {
  $data[$i][] = $i;
}
  
// Bring it all together
for ($j = 0; $j < $count; $j++) {
  $d = array_combine($keys, $data[$j]);
  $newArray[$j] = $d;
}
 
// Print it out as JSON
echo json_encode($newArray);
 
?>