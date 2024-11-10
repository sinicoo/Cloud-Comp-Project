<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$full_name = $_POST['full_name'];
$bday = $_POST['bday'];
$gender = $_POST['gender'];
$phone_number = $_POST['phone_number'];
$location = $_POST['location'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO users (full_name, bday, gender, phone_number, location, email, password)
VALUES ('$full_name', '$bday', '$gender', '$phone_number', '$location', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
header("Location: display_ad.php?email=" . $email);
exit();
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>