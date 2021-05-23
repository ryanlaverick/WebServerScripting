<?php
    include 'DbConn.php';
    $conn = OpenConn();

    if(isset($_POST['user_edited'])) {
        if($_POST['username'] == "" || $_POST['password'] == "") {
            echo "You have failed to complete a necessary field!"; 
            exit();
        }
        
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error()); 
        }
        
        session_start();
            
        $username = $_POST['username'];
        $password = $_POST['password'];
            
        $accountExistsQuery = "SELECT * FROM accounts WHERE accountUsername='" . $username . "'";
        $existsResult = mysqli_query($conn, $accountExistsQuery);
            
        if(!$existsResult) {
            echo "MySQL Query failed: " . mysqli_error($conn);
            exit();
        }
            
        $rows = mysqli_num_rows($existsResult);
            
        if($rows == 0) {
            echo "An account with the username " . $username . " could not be found! Please try logging in again...";
            exit();
        }
            
        $associatedData = mysqli_fetch_assoc($existsResult);
        $associatedPassword = $associatedData['accountPassword'];
            
        if($password == $associatedPassword) {
            header("Location: admin.html");
            $_SESSION["logged"] = "true";
        }
            
        else {
            echo "Incorrect password! Please try again...";
            exit();
        }
        
    }

    CloseConn($conn);
?>