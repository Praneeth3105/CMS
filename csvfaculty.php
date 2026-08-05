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
if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
    $file = $_FILES['csvFile']['tmp_name'];

    $handle = fopen($file, "r");
    $columns = fgetcsv($handle, 1000, ",");

    echo '<h2>CSV Preview:</h2>';
    echo '<table border="1">';
    echo '<tr>';
    foreach ($columns as $column) {
        echo '<th>' . $column . '</th>';
    }
    echo '</tr>';
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        echo '<tr>';
        foreach ($data as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';

        $id = isset($data[1]) ? $data[1] : ''; 
        $name = isset($data[3]) ? $data[3] : ''; 
        $department = isset($data[2]) ? $data[2] : ''; 
        $year = isset($data[4]) ? $data[4] : ''; 
        $password = isset($data[1]) ? $data[1] : ''; 
        $email = isset($data[0]) ? $data[0] : ''; 
        $sql = "INSERT INTO faculty (id, name, department, year, password, email) VALUES ('$id', '$name', '$department', '$year', '$password', '$email')";
        $conn->query($sql);
    }

    echo '</table>';
    fclose($handle);

    echo '<br>';
    echo 'CSV data inserted into the database successfully.';
} else {
    echo "Error uploading the CSV file.";
}
$conn->close();
?>