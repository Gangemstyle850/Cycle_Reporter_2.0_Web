<?php
    $debug = false;

    if(array_key_exists('id', $_GET)){
        $id = $_GET['id'];

        if($id < 1){
            echo "<script>window.location.replace('view.php');</script>";
        }
        if($id == ''){
            echo "<script>window.location.replace('view.php');</script>";
        }
        if($id == ' '){
            echo "<script>window.location.replace('view.php');</script>";
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <!--Global Style Sheet Imports-->
        <link rel="stylesheet" type="text/css" href="/resources/style/global.css"/>
        
        <title>Report# <?php echo $id; ?> - Cycle Reporter</title>

        <!--GMaps Lat-Lon Picker Imports-->
        <script src="/resources/lat-long-picker/js/jquery-2.1.1.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <link rel="stylesheet" type="text/css" href="/resources/lat-long-picker/css/jquery-gmaps-latlon-picker.css"/>
        <script src="/resources/lat-long-picker/js/jquery-gmaps-latlon-picker.js"></script>

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
    <h1>
        <?php echo "ID: ".$id."<br>"; ?>
    </h1>
    <p>
        <?php
            //DB Info
            $dbHost = "127.0.0.1";
            $dbUser = "root";
            $dbPass = "password!";
            $db = "reportdb";
            $table = "reports";

            //SQL Query To Run
            $sql = "SELECT * FROM ".$table." WHERE id LIKE '".$id."';";



            //Connect To Database Server
            $con = mysqli_connect($dbHost, $dbUser, $dbPass)
                or die("Unable To Connect To Database, Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 1<br>");

            //Select Database On Server
            $SelectedDB = mysqli_select_db($con, $db)
                or die("Could Not Find And Select Database On Server :'( Please Wait And Try Again, {Placids, Are Going, There, }Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 2<br>");

            //Pull Data Via SQL Query
            $result = mysqli_query($con,$sql)or die("SQL Error Message: " . mysql_error() . "<br>");

            echo "<table id='viewTBL'>";
            echo "<tr><th>Plate Number</th><th>State</th><th>Date</th><th>Perp</th><th>Perp Mail</th><th>Name</th><th>Mail</th><th>Report</th></tr>";

            while($row = mysqli_fetch_array($result)) {
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

                echo "<tr><td>".$plateID."</td><td>".$plateState."</td><td>".$incDate."</td><td>".$perpName."</td><td>".$perpMail."</td><td>".$usrName."</td><td>".$usrMail."</td><td>".$reprt."</td></tr>";
            } 

            echo "</table>";
            mysqli_close($con);
            
            echo "
                <form action='indivReport.php?id=".$id."' method='POST'>
                <h1>
                Location Of Incident:<br>
                </h1>
                <h2>
                <fieldset class='gllpLatlonPicker'>
	                <div style='color: #029999' class='gllpMap'>Google Maps</div><br>
		                <input type='hidden' class='gllpLatitude'' value='".$incLat."'/>
		                <input type='hidden' class='gllpLongitude' value='".$incLon."'/>
                        <input type='hidden' class='gllpZoom' value='15'/>
                        <input type='hidden' name='locName' class='gllpLocationName' size=42/>
                        <input type='hidden' class='gllpElevation' name='elevation' size='12' type='text'>

                    Actual Location: <br>
                            Lat: ".$incLat."<br>
                            Lon: ".$incLon."<br>

                        <input type='hidden' class='gllpUpdateButton' id='mapUpdateButton'/>
                        <script>
                            $(document).ready(function(){
                                document.getElementById('mapUpdateButton').click();
                            });
                        </script>
                </fieldset>
                </h2bhhb>
                <input type='submit' name='mapSubmit' style='position: absolute; left: -9999px; width: 1px; height: 1px;'tabindex='-1'/>
                <script>
                    $(document).ready(function(){
                        document.getElementById('mapSubmit').click();
                    });?%
                </form>
                ";
        ?>
			<footer class="footer">
				<center>
					<p>
						&#9400; Carter Bailey 2017
					</p>
					<p>					
						<script type='text/javascript' style="max-height: 69px;" id='clustrmaps' src='//cdn.clustrmaps.com/map_v2.js?cl=0e1633&w=100&t=tt&d=Bm9rtsuwwVA4KLUkpBLYAkix6kSG5HmrEv_t_SogiZc&co=0b4975&cmo=3acc3a&cmn=ff5353&ct=cdd4d9'></script>
					</p>
				</center>
			</footer>
		</p>
	</body>
</html>