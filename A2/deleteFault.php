<?php 
    include 'DbConn.php';
    $conn = OpenConn();
     
    if(isset($_POST['user_edited'])) {
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
     
        session_start();
        
        $faultToDelete = $_POST['faultID'];
        
        if($faultToDelete != "") {
            $sqlSelectStatement = "SELECT * FROM faults";
            $selectResult = mysqli_query($conn, $sqlSelectStatement);
            
            if(!$selectResult) {
                echo "Error: " . mysqli_connect_error();
                exit();
            }
            
            
            if(mysqli_num_rows($selectResult) == 0) {
                echo "No records in database";
                exit();
            }
            
            $sqlCheckIfIDExists = "SELECT * FROM faults WHERE faultID=" . $faultToDelete;
            $idExistsResult = mysqli_query($conn, $sqlCheckIfIDExists);
            
            if(mysqli_num_rows($idExistsResult) == 0) {
                echo "No fault associated with the ID " . $faultToDelete . " could be found! Please try again...";
                exit();
            }
            
            $sqlStatement = "DELETE FROM faults WHERE faultID=" . $faultToDelete;
            $result = mysqli_query($conn, $sqlStatement);
            
            if(!$result) {
                echo "Could not delete fault with ID " . $faultToDelete . ". Error: " . mysqli_connect_error();
                exit();
            }
            
            echo "Deleted fault with ID " . $faultToDelete;
        }
        
        else {
            echo "You have failed to enter the fault ID to delete!";
        }
    } 
?>

