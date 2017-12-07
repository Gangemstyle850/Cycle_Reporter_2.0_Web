<!DOCTYPE HTML>
<html>
    <head>        
        <title>Mobile API - Cycle Reporter</title>
*
        <!--Some Little Added Touches For Mobile, And Those Who Care-->
        <link rel="shortcut icon" href="/favicon.ico">
        <meta name="theme-color" content="#191919" />
    </head>

<body>
    <p>
        <?php
            //Debug Options
                $debug = "true";
                $dbSend = "true";
				
			//Debug Log Output Function
				function consoleWrite( $data ) {
					$output = $data;
					if ( is_array( $output ) )
						$output = implode( ',', $output);
						echo "<script>console.log( 'Debug: " . $output . "' );</script>";
				}

            //Debug Error Codes: 
                //1 - Uploaded File Is Not A Video
            //Display Test Message
                consoleWrite("Yes, I Do Work!!!");

            //Form Imports
                $reprt = $_GET["Reprt"];
                $plateID = $_GET["plateID"];
                $plateState = $_GET["plateState"];
                $incDay = $_GET["incDay"];
                $incMonth = $_GET["incMonth"];
                $incYear = $_GET["incYear"];
                $perpName = $_GET["perpName"];
                $perpMail = $_GET["perpMail"];
                $usrName = $_GET["usrName"];
                $usrMail = $_GET["usrMail"];
                $incLat = $_GET["incLat"];
                $incLon = $_GET["incLon"];
				$acc = $_GET["acc"];
				$fault = $_GET["fault"];

            //Generate Unique 7 Digit Id
                $id = rand(1111111, 9999999);
            //Combine Input Into Useable Date
                $incDate = $incYear . '/' . $incMonth . '/' . $incDay;

            //Log Debug Info
                if($debug == true){
					consoleWrite("incDate: $incDate");
                    consoleWrite("plateID: $plateID");
                    consoleWrite("plateState: $plateState");
                    consoleWrite("reprt: $reprt");
                }



            //DB Vars
                $dbHost = "127.0.0.1";
                $dbUser = "root";
                $dbPass = "password!";
                $db = "reportdb";
                $table = "reports";
                $sql = "INSERT INTO $table (id, reprt, plateID, plateState, incDate, usrName, perpName, usrMail, perpMail, incLat, incLon, accidental, fault) VALUES ('$id', '$reprt', '$plateID', '$plateState', '$incDate', '$usrName', '$perpName', '$usrMail', '$perpMail', '$incLat', '$incLon', '$acc', '$fault');";

            //Send To DB (If Aplicable)
                if($dbSend == true){
                //Database Mumbo-Jumbo (The Important Stuffs)
                    //Connect To Database Server
                        $dbc = mysqli_connect($dbHost, $dbUser, $dbPass)
                            or die("Unable To Connect To Database, Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 1");
                            if ($debug == true){consoleWrite ("Connected To Database Server!!!");}

                    //Select Database On Server
                        $SelectedDB = mysqli_select_db($dbc, $db)
                            or die("Could Not Find And Select Database On Server :'( Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 2");
                            if ($debug == true){consoleWrite ("Found And Selected Database On Server!!!");}

                    //Run Insert Query On Selected Database And Table
                        if (mysqli_query($dbc, $sql) == true){
                            consoleWrite ("Submition Was Successful!!!Your Report ID Is: "); consoleWrite('"'); consoleWrite("<a href='../../view/indivReport.php?".$id."'>".$id."</a>"); consoleWrite('"'); consoleWrite("!");
							$json_status = "false";
							$json_result = $id;
						}
                        else{
                            consoleWrite ("Failed To Submit!!! Please Wait And Try Again, Or Contact The Site Administrator (Info On <a href='../../../pages/contact/index.html' target='_blank'>Contact Page</a>) If The Problem Persists, And Please Include, ERROR CODE: 3");
        
                            if ($debug == true){consoleWrite ("SQL Error Message: " . mysqli_error ( mysqli $link ) . "");}
                            }
                        }
                    //Close Connection
                        mysqli_close($dbc);
						
					//Write Out Result As JSON
					print(json_encode ($json_status));
					print(json_encode ($json_result));
        ?>
    </p>
</body>
</html>