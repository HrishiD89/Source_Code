<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
  header('location:login_form.php');
}

?>
<?php
// INSERT INTO `students` (`s.no`, `name`, `email`, `student_id`, `phone`, `course`, `created_at`) VALUES (NULL, 'harry', 'hary@harilal', 'dadad67', '+91 8937266224', 'BA', current_timestamp());

$insert = false;
$update = false;
$delete = false;
//connect to the database  
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_detail";

//create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
//die if connection was not succesful
if (!$conn) {
  die("Sorry we failed to connect :" . mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `students` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['snoEdit'])){
   // Update the record
   $sno = $_POST['snoEdit'];
   $name = $_POST["nameEdit"];
   $email = $_POST["emailEdit"];
   $student_id = $_POST["student_idEdit"];
   $phone = $_POST["phoneEdit"];
  //  $course = $_POST["courseEdit"];
 
   //sql query to be executed
   $sql = "UPDATE `students` SET `name` = '$name' , `email` = '$email' ,`student_id` = '$student_id' , `phone` = '$phone'  WHERE `students`.`sno` = $sno";
   $result = mysqli_query($conn, $sql);
   if($result) {
    $update = true;
  }
  else{
    echo "we could not update the record succesfully";
  }
}
  else{
  $name = $_POST["name"];
  $email = $_POST["email"];
  $student_id = $_POST["student_id"];
  $phone = $_POST["phone"];
  // $course = $_POST["course"];

  //sql query to be executed
  $sql = "INSERT INTO students (name, email, student_id, phone) VALUES ('$name', '$email', '$student_id', '$phone')";
  $result = mysqli_query($conn, $sql);

  //add a new trip to the table in the databse
  if ($result) {
    // echo "The record has been inserted succesfully!<br>";
    $insert = true;
  } else {
    echo "The record was not inserted succesfully because of this error -->" .
      mysqli_error($conn);
  }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>student page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style2.css">

  <!-- <title></title> -->

</head>

<body>
<!-- CREATING THE MODAL FOR EDIT -->
  <!--Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form class="form_container1" action="/PROJECT/login_system/student.php " method="POST">
          <div class="modal-body">
            <!-- form for modal body -->
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="emailEdit" id="emailEdit">
            </div>
            <div class="form-group">
              <label for="exampleInputRoll_no">Student_id</label>
              <input type="text" class="form-control" id="student_idEdit" name="student_idEdit"
                aria-describedby="emailHelp">

            </div>
            <div class="form-group">
              <label for="exampleInputRoll_no">Phone</label>
              <input type="text" class="form-control" id="phoneEdit" name="phoneEdit" aria-describedby="emailHelp">

            </div>
            <!-- <div class="form-group">
              <label for="exampleInputCourse1">Course</label>
              <input type="text" class="form-control" id="courseEdit" name="courseEdit">
            </div> -->
            <!-- <button type="submit" class="btn btn-primary">Update</button> -->


          </div>
          <div class="modal-footer d-block mr-auto">
          <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="_header ">
    <h3><span>admin</span>page<span style="float:right;background: blue;color:#fff;border-radius: 5px;padding:0 15px;">
      <?php echo $_SESSION['admin_name'] ?>
    </span></h3>
    <div class="admin_nav_bar">
      <ul>
        <li><a href="admin_page.php">Home</a></li>
        <li class="active"><a href="student.php">Student List</a></li>
        <li><a href="attendence.php">Attendence</a></li>
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

  <?php 
  if($insert)
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your dada has been inserted succesfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>"
  ?>
  <?php 
  if($delete)
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your data has been deleted succesfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>"
  ?>
  <?php 
  if($update)
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your dada has been updated succesfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>"
  ?>

  <div class="container my-4">
    <h2>Add New Student</h2>
    <form class="form_container1" action="/PROJECT/login_system/student.php" method="POST">
      <div class="form-group">
        <label for="exampleInputName1">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email"placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="exampleInputRoll_no">Student_id</label>
        <input type="text" class="form-control" id="student_id" name="student_id" aria-describedby="emailHelp"placeholder="Enter your student_id">

      </div>
      <div class="form-group">
        <label for="exampleInputRoll_no">Phone</label>
        <input type="text" class="form-control" id="Phone" name="phone" aria-describedby="emailHelp"placeholder="Enter your phone number">

      </div>
      <!-- <div class="form-group">
        <label for="exampleInputCourse1">Course</label>
        <input type="text" class="form-control" id="Course" name="course">
      </div> -->
      <button type="submit" class="btn btn-primary">Submit</button> <a class=" d-grid btn btn-outline-primary"
        href="/PROJECT/login_system/student.php" role="button"> Cancel </a>
    </form>

  </div>

  <div class="container my-4">



    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Student_id</th>
          <th scope="col">Phone</th>
          <!-- <th scope="col">Course</th> -->
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql  = "SELECT * FROM `students`";
        $result = mysqli_query($conn, $sql);
        $sno = 0; //$sno is inititalised so that we can see serail no. in the table
        while ($row = mysqli_fetch_assoc($result)) {

          $sno = $sno +1;
          echo " <tr>
          <th scope='row'>" . $sno . "</th>
          <td>" . $row['name'] . "</td>
          <td>" . $row['email'] . "</td>
          <td>" . $row['student_id'] . "</td>
          <td>" . $row['phone'] . "</td>
         
          <td> <button class='edit btn btn-sm btn-primary'id=". $row['sno'] .">Edit</button> <button class='delete btn btn-sm 
          btn-danger'id=d". $row['sno'] .">Delete</button> </td>
        </tr>";
        }
       
         
        
        ?>
      </tbody>
    </table>

  </div>
  <hr>

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

  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });</script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",);
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        email = tr.getElementsByTagName("td")[1].innerText;
        student_id = tr.getElementsByTagName("td")[2].innerText;
        phone = tr.getElementsByTagName("td")[3].innerText;
        course = tr.getElementsByTagName("td")[4].innerText;
        console.log(name, email, student_id, phone);

        nameEdit.value = name;
        emailEdit.value = email;
        student_idEdit.value = student_id;
        phoneEdit.value = phone;
        // courseEdit.value = course;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle')
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",);
        sno = e.target.id.substr(1,)

        if (confirm("Are you sure you want to delete!")) {
          console.log("yes");
          window.location = `/PROJECT/login_system/student.php?delete=${sno}`;
          // TODO : Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }

      })
    })
  </script>


</body>

</html>