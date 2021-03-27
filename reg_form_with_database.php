<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>
        <?php

            $uname = $pass = "";
            $unameerr = $passerr = $emptyerr = $failerr = $notavailable = "";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Submit") {

                $uname = $_POST['u_name'];
                $pass = $_POST['pass'];


                if(empty($_POST['u_name']) || empty($_POST['pass'])) {
                    $emptyerr = "Please Fill up the form properly!";
                }

                else if(strlen($_POST['pass']) > 8) {
                    $passerr="Password can not be excceded 8 character!";
                }

                else {

                    $hostname = "localhost";
	                $username = "customer";
                	$password = "customer";
                	$dbname = "soumik";
                    $conn = mysqli_connect($hostname, $username, $password, $dbname);

	                if(mysqli_connect_error()) {
		                
		                $notavailable = "Database Error!!! <br> ".mysqli_connect_error();
	                }
	                else {

		                $sql = "insert into login (username, password) values ('".$uname."',".$pass.")";
		                if(mysqli_query($conn, $sql)) {
                            $notavailable = "Data Insert Successful!!!";
		                }
		                else {
                            $notavailable = "Failed to Insert Data!!! <br> ".mysqli_error($conn);
		                }
	                }

	            mysqli_close($conn);
                }
            }

        ?>

        <h1>Registration Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">            

            <fieldset>
                <legend><b>Account Information:</b></legend>

                <label for="username">Username:</label>
                <input type="text" name="u_name" id="username">

                <br>

                <label for="password">Password:</label>
                <input type="password" name="pass" id="password">
                <?php echo $passerr; ?>
                <?php echo $emptyerr; ?>

                <br>

                <input type="submit" value="Submit" name="button"> 

                </fieldset>
                
                <?php echo $notavailable; ?>
        </form>                
        
    </body>
</html>
