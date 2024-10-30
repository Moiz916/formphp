<?php
session_start();
include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details
$query = "SELECT * FROM usertablename";
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: lightblue;
            font-weight: bold;
        }
        img {
            display: block;
            margin: 0 auto;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>User Details</h1>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']); ?></h2>

    <table>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($result = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td>
                    <img src="<?= "images/" . htmlspecialchars($result['file_name']); ?>" alt="User Image" width="50" height="50">
                    <!-- <img src='" . htmlspecialchars($folder) . "' alt='Image Preview' width='100' height='100'/>"; -->
                </td>
                <td><?= htmlspecialchars($result['id']); ?></td>
                <td><?= htmlspecialchars($result['name']); ?></td>
                <td><?= htmlspecialchars($result['gender']); ?></td>
                <td>
                    <a href="update.php?id=<?= urlencode($result['id']); ?>">Update</a> |
                    <a href="delete.php?id=<?= urlencode($result['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="logout.php">Logout</a><br>
    <a href="reg_form.php">Insert Data</a>
</body>
</html>
