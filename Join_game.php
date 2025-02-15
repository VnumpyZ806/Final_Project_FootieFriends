<?php
// Get the gameID from the request
$gameID = $_POST['gameID']; 
// Retrieves the `gameID` from the form submission (sent via POST method) when the user clicks the "Join Game" button.

echo "success"; 
// Immediately outputs "success" to indicate that the request has been received (though this is premature as the database operation has not yet occurred).

// Connect to the database (replace with your actual connection details)
$db_server = "localhost"; 
$db_user = "foot_arthur"; 
$db_pass = "123456"; 
$db_name = "foot_footiefriends"; 
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name); 
// Establishes a connection to the MySQL database using provided credentials and database name. If unsuccessful, `mysqli_connect()` would return `false`.

// Insert the join record into the database (adjust the table and columns as needed)
$sql = "INSERT INTO joined_games (user_id, game_id) VALUES (YOUR_USER_ID, $gameID)"; 
// Prepares an SQL query to insert a new row into the `joined_games` table, associating a `user_id` with the `game_id`.
// ⚠️ **Error:** The placeholder `YOUR_USER_ID` is incorrect. You must dynamically retrieve the logged-in user’s ID (likely from `$_SESSION['user_id']`).

if ($conn->query($sql) === TRUE) { 
  echo "success"; 
// Executes the query, and if successful, prints "success" again (though it's printed earlier, making this redundant).
} else { 
  echo "Error: " . $sql . "<br>" . $conn->error; 
// If the query fails, outputs the error message along with the SQL statement for debugging.
}

$conn->close(); 
// Closes the database connection after completing the operation.
?>
