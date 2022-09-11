<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<body>
   <div class="_header">
<h3><span>user</span>page 
   <a href="register_form.php" class="btn">Register</a>
   <a href="login_form.php" class="btn">Login</a>
   <a href="logout.php" class="btn">Logout</a>
   
</h3>
</div>

<div class="admin_navbar">
   <h1 id="welcome_mssg">welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
</div>

</body>
</html>