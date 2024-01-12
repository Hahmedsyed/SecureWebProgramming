<?php

$servername = "localhost";
$UserName = "root";
$Salary = "mysql";
$dbname = "encryption_demo";


$conn = new mysqli($servername, $UserName, $Salary, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserName = $_POST['UserName'];
    $Salary = $_POST['Salary'];
    $Designation = $_POST['Designation'];

    // Generate a random IV (Initialization Vector)
    $iv = openssl_random_pseudo_bytes(16);

    // Encrypt the Salary using AES encryption
    $secretKey = "your_secret_key"; // Change this to a strong secret key
    $encryptedSalary = openssl_encrypt($Salary, 'aes-256-cbc', $secretKey, 0, $iv);

    $sql = "INSERT INTO hashtable (UserName, Salary, Designation) VALUES ('$UserName', '$encryptedSalary', '$Designation')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS 551 Project</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
			background-image: url('img.jpg');
            background-color: #00ced1;
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #1f2228;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #61dafb; 
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #61dafb; 
			text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
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
    </style>
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h1>Welcome To Haseeb's IA Project HomePage</h1>
    <label for="UserName">Username:</label>
    <input type="text" name="UserName" required>

    <label for="Salary">Salary:</label>
    <input type="Salary" name="Salary" required>

    <label for="Designation">Designation:</label>
    <input type="text" name="Designation" required>

    <input type="submit" value="Submit">
</form>

</body>
</html>



