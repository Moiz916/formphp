<?php 

$servername = "localhost";
$username = "root";
$password="";
$dbname="registration_form";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if ($conn)
{
    echo "connection sucessful";
}
else
{
    echo "connection failed";
}
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
?>