
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            text-align : center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        div {
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            width: 300px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="#" method="POST">
            
                <label for="username">Username :</label>
                <input type="text" name="username"><br><br><br>
                <label for="password">Password :</label>
                <input type="password" name="password"><br><br><br>
                <button name="login">Login</button>
            
            
        </form>
    </div>
</body>
</html>


<?php
include('conn.php');
    session_start();
    if (isset($_POST['login']))
    {
            $fname = trim($_POST['username']);
            $fpassword = trim($_POST['password']);
        
            if (empty($fname) || empty($fpassword)) {
                echo "<p style='color:red;'>Username or Password is missing.</p>";
                exit();
            }

        $sql = "SELECT * FROM log_in WHERE username='$fname' AND password='$fpassword' ";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $_SESSION['username']=$fname;
            echo"</br>Login successful";
            header("Location:display.php");
        }
        else{
            echo "</br>Invalid Username password";
        }
    }
    
?>