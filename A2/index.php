<html>
    <head>
        <title>Home</title>
    </head>

    <body>
        <?php
            include 'DbConn.php';
            $conn = OpenConn();

            $homePageViewsQuery = "SELECT * FROM statistics WHERE id=1";
            $homePageViewsResult = mysqli_query($conn, $homePageViewsQuery);
            if(!$homePageViewsResult) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }
            $homePageViewsAssocData = mysqli_fetch_assoc($homePageViewsResult);
            $homePageViews = $homePageViewsAssocData['homePageViews'];
            $newHomePageViews = $homePageViews + 1;

            $homePageViewsUpdateQuery = "UPDATE statistics SET homePageViews='" . $newHomePageViews . "' WHERE id='1'";
            $result = mysqli_query($conn, $homePageViewsUpdateQuery);
            if(!$result) {
                echo "MySQL Query error: " . mysqli_error($conn);
                exit();
            }

            CloseConn($conn);
        ?>
        
        <button id="reportFault" type="button">Report fault</button>
        <button id="viewReportedFaults" type="button">View reported faults</button>
        <button id="login" type="button">Login</button>

        <script type="text/javascript">
            document.getElementById("reportFault").onclick = function () {
                location.href = "report.html";
            }

            document.getElementById("viewReportedFaults").onclick = function () {
                location.href = "viewFaults.php";
            }

            document.getElementById("login").onclick = function () {
                location.href = "login.html";
            }
        </script>
        
    </body>
</html>