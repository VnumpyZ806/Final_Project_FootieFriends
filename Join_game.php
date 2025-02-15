Join_Game.php

<?php
// Get the gameID from the request
$gameID = $_POST['gameID'];
echo "success";
// Connect to the database (replace with your actual connection details)
$db_server = "localhost";
$db_user = "foot_arthur";
$db_pass = "123456";
$db_name = "foot_footiefriends";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Insert the join record into the database (adjust the table and columns as needed)
$sql = "INSERT INTO joined_games (user_id, game_id) VALUES (YOUR_USER_ID, $gameID)"; // Replace YOUR_USER_ID with the actual user ID

if ($conn->query($sql) === TRUE) {
  echo "success";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
