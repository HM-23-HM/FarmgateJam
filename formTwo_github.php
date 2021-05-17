<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Arguments for the commodity and parish chosen
$fruit      = $_POST['fruit_3'];
$parish     = $_POST['parish_3'];
$year       = $_POST['yearChoice'];
$grade      = $_POST['grade_3'];
$price      = $_POST['price_selection_3'];
$variety    = $_POST['variety_3'];

// Initializing the arrays which will store the results to be sent back to the browser
$data_1 = array();

// MySQL queries for selecting the data for each year in the table which satisfies the criteria prescribed by the user
if (isset($_POST['yearChoice'])) {
  $sql_1 = "SELECT Commodity, Date, $price, Supply, Year FROM farmgate_jam WHERE Year = '$year' AND Commodity = '$fruit' AND Parish = '$parish' AND Grade='$grade' AND Variety='$variety'";
  
  // Performing the query
  $result_1 = $conn->query($sql_1);

  // Fetching each row of data from the query response and encoding it in JSON format.
  while($data_1 = $result_1->fetch_assoc()) {
    $entry_1 = array('x'=> strtotime($data_1['Date']), 'y'=>intval($data_1[$price]), 'z'=>intval($data_1['Supply']), 'name'=>$data_1['Commodity'], "year"=> $data_1['Year']);
    $entry_encoded_1 = json_encode($entry_1);
    $entries_1[] = $entry_encoded_1;

  };
};

// Convert each array of JSON objects to a string to be sent to the browser

if (isset($entries_1)) { 
  $imploded_array_1 = implode("/", $entries_1); 
} else {
  $imploded_array_1 = NULL;
};

echo $imploded_array_1;

?>