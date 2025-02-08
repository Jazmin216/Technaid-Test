<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "technaid";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("failed conection: " . $conn->connect_error);
}
?>
