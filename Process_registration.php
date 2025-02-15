Process_registration.php

<html> 
<head>
    <meta charset="UTF-8"> 
    <!-- Sets character encoding to UTF-8, ensuring the webpage displays text correctly in various languages. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Makes the webpage responsive to different screen sizes. -->
    <title>FootieFriends - Play Football with Friends</title> 
    <!-- Sets the title of the webpage shown on the browser tab. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <!-- Links to Font Awesome for icon usage. -->
    <link rel="stylesheet" href="./style.css"> 
    <!-- Links to an external CSS file for page styling. -->
</head>
<?php
    // Database connection parameters
    $db_server = "localhost"; 
    $db_user = "foot_arthur"; 
    $db_pass = "123456"; 
    $db_name = "foot_footiefriends"; 
    $conn = ""; 
    // Initializes an empty connection variable.

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name); 
    // Connects to the MySQL database using provided credentials.

    if($conn){
        // echo"You are connected!";
        // If connection is successful, this comment line is provided for debugging but is commented out.
    } else {
        echo "error was, " . mysqli_connect_error(); 
        // Displays the connection error message.
        echo"Could not connect!";
        // Displays a generic connection failure message.
    }

    // SQL query to insert user registration data into the `users` table.
    $sqlquery = "INSERT INTO users(uname,password,Email, First_name, Last_name) 
                values('" . $_POST['uname'] ."', '" . $_POST['passwd'] . "','" . $_POST['email'] . "','" . $_POST['First_name'] . "','" . $_POST['Last_name'] . "')". ";";
    // Takes user input from the registration form and constructs an SQL `INSERT` query dynamically.

    $result = $conn->query($sqlquery); 
    // Executes the SQL query.

    if ($result) { 
        echo "Registration success!";
        // Displays success message if the query was executed successfully.
    } else {
        echo "Registration failed!";
        // Displays failure message if the query execution failed.
    }
    $conn->close(); 
    // Closes the database connection.
?>
</html>

