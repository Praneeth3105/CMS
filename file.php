<html>
    <body>
        <form method="post" enctype="multipart/form-data">
        <input type="file" name="image1">
        <input type="submit" name="submit" value="submit">

        </form>
    </body>
</html>
<?php
include "db_conn.php";
if (isset($_POST['submit'])) {
  
    $filename = $_FILES['image1']['name'];
    $tempname = $_FILES['image1']['tmp_name'];    
        $folder = "images/".$filename;

        $sql = "INSERT INTO pic (photo) VALUES ('$filename')";
  
        mysqli_query($conn, $sql);
          
        if (move_uploaded_file($tempname, $folder))  {
            echo "Image uploaded successfully";
        }else{
            echo "Failed to upload image";
      }
  }
?>
