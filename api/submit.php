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
        <header><a href="/index.html" class="button">Home</a><a href="/view/view.php" class="button">View All Reports</a><a href="/contact/index.html" class="button">Contact Us</a></header>

    <p>
        <?php
            //Debug Options
                $debug = "true";
                $dbSend = "true";

            //Debug Error Codes: 
                //1 - Uploaded File Is Not A Video
            //Display Test Message
                print("Yes, I Do Work!!!<br>");

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

            //Generate Unique 7 Digit Id
                $id = rand(1111111, 9999999);
            //Combine Input Into Useable Date
                $incDate = $incYear . '/' . $incMonth . '/' . $incDay;



            /*
            //UPLOAD THE FILEZ!!!
                $target_dir = "/reports/$id/uploads/";
                $target_file = $target_dir . basename($_FILES["vidUp"]["$id"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check If Video File Is An Actual Image Or A Fake
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["vidUp"]["$id.upTemp"]);
                    if($check !== false) {
                        if($debug == true){
                            echo "File Is Video - " . $check["mime"] . ".";
                        }
                        $uploadOk = 1;
                    } else {
                        echo "!!!ERROR 1!!! - File Is Not A Video!!!";
                        $uploadOk = 0;
                    }
                }
            */


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
                $db = "ReportDB";
                $table = "reports";
                $sql = "INSERT INTO $table (id, reprt, plateID, plateState, incDate, usrName, perpName, usrMail, perpMail, incLat, incLon) VALUES ('$id', '$reprt', '$plateID', '$plateState', '$incDate', '$usrName', '$perpName', '$usrMail', '$perpMail', '$incLat', '$incLon');";

            //Send To DB (If Aplicable)
                if($dbSend == true){
                //Database Mumbo-Jumbo (The Important Stuffs)
                    //Connect To Database Server
                        $dbc = mysqli_connect($dbHost, $dbUser, $dbPass)
                            or die("Unable To Connect To Database, Please Wait And Try Again, Or Contact The Site Administrator (Info On Contact Page) If The Problem Persists, And Please Include, ERROR CODE: 1<br>");
                            if ($debug == true){print ("Connected To Database Server!!!<br>");}

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
    </body>
</html>