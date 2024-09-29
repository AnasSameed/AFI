<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "afi_webapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$name = $age = $gender = $hospital_no = $date_of_admission = $contact_no = "";
$address = $permanent_address = $history_of_travel = $history_of_rain = "";
$education = $occupation = $co_morbidities = $symptoms = $signs = $investigations = $treatment = "";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $hospital_no = $_POST["hospital_no"];
    $date_of_admission = $_POST["date_of_admission"];
    $contact_no = $_POST["contact_no"];
    $address = $_POST["address"];
    $permanent_address = $_POST["permanent_address"];
    $history_of_travel = $_POST["history_of_travel"];
    $history_of_rain = $_POST["history_of_rain"];
    $education = $_POST["education"];
    $occupation = $_POST["occupation"];
    $co_morbidities = implode(", ", $_POST["co_morbidities"]);  // Handle multiple checkboxes
    $symptoms = $_POST["symptoms"];
    $signs = $_POST["signs"];
    $investigations = $_POST["investigations"];
    $treatment = $_POST["treatment"];
}

// Insert query
$insert_query = "INSERT INTO patient_info (name, age, gender, hospital_no, date_of_admission, contact_no, address, permanent_address, history_of_travel, history_of_rain, education, occupation, co_morbidities, symptoms, signs, investigations, treatment)
VALUES ('$name', $age, '$gender', '$hospital_no', '$date_of_admission', '$contact_no', '$address', '$permanent_address', '$history_of_travel', '$history_of_rain', '$education', '$occupation', '$co_morbidities', '$symptoms', '$signs', '$investigations', '$treatment')";

if ($conn->query($insert_query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insert_query . "<br>" . $conn->error;
}

$conn->close();
?>
