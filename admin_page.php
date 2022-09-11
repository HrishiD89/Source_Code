<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>student page</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style2.css"> 
  
  <!-- <title></title> -->
  <style>


  li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  
  li a:hover, .dropdown:hover .dropbtn {
    background-color: #04AA6D;
  }
  
  li.dropdown {
    display: inline-block;
  }
  
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }
  
  .dropdown-content a:hover {background-color: #f1f1f1;}
  
  .dropdown:hover .dropdown-content {
    display: block;
  }
  </style>
</head>

<body>

  <div class="_header ">
    <h3><span>admin</span>page<span style="float:right;background: blue;color:#fff;border-radius: 5px;padding:0 15px;">
      <?php echo $_SESSION['admin_name'] ?>
    </span></h3>
    <div class="admin_nav_bar">
      <ul>
        <li class="active" ><a href="admin_page.php">Home</a></li>
        <li ><a href="student.php">Student List</a></li>
        <!-- <li><a href="attendence.php">Attendence</a></li> -->
        <li class="dropdown"> <a href="javascript:void(0)" class="dropbtn">Attendance</a>
            <div class="dropdown-content">
              <a href="attendence.php">Get Attendance</a>
              <a href="viewattendence.php">View Attendance</a>
           </div></li>
        <li><a href="grading.php">Grading</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
     

  </div>
  </div class="admin_navbar_mssg">
  <!-- <h2>Welcome <span style="background: blue;color:#fff;border-radius: 5px;padding:0 15px;">
      <?php echo $_SESSION['admin_name'] ?>
    </span></h2> -->
  <div>
  </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  </div>

  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

  

</body>

</html>