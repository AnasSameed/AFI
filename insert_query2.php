<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $name = $_POST['name'];
    $pincode = $_POST['pincode'];
    $disease = $_POST['disease'];

    // Store data in a JSON file
    $data = [
        'name' => $name,
        'pincode' => $pincode,
        'disease' => $disease,
    ];

    $file = 'data.json';

    // Get current data from the file
    if (file_exists($file)) {
        $current_data = json_decode(file_get_contents($file), true);
    } else {
        $current_data = [];
    }

    // Add new data
    $current_data[] = $data;

    // Save updated data back to the file
    file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT));

    echo "Data has been saved!";
} else {
    echo "Invalid Request!";
}
?>
