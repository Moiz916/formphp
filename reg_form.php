<?php include('conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        div {
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            width: 300px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 1rem;
            display: inline-block;
            margin-bottom: 10px;
        }
        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            color: white;
            background-color: #007BFF;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <form action="#" method="POST" enctype="multipart/form-data">
        <h1>Registration Form</h1>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required><br>
            
            <label for="gender">Gender</label>
            <select name="gender" id="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="custom">Custom</option>
            </select><br>

            <label for="filetoupload">Choose file to upload:</label>
            <input type="file" name="filetoupload" required><br>
            
            <input type="checkbox" name="check" id="agree" required>
            <label for="agree">I agree to the terms and conditions</label>
            <br>
            
            <button type="submit" name="register">Register</button>
        </div>
    </form>
</body>
</html>

<?php
if (isset($_POST['register'])) {
    $fname = htmlspecialchars($_POST['name']);
    $gender = htmlspecialchars($_POST['gender']);
    $check = isset($_POST['check']) ? 1 : 0;

    if ($check && isset($_FILES['filetoupload'])) {
        $filename = $_FILES['filetoupload']['name']; 
        $tempname = $_FILES['filetoupload']['tmp_name'];
        $folder = "images/" . basename($filename); 

        if (move_uploaded_file($tempname, $folder)) {
            echo "<br>File uploaded successfully!";
            echo "<br><img src='" . htmlspecialchars($folder) . "' alt='Image Preview' width='100' height='100'/>";

            // Insert into the database using a prepared statement
            $query = $conn->prepare("INSERT INTO usertablename (file_name, name, gender) VALUES (?, ?, ?)");
            $query->bind_param("sss", $filename, $fname, $gender);
            
            if ($query->execute()) {
                echo "<p style='color:green; text-align:center;'>Data inserted successfully</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Failed to insert data</p>";
            }
        } else {
            echo "<br>Failed to upload the file.";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>You must agree to the terms and conditions</p>";
    }
}
?>
