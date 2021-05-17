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

// Dates for the beginning and end of the date range chosen
$start_date = $_POST['startdate'];
$end_date = $_POST['enddate'];

// Arguments for the first commodity chosen
$fruit_1    = $_POST['fruit_1'];
$parish_1   = $_POST['parish_1'];
$grade_1    = $_POST['grade_1'];
$price_1    = $_POST['price_selection_1'];
$variety_1  = $_POST['variety_1'];

// Arguments for the second commodity chosen
$fruit_2    = $_POST['fruit_2'];
$parish_2   = $_POST['parish_2'];
$grade_2    = $_POST['grade_2'];
$price_2    = $_POST['price_selection_2'];
$variety_2  = $_POST['variety_2'];

// MySQL queries for selecting the data in the table which satisfies the criteria prescribed by the user
$sql_1 = "SELECT Commodity, Date, $price_1, Supply, Parish FROM farmgate_jam WHERE Date BETWEEN '$start_date' AND '$end_date'AND Commodity = '$fruit_1' AND Parish = '$parish_1' AND Variety = '$variety_1'";
$sql_2 = "SELECT Commodity, Date, $price_2, Supply, Parish FROM farmgate_jam WHERE Date BETWEEN '$start_date' AND '$end_date'AND Commodity = '$fruit_2' AND Parish = '$parish_2' AND Variety = '$variety_2'";


// Performing the queries
$result_1 = $conn->query($sql_1);
$result_2 = $conn->query($sql_2);

// Initializing the arrays which will store the results to be sent back to the browser
$data_1    = array();
$data_2   = array();
$entries_1 = array();
$entries_2 = array();

// Fetching each row of data from the query responses and encoding them in JSON format.
while($data_1 = $result_1->fetch_assoc()) {
    $entry_1 = array('x'=>strtotime($data_1['Date']), 'y'=>intval($data_1[$price_1]), 'z'=>intval($data_1['Supply']), 'name'=>"(1)" . $data_1['Commodity']." in ".$data_1['Parish'], 'realdate'=>date("d-M-Y",strtotime($data_1['Date'])));
    $entry_encoded_1 = json_encode($entry_1);
    $entries_1[] = $entry_encoded_1; 
};

while($data_2 = $result_2->fetch_assoc()) {
    $entry_2 = array('x'=>strtotime($data_2['Date']), 'y'=>intval($data_2[$price_2]), 'z'=>intval($data_2['Supply']), 'name'=>"(2)" . $data_2['Commodity']." in ".$data_2['Parish'], 'realdate'=>date("d-M-Y",strtotime($data_2['Date'])));
    $entry_encoded_2 = json_encode($entry_2);
    $entries_2[] = $entry_encoded_2;
};


// Convert each array of JSON objects to a string to be sent to the browser

if ($entries_1 != NULL) { 
  $imploded_array_1 = implode("/", $entries_1); 
  } else {
    $imploded_array_1 = NULL;
  };

if ($entries_2 != NULL) {
  $imploded_array_2 = implode("/", $entries_2);
} else {
  $imploded_array_2 = NULL;
};

// Creating a new array to contain the imploded arrays
$imploded_arrays_array = array("First"=>$imploded_array_1, "Second"=>$imploded_array_2);

// Combining the two imploded arrays into a single string and separating them with a "++" delimiter
$imploded_arrays_string = implode("++", $imploded_arrays_array);

// Send response back to browser in JSON format
echo $imploded_arrays_string;

?>