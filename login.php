<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php  

 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = " ";

 include('connectiondb.php')

//server side validation
 if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {
 	 if (empty($_POST["username"])) 
 	 {
        $username = "Name is required";
     }
     else 
     {
       $username = test_input($_POST["username"]);
     }
            
     if (empty($_POST["psword"])) 
     {
       $psword = "Password is required";
            
     }
     else 
     {
       $psword = test_input($_POST["psword"]);

	} 
	

     if(!empty($_POST['username']) && isset($_POST['username']) && !empty($_POST['psword']) && isset($_POST['psword']))
    {
    	
    	//checks if username and password is already been in mysql
 		//$sql = "SELECT username, password FROM user WHERE username = '$username' AND password = '$psword'";
 		$data = $connection->query($sql);
 		 //var_dump($data);

 	   //if matched login	 
 	   if($data->num_rows > 0)
       {
       			session_start();
       		    $row = $data->fetch_assoc();
       		    $_SESSION["username"] = $row['psword'];
    
       		echo '<script type="text/javascript">
				alert("Welcome!");
				window.location.href = "home.php";
				</script>';
       }
       //else not registered
       else
       {
       		echo '<script type="text/javascript">
				alert("Please Register Your Account!");
				window.location.href = "login.php";
				</script>';
       }
	
	}
	else
    {
    	//for debugging purposes
         exit("empty variables");
        
    }   
}

//closing connection
$connection->close();

//eliminating unwanted characters in the input fields
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
} 

?>

	<!-- Login Form -->
	<div class="banner">
		
	<div class="form-container">
	
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">	

			<h3>lOGIN</h3>
			<input type="text" name="username" required placeholder="Enter username" class="box">
			<input type="password" name="psword" required placeholder="Enter password" class="box">
			<input type="submit" name="login" class="btn" value="Login">
			<p><a href=" ">Login</a></p>

		</form>
		</div>

</body>
</body>
</html>