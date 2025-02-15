Process_registration.php

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootieFriends - Play Football with Friends</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
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

  

    $sqlquery = "INSERT INTO users(uname,password,Email, First_name, Last_name) values('" . $_POST['uname'] ."', '" . $_POST['passwd'] . "','" . $_POST['email'] . "','" . $_POST['First_name'] . "','" . $_POST['Last_name'] . "')". ";";

    $result = $conn->query($sqlquery);

    if ($result) {
        echo "Registration success!";
      } else {
        echo "Registration failed!";
      }
    $conn->close();
?>
</html>
