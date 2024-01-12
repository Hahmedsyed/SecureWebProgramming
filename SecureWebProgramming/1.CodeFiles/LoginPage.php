<?php
session_start();

$servername = "localhost";
$UserName = "root";
$Password = "mysql";
$dbname = "encryption_demo";

$conn = new mysqli($servername, $UserName, $Password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUserName = $_POST['UserName'];
    $inputPassword = $_POST['Password'];

    // This block usses prepared statement to prevent SQL injection
    $sql = "SELECT * FROM login WHERE UserName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUserName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifying the Password
        if ($inputPassword == $row['Password']) {
            $_SESSION['UserName'] = $inputUserName;
            header("Location: HomePage.php");
        } else {
            $error = "Invalid Username Or password";
        }
    } else {
        $error = "Invalid Username or password";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS 551</title>
    <style>
        body {
            background-color: #171a1f;
			background-image: url('img.jpg');
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; 
            margin: 0;
            color: #fff;
        }

        h2 {
            color: #61dafb; 
            text-align: center;
        }

        form {
            background-color: #1f2228; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #61dafb; 
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #4fa3d1; 
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #282c34; 
            color: #fff;
        }

        input[type="submit"] {
            background-color: #61dafb; 
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4fa3d1; 
        }

        p {
            color: #ff3d00;
            text-align: left;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Logon to Haseeb's IA Project</h2>

        <label for="UserName">Username:</label>
        <input type="text" name="UserName" required>

        <label for="Password">Password:</label>
        <input type="password" name="Password" required>

        <input type="submit" value="Login">
    </form>

    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
		
    }
    ?>
</body>
</html>


