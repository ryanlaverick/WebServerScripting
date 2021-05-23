

<html>
    <head>
        <title>Statistics</title>
    </head>
    
    <body>
        <?php
            include 'DbConn.php';
            $conn = OpenConn();
        
            if(!$conn) {
                die("MySQL Connect error: " . mysqli_connect_error());
            }
        
            $homePageViewsQuery = "SELECT * FROM statistics WHERE id=1";
            $homePageViewsResult = mysqli_query($conn, $homePageViewsQuery);
            if(!$homePageViewsResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            $homePageViewsAssocData = mysqli_fetch_assoc($homePageViewsResult);
            $homePageViews = $homePageViewsAssocData['homePageViews'];
            echo "<h1>Home page views: " . $homePageViews . "</h1>";
            echo "<br><br>";
        
        
            echo "<h1>Fault info</h1>";
        
            $totalFaultsReportedQuery = "SELECT * FROM faults";
            $totalFaultsReportedResult = mysqli_query($conn, $totalFaultsReportedQuery);
            if(!$totalFaultsReportedResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            $totalFaults = mysqli_num_rows($totalFaultsReportedResult);
            echo "<p>Total number of faults reported: " . $totalFaults . "</p>";
        
        
            $resolvedFaultsQuery = "SELECT * FROM faults WHERE faultStatus='Resolved'";
            $resolvedFaultsResult = mysqli_query($conn, $resolvedFaultsQuery);
            if(!$resolvedFaultsResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            $resolvedFaults = mysqli_num_rows($resolvedFaultsResult);
            echo "<p>Total number of resolved faults: " . $resolvedFaults . "</p>";
        
        
            $unresolvedFaultsQuery = "SELECT * FROM faults WHERE faultStatus='Unresolved'";
            $unresolvedFaultsResult = mysqli_query($conn, $unresolvedFaultsQuery);
            if(!$unresolvedFaultsResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            $unresolvedFaults = mysqli_num_rows($unresolvedFaultsResult);
            echo "<p>Total number of unresolved faults: " . $unresolvedFaults . "</p>";
            echo "<br><br>";
        
        
            $numTechniciansQuery = "SELECT * FROM accounts";
            $numTechniciansResult = mysqli_query($conn, $numTechniciansQuery);
            if(!$numTechniciansResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            $numberOfTechnicians = mysqli_num_rows($numTechniciansResult);
            echo "<h1>Technician info</h1>";
            echo "<p>Total number of technicians: " . $numberOfTechnicians . "</p>";
        
            CloseConn($conn);
        ?>
        
        <br><br>
        <a href="index.php">Return to home page</a>
    </body>
</html>