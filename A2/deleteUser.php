<?php
    include 'DbConn.php';
    $conn = OpenConn();


    if(isset($_POST['user_edited'])) {
        if(isset($_POST['accountName'])) {
            if(!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $accountName = $_POST['accountName'];
            
            if($accountName == "") {
                echo "You cannot leave the account name blank!";
                exit();
            }
            
            $accountExistsQuery = "SELECT * FROM accounts WHERE accountUsername='" . $accountName . "'";
            $accountExistsResult = mysqli_query($conn, $accountExistsQuery);
            
            if(!$accountExistsResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            
            $rows = mysqli_num_rows($accountExistsResult);
            if($rows == 0) {
                echo "Could not find account with name " . $accountName . "! Please try again...";
                exit();
            }
            
            $deleteStatement = "DELETE FROM accounts WHERE accountUsername='" . $accountName . "'";
            $deleteResult = mysqli_query($conn, $deleteStatement);
            
            if(!$deleteResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            
            echo "Account '" . $accountName . "' deleted successfully!"; 
        }
        
        else {
            echo "You have failed to complete the required field!";
            exit();
        }
    }

    else {
        echo "You have failed to complete the required field!";
        exit();
    }

    CloseConn($conn);
?>