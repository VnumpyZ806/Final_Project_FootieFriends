IndexFootieFriends.php with elements of PHP code embedded into HMTL
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootieFriends - Play Football with Friends</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<header>
        <div class="header-content">
            <img src="https://i.ibb.co/CnQDn6N/footiefriends-logo.png" alt="FootieFriends Logo" class="logo">
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

    $db_server = "localhost";
    $db_user = "foot_arthur";
    $db_pass = "123456";
    $db_name = "foot_footiefriends";
    $conn = "";

    $conn = mysqli_connect($db_server, 
    $db_user, $db_pass, $db_name);

    if($conn){
        // echo"You are connected!";
    }
    else{
        echo "error was, " . mysqli_connect_error();
        echo"Could not connect!";
    }

  

    $sqlquery = "select uname, password from users where uname = '" . $_POST['uname'] ."' and password = '" . $_POST['passwd'] . "';";
    $result = $conn->query($sqlquery);

    if ($result->num_rows > 0) {
        $sqlquery="select gameID, gameLocation, gameDate, gameTime from games;";
        $result=$conn->query($sqlquery);
        
            echo '<table>';
            echo "<tr>";
            echo "<th>gameID</th> <th>gameLocation</th> <th>Date</th> <th>Time</th> <th>Join Game</th></tr>";
            while ($row=$result->fetch_row()){
            echo "<tr>";
            echo "<td>" . $row[0] . "</td> <td> " . $row[1] . "</td> <td> " . $row[2]."</td> <td>" . $row[3] ."</td> <td> <button id='joinButton' onclick=\"joinGame(" . $row[0] . ")\"> Join Game </button> </td> </tr> ";
        }
        echo "</table>";
        // echo "<script> myFunction() </script>";
      } else {
        echo "You are not authorised to access this content";
      }
    $conn->close();
?>

<script>
function joinGame(gameID) {
  // Send an AJAX request to the server
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "join_game.php", true); // Replace "join_game.php" with the actual path to your server-side script
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // Handle the response from the server
      if (xhr.status == 200) {
         // window.alert("Joined game");
        // Update the button text
        var button = document.getElementById("joinButton"); // Assuming you give each button a unique ID
        button.textContent = "Joined: " + gameID;
        button.disabled = true;
      } else {
        alert("Error joining game.");
      }
    }
  };
  xhr.send("gameID=" + gameID); 
}
</script>


<?php
// join_game.php

// Get the gameID from the request
$gameID = $_POST['gameID'];

// ... (Database connection code)

// Get the user ID (replace with your actual user ID retrieval logic)
$userID = 1; 

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO joined_games (user_id, game_id) VALUES (?, ?)");
$stmt->bind_param("ii", $userID, $gameID); 

if ($stmt->execute()) {
  echo "success";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>


</div>
<div><h2>My previous games</h2>
<?php

    $db_server = "localhost";
    $db_user = "foot_arthur";
    $db_pass = "123456";
    $db_name = "foot_footiefriends";
    $conn = "";

    $conn = mysqli_connect($db_server, 
    $db_user, $db_pass, $db_name);

    if($conn){
        // echo"You are connected!";
    }
    else{
        echo "error was, " . mysqli_connect_error();
        echo"Could not connect!";
    }

  

    $sqlquery = "select uname, password from users where uname = '" . $_POST['uname'] ."' and password = '" . $_POST['passwd'] . "';";
    $result = $conn->query($sqlquery);

    if ($result->num_rows > 0) {
        $sqlquery="select gameID, gameLocation, gameDate, gameTime from games where gameDate <= '2025-01-09';";
        $result=$conn->query($sqlquery);
        
            echo '<table>';
            echo "<tr>";
            echo "<th>gameID</th> <th>gameLocation</th> <th>Date</th> <th>Time</th> <th>Join Game</th></tr>";
            while ($row=$result->fetch_row()){
            echo "<tr>";
            echo "<td>" . $row[0] . "</td> <td> " . $row[1] . "</td> <td> " . $row[2]."</td> <td>" . $row[3] ."</td> <td> <button> Join Game </button> </td> </tr> ";
        }
        echo "</table>";
        // echo "<script> myFunction() </script>";
      } else {
        echo "You are not authorised to access this content";
      }
    $conn->close();
?>
</div>
<div><h2>My current games </h2></div>
<?php

    $db_server = "localhost";
    $db_user = "foot_arthur";
    $db_pass = "123456";
    $db_name = "foot_footiefriends";
    $conn = "";

    $conn = mysqli_connect($db_server, 
    $db_user, $db_pass, $db_name);

    if($conn){
        // echo"You are connected!";
    }
    else{
        echo "error was, " . mysqli_connect_error();
        echo"Could not connect!";
    }

  

    $sqlquery = "select uname, password from users where uname = '" . $_POST['uname'] ."' and password = '" . $_POST['passwd'] . "';";
    $result = $conn->query($sqlquery);

    if ($result->num_rows > 0) {
        $sqlquery="select gameID, gameLocation, gameDate, gameTime from games;";
        $result=$conn->query($sqlquery);
        
            echo '<table>';
            echo "<tr>";
            echo "<th>gameID</th> <th>gameLocation</th> <th>Date</th> <th>Time</th> <th>Join Game</th></tr>";
            while ($row=$result->fetch_row()){
            echo "<tr>";
            echo "<td>" . $row[0] . "</td> <td> " . $row[1] . "</td> <td> " . $row[2]."</td> <td>" . $row[3] ."</td> <td> <button> Join Game </button> </td> </tr> ";
        }
        echo "</table>";
        // echo "<script> myFunction() </script>";
      } else {
        echo "You are not authorised to access this content";
      }
    $conn->close();
?>
</body>
</html>
