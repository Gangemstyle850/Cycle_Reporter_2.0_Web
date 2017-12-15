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
        
		<header>
			<div class="rightContainer">
				<div class="loginCtrls">
					<p>
						<small><a href="/signup">Sign Up</a> | <a href="/login">Login</a></small>
					</p>
				</div>
				<div class="dropdown">
					<input class="dropbtn" type="image" src="/resources/drawable/menuIcon.png" />
						<div class="dropdown-content">
							<ul class="dropUl">
								<li class="dropLi"><a class="dropContent" href="/">Home</a></li>
								<li class="dropLi"><a class="dropContent" href="/report">Report!</a></li>
								<li class="dropLi"><a class="dropContent" href="/contact">Contact Us</a></li>
								<li class="dropLi"><a class="dropContent" href="/view">All Reports</a></li>
							</ul>
						</div>
				</div>
			</div>
		</header>
		<h1>All Reports:</h1>
		<p>
            Search Coming Soon! Please Use 'Ctrl-F'' For The Time Being, Thanks!
        </p>
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
                    $dbPass = "password!";
                    $db = "reportdb";
                    $table = "reports";

                    //SQL Query To Run
                    $sql = "SELECT * FROM $table";



                    //Connect To Database Server
                    $con = mysqli_connect($dbHost, $dbUser, $dbPass)
                        or die("Unable To Connect To Database, Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 1<br>");

                    //Select Database On Server
                    $SelectedDB = mysqli_select_db($con, $db)
                        or die("Could Not Find And Select Database On Server :'( Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 2<br>");

                    //Pull Data Via SQL Query
                    $result = mysqli_query($con,$sql)or die("SQL Error Message: " . mysql_error() . "<br>");

                    echo "<table id='viewAllTBL'>";
                    echo "<tr><th>ID</th><th>Plate Number</th><th>State</th><th>Date</th><th>Name</th><th>Mail</th><th>Report</th></tr>";

                    while($row = mysqli_fetch_array($result)) {
                        $id = $row["id"];
                        $reprt = $row["reprt"];
                        $plateID = $row["plateID"];
                        $plateState = $row["plateState"];
                        $incDate = $row["incDate"];             
                        $usrName = $row["usrName"];
                        $usrMail = $row["usrMail"];
                        $incLat = $row["incLat"];
                        $incLon = $row["incLon"];

                        echo "<tr><td><a href=indiv.php?id=".$id.">".$id."</a></td><td>".$plateID."</td><td>".$plateState."</td><td>".$incDate."</td><td>".$usrName."</td><td>".$usrMail."</td><td>".$reprt."</td></tr>";
                    } 

                    echo "</table>";
                    mysqli_close($con);
                ?>
            </div>
        </p>

		<footer class="footer">
			<center>
				<p>
					<small>&#9400; Carter Bailey 2017</small>
				</p>
				<p>					
					<!--<script type='text/javascript' style="max-height: 69px;" id='clustrmaps' src='//cdn.clustrmaps.com/map_v2.js?cl=0e1633&w=100&t=tt&d=Bm9rtsuwwVA4KLUkpBLYAkix6kSG5HmrEv_t_SogiZc&co=0b4975&cmo=3acc3a&cmn=ff5353&ct=cdd4d9'></script>
					-->
				</p>
			</center>
		</footer>
    </body>
</html>