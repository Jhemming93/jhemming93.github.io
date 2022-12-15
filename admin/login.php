<?php 

include("/home/jhemming1/data/lab8data.php");
   

?>

<?php

$msg = "";
if(isset($_POST['submit'])){

$username = trim($_POST['username']);
$password = trim($_POST['password']);
//echo "$username, $password";

if(($username == $username_good) && (password_verify($password, $pw_enc))){
	// SUCCESS: User has successfully logged in. Redirect them to the secure part of the site, and record a session to be checked there. 

	session_start();
	$_SESSION['your-random-session-bney5ifks'] = session_id();
	// redirect: remember, we must set the action of the form to REQUEST_URI
	if(isset($_GET['refer'])){
		if($_GET['refer'] == "welcome"){
		   // echo "refer is welcome";
			header("Location:../index.php");
		}else{
			//echo "refer is insert";
			header("Location: insert.php");
		}
	}else{
		header("Location: insert.php");
	}

}else{

	if($username != "" && $password != ""){
		$msg =  "Invalid Login";
	}else{
		$msg =  "Please enter a Username/Password";
	}

}



	
}


?>









<?php include('../includes/header.php');  ?>


<h2>Login</h2>
<form id="myform" name="myform" method="post" class="col-3" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
		
        <div class="form-group">
			<label for="username">Username:</label>
			<input type="text" name="username" class="form-control">
		</div>
        <div class="form-group mb-3">
			<label for="password">Password:</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<label for="submit">&nbsp;</label>
			<input type="submit" name="submit" class="btn btn-info" value="Submit">
		</div>



</form>
<?php
if($msg){
   echo "<div class=\"alert alert-info\">$msg</div>"; 
}
?>
<?php include('../includes/footer.php'); ?>