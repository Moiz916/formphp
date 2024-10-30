<?php
include('conn.php');

if (!isset($_GET['id'])) {
    echo "<script>alert('ID not specified.');</script>";
    exit;
}

$id = intval($_GET['id']);

$query = "SELECT * FROM usertablename WHERE id=$id"; 
$data = mysqli_query($conn, $query);

if (!$result = mysqli_fetch_assoc($data)) {
    echo "<script>alert('No record found for the given ID.');</script>";
    exit;
}

// Pre-fill form fields
$fname = $result['name']; 
$gender = $result['gender'];

if (isset($_POST['update'])) {
    $fname = $_POST['name'];
    $gender = $_POST['gender'];
    $check = isset($_POST['check']) ? 1 : 0;

    if ($check) {
        $query = "UPDATE usertablename SET name='$fname', gender='$gender' WHERE id=$id";
        $data = mysqli_query($conn, $query);

        if ($data) {
            echo "<p style='color:green; text-align:center;'>Data updated successfully</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Failed to update data</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>You must agree to the terms and conditions</p>";
    }
}


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
<form action="" method="POST">
        <h1>Update Form</h1>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($fname); ?>" required><br>
            
            <label for="gender">Gender</label>
            <select name="gender" id="gender" required>
                <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Female</option>
                <option value="custom" <?php if ($gender == 'custom') echo 'selected'; ?>>Custom</option>
            </select><br>
            
            <input type="checkbox" name="check" id="agree" required>
            <label for="agree">I agree to the terms and conditions</label><br>
            
            <a href="display.php">
            <button name="update">Update</button>
            </a>
        </div>
    </form>

    

</body>
</html>


