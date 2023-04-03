<?php
include "config.php";
session_start();


if(isset($_POST["submit"])){
    $email=mysqli_real_escape_string($conn, $_POST["email"]);
    $pass=mysqli_real_escape_string($conn, md5($_POST["password"]));
	$select=mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

if(mysqli_num_rows($select)>0){
    $row = mysqli_fetch_assoc($select); // modificare aici
	$_SESSION["id_user"]=$row['id_user'];
	header("location:home.php");

} else {
	$message[]='mail or password incorecte!';
}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<div class="form-container">
		   <form action="" method="post" enctype="multipart/form-data">
           <h1>Login</h1>
	<?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">

      <p>don't have an account? <a href="register.php">regiser now</a></p>
	</form>
    </div>
</body>
</html>
