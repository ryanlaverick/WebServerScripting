<?php

    include 'DbConn.php';
    $conn = OpenConn();

    if(isset($_POST['user_edited'])) {
        if(isset($_POST['faultTitle']) && isset($_POST['faultDescription']) && isset($_POST['faultLocation'])) {
            if(!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            session_start();
            
            $faultTitle = $_POST['faultTitle'];
            $faultDescription = $_POST['faultDescription'];
            $faultLocation = $_POST['faultLocation'];
            $faultTechnician = 'Unassigned';
            $faultStatus = 'Unresolved';
            $date = date('m.d.y');
            
            if($faultTitle != "" && $faultDescription != "" && $faultLocation != "") {
                
                $sqlStatement = "INSERT INTO faults (faultTitle, faultDescription, faultLocation, faultTechnician, faultStatus, faultReportedDate) " . "VALUES ('$faultTitle', '$faultDescription', '$faultLocation', '$faultTechnician', '$faultStatus', '$date')";

                if(mysqli_query($conn, $sqlStatement)) {
                    echo "New record created successfully!";
                } else {
                    echo "Error: " . $sqlStatement . "<br>" . $conn->error;
                }

                
            }
            
            else {
                echo "You have failed to complete a necessary field!";
                exit();
            }
        }

        else {

            if(!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if($conn) {
                include 'report.html';
                exit();
            }

        }
    }

    CloseConn($conn);
?>


