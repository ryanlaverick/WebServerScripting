<?php
    include 'DbConn.php';
    $conn = OpenConn();

    if(isset($_POST['user_edited'])) {
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        if($_POST['accountUsername'] == "" || $_POST['accountPassword'] == "" || $_POST['confirmAccountPassword'] == "") {
            echo "You have failed to complete a required field!";
            exit();
        }
        
        if(isset($_POST['accountUsername']) && (isset($_POST['accountPassword']) && (isset($_POST['confirmAccountPassword'])))) {
            $username = $_POST['accountUsername'];
            $password = $_POST['accountPassword'];
            $confirmPassword = $_POST['confirmAccountPassword'];
            
            $accountExistsQuery = "SELECT * FROM accounts WHERE accountUsername='" . $username . "'";
            $existsResult = mysqli_query($conn, $accountExistsQuery);
            
            if(!$existsResult) {
                echo "MySQL query failed: " . mysqli_error($conn);
                exit();
            }
            
            $rows = mysqli_num_rows($existsResult);
            
            if($rows > 0) {
                echo "Account already exists! Please try again...";
                exit();
            }
            
            if($password != $confirmPassword) {
                echo "Passwords do not match! Please try again...";
                exit();
            }
            
            $createAccountStatement = "INSERT INTO accounts (accountUsername, accountPassword) VALUES ('$username', '$password')";
            $createResult = mysqli_query($conn, $createAccountStatement);
            
            if(!$createResult) {
                echo "MySQL query failed: " . mysqli_error($conn);
                exit();
            }
            
            echo "Account created successfully!";
        }
        
        else {
            echo "You have failed to complete a necessary field!";
            exit();
        }
    }

    CloseConn($conn);
?>