<!DOCTYPE HTML>
<html>
    <head>        
        <title>REST BACKEND - Cycle Reporter</title>

        <!--Some Little Added Touches For Mobile, And Those Who Care-->
        <link rel="shortcut icon" href="../../../favicon.ico">
        <meta name="theme-color" content="#191919" />
    </head>

<body>
    <p>
        <?php
            //Debug Options
                $dbSend = "true";

            //Form Imports
			/*
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
			*/
				
            //Generate Unique 7 Digit Id
                $id = rand(1111111, 9999999);
				
            //Combine Date Input Into Useable Format
            //    $incDate = $incYear . '/' . $incMonth . '/' . $incDay;

            //DB Vars
                $dbHost = "127.0.0.1";
                $dbUser = "root";
                $dbPass = "";
                $db = "ReportDB";
                $table = "reports";
                
			// get the HTTP method, path and body of the request
				$method = $_SERVER['REQUEST_METHOD'];
				$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
				$input = json_decode(file_get_contents('php://input'),true);
 
			// connect to the mysql database
				$link = mysqli_connect($dbHost, $dbUser, $dbPass, $db);
				mysqli_set_charset($link,'utf8');
 
			// retrieve the table and key from the path
				//$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
				$key = array_shift($request)+0;
 
			// escape the columns and values from the input object
				$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
				$values = array_map(function ($value) use ($link) {
				if ($value===null) return null;
					return mysqli_real_escape_string($link,(string)$value);
				},array_values($input));
 
			// build the SET part of the SQL command
				for ($i=0;$i<count($columns);$i++) {
					$set.=($i>0?',':'').'`'.$columns[$i].'`=';
					$set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
				}
 
			// create SQL based on HTTP method
				switch ($method) {
					case 'GET':
						$sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
					case 'PUT':
						$sql = "update `$table` set $set where id=$key"; break;
					case 'POST':
						$sql = "insert into $table (id, reprt, plateID, plateState, incDate, usrName, perpName, usrMail, perpMail, incLat, incLon) VALUES ('$id', '$reprt', '$plateID', '$plateState', '$incDate', '$usrName', '$perpName', '$usrMail', '$perpMail', '$incLat', '$incLon');"; break;
					case 'DELETE':
						$sql = "delete `$table` where id=$key"; break;
				}
 
			// excecute SQL statement
				$result = mysqli_query($link,$sql);
 
			// die if SQL statement failed
				if (!$result) {
					http_response_code(404);
					die(mysqli_error());
				}
 
			// print results, insert id or affected row count
				if ($method == 'GET') {
					if (!$key) echo '[';
						for ($i=0;$i<mysqli_num_rows($result);$i++) {
							echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
						}
					if (!$key) echo ']';
					} elseif ($method == 'POST') {
						echo mysqli_insert_id($link);
					} else {
						echo mysqli_affected_rows($link);
					}
 
			// close mysql connection
				mysqli_close($link);
        ?>
    </p>
</body>
</html>