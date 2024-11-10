<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];

$sql = "SELECT gender, location FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$gender = $row['gender'];
$location = $row['location'];

// Show different videos based on demographics
if ($gender == 'Male' && $location == 'New York') {
$video = "male_new_york_ad.mp4";
} elseif ($gender == 'Female' && $location == 'Los Angeles') {
$video = "female_la_ad.mp4";
} else {
$video = "generic_ad.mp4";
}
} else {
echo "User not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Advertisement</title>
</head>
<body>
<h2>Advertisement Based on Your Profile</h2>
<video width="640" height="360" controls>
<source src="ads/<?php echo $video; ?>" type="video/mp4">
Your browser does not support the video tag.
</video>
</body>
</html>