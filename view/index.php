<!DOCTYPE HTML>
<html>
    <head>
        <!--Global Style Sheet Imports-->
        <link rel="stylesheet" type="text/css" href="/resources/style/global.css"/>
        
        <title>View All Reports - Cycle Reporter</title>

        <!--Some Little Added Touches For Mobile, And Those Who Care-->
        <link rel="shortcut icon" href="/favicon.ico">
        <meta name="theme-color" content="#191919" />
    </head>

    <body>
        <header><a href="/index.html" class="button">Home</a><a href="/report.html" class="button">Report!</a><a href="/contact/index.html" class="button1">Contact Us</a></header>

        <!--
        <h1>
            Search: 
        </h1>
        <p>
            Search By Anything :)
        </p>

        <form method="post" action="view.php?search" id="searchForm">
            <input type="text" name="name">
            <input type="submit" name="submit" value="Search">
        </form>
        -->

        <p>
            <div style="overflow-x:auto;">
                <?php
                    $debug = true;

                    //DB Info
                    $dbHost = "127.0.0.1";
                    $dbUser = "root";
                    $dbPass = "";
                    $db = "ReportDB";
                    $table = "reports";

                    //SQL Query To Run
                    $sql = "SELECT * FROM $table";



                    //Connect To Database Server
                    $con = mysqli_connect($dbHost, $dbUser, $dbPass)
                        or die("Unable To Connect To Database, Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 1<br>");

                    //Select Database On Server
                    $SelectedDB = mysqli_select_db($con, $db)
                        or die("Could Not Find And Select Database On Server :'( Please Wait And Try Again, {Placids, Are Going, There, }Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 2<br>");

                    //Pull Data Via SQL Query
                    $result = mysqli_query($con,$sql)or die("SQL Error Message: " . mysql_error() . "<br>");

                    echo "<table id='viewAllTBL'>";
                    echo "<tr><th>ID</th><th>Plate Number</th><th>State</th><th>Date</th><th>Perp</th><th>Perp Mail</th><th>Name</th><th>Mail</th><th>Report</th></tr>";

                    while($row = mysqli_fetch_array($result)) {
                        $id = $row["id"];
                        $reprt = $row["reprt"];
                        $plateID = $row["plateID"];
                        $plateState = $row["plateState"];
                        $incDate = $row["incDate"];
                        $perpName = $row["perpName"];
                        $perpMail = $row["perpMail"];
                        $usrName = $row["usrName"];
                        $usrMail = $row["usrMail"];
                        $incLat = $row["incLat"];
                        $incLon = $row["incLon"];

                        echo "<tr><td><a href=indiv.php?id=".$id.">".$id."</a></td><td>".$plateID."</td><td>".$plateState."</td><td>".$incDate."</td><td>".$perpName."</td><td>".$perpMail."</td><td>".$usrName."</td><td>".$usrMail."</td><td>".$reprt."</td></tr>";
                    } 

                    echo "</table>";
                    mysqli_close($con);
                ?>
            </div>
        </p>

        <p>
            Search Coming Soon! Please Use 'Ctrl-F'' For The Time Being, Thanks!
        </p>

    </body>
</html>