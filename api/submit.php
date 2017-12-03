<!DOCTYPE HTML>
<html>
    <head>
        <!--Global Style Sheet Imports-->
        <link rel="stylesheet" type="text/css" href="/resources/style/global.css"/>
        
        <title>Submiting... - Cycle Reporter</title>

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
		
    <p>
        <?php
		
            //Debug Options
                $debug = "true";
                $dbSend = "true";				
				
            //Form Imports
                $reprt = $_POST["Reprt"];
                $plateID = $_POST["plateID"];
                $plateState = $_POST["plateState"];
                $incDay = $_POST["incDay"];
                $incMonth = $_POST["incMonth"];
                $incYear = $_POST["incYear"];
                $perpName = $_POST["perpName"];
                $perpMail = $_POST["perpMail"];
                $usrName = $_POST["usrName"];
                $usrMail = $_POST["usrMail"];
                $incLat = $_POST["incLat"];
                $incLon = $_POST["incLon"];

            //Combine Input Into Useable Date
                $incDate = $incYear . '/' . $incMonth . '/' . $incDay;
		
		
		
			//DB Vars
                $dbHost = "127.0.0.1";
                $dbUser = "root";
                $dbPass = "password!";
                $db = "reportdb";
                $table = "reports";
                $sql = "INSERT INTO $table (id, reprt, plateID, plateState, incDate, usrName, perpName, usrMail, perpMail, incLat, incLon, uploadPath) VALUES ('$id', '$reprt', '$plateID', '$plateState', '$incDate', '$usrName', '$perpName', '$usrMail', '$perpMail', '$incLat', '$incLon', '$uploadPath');";
			
			//Connect To Database Server
                        $dbc = mysqli_connect($dbHost, $dbUser, $dbPass)
                            or die("Unable To Connect To Database, Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 1<br>");
                            if ($debug == true){print ("Connected To Database Server!!!<br>");}
		
			
			//Generate 7 Digit Id, And Make Shure It Is Unique	
			while($valid == 0){
				$id = rand(1111111, 9999999);
					if($debug){echo("Generated ID");}
				
				$sqlIdCheck = "SELECT * FROM  {$table} WHERE id={$id}";
				
				$idCheckResult = mysqli_query($sqlIdCheck);
					if($debug){echo("Sent Query");}
				
				while($idRow=mysql_fetch_array($idCheckResult)){
					$existId = $idRow['id'];
					if($existId == $id){
						$valid = 0;
						break;
					}else if($existId !== $id){
						$valid = 1;
						break(2);
					}
				}
			}
			echo("Moving On");
			
			
            
            //UPLOAD THE FILEZ!!!
				$target_dir = "/reports/{$id}/files/";
				
				echo("Target Dir: {$target_dir}");
				
				if(!mkdir($target_dir, 0777, true)){
					die('Sorry, We Couldent Create A Folder For Your Files.');
				}
			
				$target_file = $target_dir . basename($_FILES["vidUp"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])){
                    $check=getimagesize($_FILES["vidUp"]["tmp_name"]);
                    if($check !== false){
						echo "File Is Of Valid Type - " . $check["mime"] . ".";
						$uploadOk = 1;
					}else{
						echo "Sorry, Only MP4, MOV, WMV, FLV & AVI Files Are Allowed.";
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "Sorry, Your File Already Exists On Our Server.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["vidUp"]["size"] > 1000000) {
					echo "Sorry, Your File Exceeds The 1GB Size Limit.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "avi" && $imageFileType != "mp4" && $imageFileType != "mov"
				&& $imageFileType != "flv" && $imageFileType != "wmv" ) {
					echo "Sorry, Only MP4, MOV, WMV, FLV & AVI Files Are Allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, We Encountered An Unknown Error. Your File Was Not Uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["vidUp"]["tmp_name"], $target_file)) {
						echo "Your File ". basename( $_FILES["vidUp"]["name"]). " Has Been Uploaded.";
					} else {
						echo "Sorry, We Encountered An Unknown Error. Your File Was Not Uploaded.";
					}
				}
				
				$uploadPath = $target_file;
			
			

            //Print Debug Info
                if($debug == true){
					print("incDate: $incDate<br>");
                    print("plateID: $plateID<br>");
                    print("plateState: $plateState<br>");
                    print("reprt: $reprt<br>");
                }



            //DB Vars
                $dbHost = "127.0.0.1";
                $dbUser = "root";
                $dbPass = "password!";
                $db = "reportdb";
                $table = "reports";
                $sql = "INSERT INTO $table (id, reprt, plateID, plateState, incDate, usrName, perpName, usrMail, perpMail, incLat, incLon, uploadPath) VALUES ('$id', '$reprt', '$plateID', '$plateState', '$incDate', '$usrName', '$perpName', '$usrMail', '$perpMail', '$incLat', '$incLon', '$uploadPath');";

            //Send To DB (If Aplicable)
                if($dbSend == true){
                //Database Mumbo-Jumbo (The Important Stuffs)
                    //Select Database On Server
                        $SelectedDB = mysqli_select_db($dbc, $db)
                            or die("Could Not Find And Select Database On Server :'( Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 2<br>");
                            if ($debug == true){print ("Found And Selected Database On Server!!!<br>");}

                    //Run Insert Query On Selected Database And Table
                        if (mysqli_query($dbc, $sql) == true){
                            print ("Submition Was Successful!!!<br>Your Report ID Is: "); print('"'); print("<a href='../../view/indivReport.php?".$id."'>".$id."</a>"); print('"'); print("!<br>");
                        }
                        else{
                            print ("Failed To Submit!!! Please Wait And Try Again, Or Contact The Site Administrator (Info On <a href='../../../pages/contact/index.html' target='_blank'>Contact Page</a>) If The Problem Persists, And Please Include, ERROR CODE: 3<br>");
        
                            if ($debug == true){print ("SQL Error Message: " . mysql_error() . "<br>");}
                            }
                        }
                    //Close Connection
                        if ($debug == true){print ("Closing Database Connection!!!<br>");}
                        mysqli_close($dbc);
                        if ($debug == true){print ("Connection Closed!!!<br>");}
            ?>
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