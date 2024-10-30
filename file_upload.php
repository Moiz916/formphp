<?php
include('conn.php');

if (isset($_POST['submit'])) 
{
    if (isset($_FILES['fileToUpload'])) 
    {
        $filename = $_FILES['fileToUpload']['name'];   
        $tempname = $_FILES['fileToUpload']['tmp_name'];
        $folder =  basename($filename);

        if (move_uploaded_file($tempname, $folder)) 
        {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);

            $sql = "INSERT INTO usertablename (name, gender, file_name) VALUES ('$name', '$gender', '$filename')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<br>File uploaded and data saved successfully!";
                echo "<br><img src='" . htmlspecialchars($folder) . "' alt='Image Preview' width='300'>";
            } else {
                echo "<br>Failed to save data to the database.";
            }
        } 
        else 
        {
            echo "<br>Failed to upload the file.";
        }
    } 
    else 
    {
        echo "<br>No file was uploaded.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload</title>
</head>
<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" required><br><br>

        <label for="gender">Gender:</label><br>
        <select name="gender" id="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="custom">Custom</option>
        </select><br><br>

        <label for="fileToUpload">Choose an image to upload:</label><br><br>
        <input type="file" name="fileToUpload" id="fileToUpload" required><br><br>
        
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>
</html>
