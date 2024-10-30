<?php
include('conn.php'); // Include the database connection

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize and validate the ID from the URL
    $delete_id = intval($_GET['id']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM usertablename WHERE id = ?");
    if (!$stmt) {
        die("<p style='color:red; text-align:center;'>Failed to prepare statement</p>");
    }

    // Bind the parameter and execute the statement
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<p style='color:green; text-align:center;'>User deleted successfully</p>";
    } else {
        error_log("Failed to execute delete statement: " . $stmt->error);
        echo "<p style='color:red; text-align:center;'>Failed to delete user</p>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<p style='color:red; text-align:center;'>Invalid request</p>";
}

// Redirect back to the display page or another page
header("Location: display.php"); // Change to your display file name
exit;
?>


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
        select, input[type="text"] {
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
    <form action="#" method="POST">
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
            
            <input type="checkbox" name="check" id="agree" required>
            <label for="agree">I agree to the terms and conditions</label>
            <br>
            
            <button name="register">Register</button>
        </div>
    </form>
</body>
</html>
