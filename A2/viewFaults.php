<!DOCTYPE html>
<html>
    <head>
        <h1>View faults</h1>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    
    <body>
        <?php
            include 'DbConn.php';
            $conn = OpenConn();

            if(!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        
            session_start();

            $sql = "SELECT * FROM faults";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                echo "<table> <tr> <th>ID</th> <th>Fault title</th> <th>Fault description</th> <th>Fault location</th> <th>Fault technician</th> <th>Fault status</th> <th>Fault reported date</th> </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr> <td>" . $row["faultID"] . "</td><td>" . $row["faultTitle"] . "</td><td>" . $row["faultDescription"] . "</td><td>" . $row["faultLocation"] . "</td><td>" . $row["faultTechnician"] . "</td><td>" . $row["faultStatus"] . "</td><td>" . $row["faultReportedDate"] . "</td></tr>";
                }

                echo "</table>";
            }
        
            else {
                echo "0 faults recorded.";
            }
        
            if(isset($_SESSION["logged"])) {
                echo "<br><br><br><br>";
                echo "<a href=updateFault.html>Edit fault</a>";
                echo "<br>";
                echo "<a href=deleteFault.html>Delete fault</a>";
            }

            
        ?>
    
        <br><br>
        <a href="index.php">Return to home page</a>
    </body>
</html>