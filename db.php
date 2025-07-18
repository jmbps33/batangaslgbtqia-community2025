
<?php
$host = "localhost";
$user = "your_username";
$pass = "your_password";
$dbname = "batangas_lgbtq";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
