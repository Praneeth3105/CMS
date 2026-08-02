<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV File Upload</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="csvFile">Choose CSV File:</label>
        <input type="file" name="csvFile" id="csvFile" accept=".csv">
        <br>
        <input type="submit" value="Upload">
    </form>

</body>
</html>



<?php
include "db_conn.php";
// Check if a file is uploaded
if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
    // Get the uploaded file
    $file = $_FILES['csvFile']['tmp_name'];

    // Open and read the CSV file
    $handle = fopen($file, "r");

    // Read the first row of the CSV file to get column names
    $columns = fgetcsv($handle, 1000, ",");

    // Display CSV data preview with all columns
    echo '<h2>CSV Preview:</h2>';
    echo '<table border="1">';
    echo '<tr>';
    foreach ($columns as $column) {
        echo '<th>' . $column . '</th>';
    }
    echo '</tr>';

    // Read and display the remaining rows
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        echo '<tr>';
        foreach ($data as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';

        $id = isset($data[1]) ? $data[1] : ''; // Assuming EMPNO is the ID column in the CSV file
        $name = isset($data[3]) ? $data[3] : ''; // Assuming NAME is the name column
        $department = isset($data[2]) ? $data[2] : ''; // Assuming BRANCH is the department column
        $year = isset($data[4]) ? $data[4] : ''; // Assuming YEAR is the year column
        $password = isset($data[1]) ? $data[1] : ''; // You might want to set a default password or handle it differently
        $email = isset($data[0]) ? $data[0] : ''; // Assuming Email Address is the email column
        
        $sql = "INSERT INTO faculty (id, name, department, year, password, email) VALUES ('$id', '$name', '$department', '$year', '$password', '$email')";
        $conn->query($sql);
    }

    echo '</table>';

    // Close the file handle
    fclose($handle);

    echo '<br>';
    echo 'CSV data inserted into the database successfully.';
} else {
    echo "Error uploading the CSV file.";
}

// Close the database connection
$conn->close();
?>