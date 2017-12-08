<!DOCTYPE> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 
<title>Sign Up - Cycle Reporter</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>  
<body>  
<div id="main">     
   <h1>Register</h1>
     
   <p>Please enter your details below to register.</p>
     
    <form method="post" action="register.php" name="registerform" id="registerform">
    <fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
        <label for="email">Email Address:</label><input type="text" name="email" id="email" /><br />
        <input type="submit" name="register" id="register" value="Register" />
    </fieldset>
    </form>
</div>
</body>
</html>