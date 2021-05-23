<?php
    include 'DbConn.php';
    $conn = OpenConn();

    if(isset($_POST['user_edited'])) {
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        session_start();
        
        if(isset($_POST['faultID'])) {
            $faultToUpdate = $_POST['faultID'];
            
            if($_POST['faultTitle'] == "" || $_POST['faultDescription'] == "" || $_POST['faultLocation'] == "" || $_POST['faultTechnician'] == "" || $_POST['faultStatus'] == "") {
                echo "You have failed to complete one of the necessary fields!";
                exit();
            }
            
            $faultExistsQuery = "SELECT * FROM faults WHERE faultID=" . $faultToUpdate;
            $faultExistsResult = mysqli_query($conn, $faultExistsQuery);
            
            if(!$faultExistsResult) {
                echo "Could not update fault with ID " . $faultToUpdate . ". Error: " . mysqli_connect_error();
                exit();
            }
            
            $rows = mysqli_num_rows($faultExistsResult);
            
            if($rows == 0) {
                echo "No fault with ID " . $faultToUpdate . " could be found! Please try again...";
                exit();
            }
            
            if(isset($_POST['faultTitle']) && isset($_POST['faultDescription']) && isset($_POST['faultLocation']) && isset($_POST['faultTechnician']) && isset($_POST['faultStatus'])) {
                $faultID = $faultToUpdate;
                $faultTitle = $_POST['faultTitle'];
                $faultDescription = $_POST['faultDescription'];
                $faultLocation = $_POST['faultLocation'];
                $faultTechnician = $_POST['faultTechnician'];
                $faultStatus = $_POST['faultStatus'];
                
                $updateFaultQuery = "UPDATE faults SET faultTitle='".$faultTitle."',faultDescription='".$faultDescription."',faultLocation='".$faultLocation."',faultTechnician='".$faultTechnician."',faultStatus='".$faultStatus."' WHERE faultID='".$faultID . "'";
                $result = mysqli_query($conn, $updateFaultQuery);
                
                if(!$result) {
                    echo "SQL update failed: " . mysqli_error($conn);
                    exit();
                }
                
                echo "Fault with ID " . $faultID . " updated successfully!";
            }
            
            else {
                echo "You have failed to complete one of the necessary fields!";
                exit();
            }
        }
    }

?>