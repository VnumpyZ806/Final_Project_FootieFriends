<html> <!-- Opening HTML tag -->
<head> <!-- Head section containing metadata and links -->
    <meta charset="UTF-8"> <!-- Sets character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design setup -->
    <title>FootieFriends - Play Football with Friends</title> <!-- Page title -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/.../css/all.min.css"> <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="./style.css"> <!-- Link to external CSS file -->
</head>
<body> <!-- Body starts -->
<header> <!-- Header with navigation menu -->
    <div class="header-content">
        <img src="..." alt="FootieFriends Logo" class="logo"> <!-- Logo image -->
        <nav>
            <ul>
                <li><a href="./index.html#about">About Us</a></li>
                <li><a href="./index.html#games">Games</a></li>
                <li><a href="./index.html#community">Community</a></li>
                <li><a href="/index.html#contact" class="btn">Contact</a></li>
                <li><a href="/index.html#games" class="btn">Book the Game</a></li>
                <li><a href="#" class="btn" onclick="openLoginForm()">Log In</a></li>
                <li><a href="./registration.html" class="btn">Sign up</a></li>
            </ul>
        </nav>
    </div>
</header>
<?php
    // Database connection variables
    $db_server = "localhost";
    $db_user = "foot_arthur";
    $db_pass = "123456";
    $db_name = "foot_footiefriends";
    $conn = ""; // Initialize connection variable

    // Establish a connection to the database
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if ($conn) {
        // Connection successful (commented out message)
    } else {
        echo "error was, " . mysqli_connect_error(); // Output error if connection fails
        echo "Could not connect!";
    }

    // SQL query to authenticate user credentials
    $sqlquery = "select uname, password from users where uname = '" . $_POST['uname'] . "' and password = '" . $_POST['passwd'] . "';";
    $result = $conn->query($sqlquery); // Executes the query

    if ($result->num_rows > 0) { // Checks if user exists
        $sqlquery = "select gameID, gameLocation, gameDate, gameTime from games;"; // Query to fetch game details
        $result = $conn->query($sqlquery);
        
        echo '<table>'; // Start HTML table
        echo "<tr>"; // Table row
        echo "<th>gameID</th> <th>gameLocation</th> <th>Date</th> <th>Time</th> <th>Join Game</th></tr>"; // Table headers

        while ($row = $result->fetch_row()) { // Loop through each game
            echo "<tr>";
            echo "<td>" . $row[0] . "</td> <td> " . $row[1] . "</td> <td> " . $row[2] . "</td> <td>" . $row[3] . "</td> <td> <button id='joinButton' onclick=\"joinGame(" . $row[0] . ")\"> Join Game </button> </td> </tr>"; 
            // Displays game details and creates a Join Game button with an onclick event calling `joinGame()` function with the gameID as parameter
        }
        echo "</table>"; // End table
    } else {
        echo "You are not authorised to access this content"; // Display if authentication fails
    }
    $conn->close(); // Close database connection
?>

<script> 
function joinGame(gameID) { 
  var xhr = new XMLHttpRequest(); // Create a new AJAX request
  xhr.open("POST", "join_game.php", true); // Sets the request to POST and target to join_game.php
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Sets the header
  xhr.onreadystatechange = function() { // Event handler for request state changes
    if (xhr.readyState == 4 && xhr.status == 200) { // When request is complete and successful
      if (xhr.status == 200) { 
        var button = document.getElementById("joinButton"); // Find the button by ID
        button.textContent = "Joined: " + gameID; // Change button text to indicate joined game
        button.disabled = true; // Disable the button
      } else {
        alert("Error joining game."); // Alert if there is an error
      }
    }
  };
  xhr.send("gameID=" + gameID); // Sends the gameID to the server
}
</script>

<?php
// join_game.php (PHP code to handle game joining)

// Retrieve the gameID from POST request
$gameID = $_POST['gameID'];

// Get the user ID from session or hardcoded for demo purposes
$userID = 1; 

// Prepare and execute the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO joined_games (user_id, game_id) VALUES (?, ?)");
$stmt->bind_param("ii", $userID, $gameID); // Bind user ID and game ID

if ($stmt->execute()) { // Execute statement
  echo "success"; // If successful
} else {
  echo "Error: " . $stmt->error; // Output error message
}

$stmt->close(); // Close statement
$conn->close(); // Close database connection
?>

<div><h2>My previous games</h2> <!-- Section for previous games -->
<?php
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name); // Re-establish connection

    if ($conn) {
        // echo "Connected";
    } else {
        echo "error: " . mysqli_connect_error();
    }

    // Query to select previous games
    $sqlquery = "select gameID, gameLocation, gameDate, gameTime from games where gameDate <= '2025-01-09';";
    $result = $conn->query($sqlquery);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo "<tr><th>gameID</th><th>gameLocation</th><th>Date</th><th>Time</th><th>Join Game</th></tr>";
        while ($row = $result->fetch_row()) {
            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td><button> Join Game </button></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No previous games found.";
    }
    $conn->close();
?>
</div>
<div><h2>My current games</h2> <!-- Section for current games -->
<?php
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name); // Reconnect

    if ($conn) {
        // echo "Connected";
    } else {
        echo "error: " . mysqli_connect_error();
    }

    // Query to fetch current games
    $sqlquery = "select gameID, gameLocation, gameDate, gameTime from games;";
    $result = $conn->query($sqlquery);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo "<tr><th>gameID</th><th>gameLocation</th><th>Date</th><th>Time</th><th>Join Game</th></tr>";
        while ($row = $result->fetch_row()) {
            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td><button> Join Game </button></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No current games found.";
    }
    $conn->close();
?>
</body>
</html>

