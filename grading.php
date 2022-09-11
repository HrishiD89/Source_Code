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
   $sql = "DELETE FROM `grading1` WHERE `sno` = $sno";
   $result = mysqli_query($conn, $sql);
 }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['snoEdit'])){
    // Update the record
    $name = $_POST['nameEdit'];
    $sno = $_POST['snoEdit'];
    $sub1 = $_POST["sub1Edit"];
    $sub2 = $_POST["sub2Edit"];
    $sub3 = $_POST["sub3Edit"];
    $sub4 = $_POST["sub4Edit"];
    $sub5 = $_POST["sub5Edit"];

    $sum=$sub1+$sub2+$sub3+$sub4+$sub5; //total marks
    $avg=$sum/5;
    if($avg>=0&&$avg<=50)
        $grade="Fail";
     if($avg>50&&$avg<=70)
        $grade="C";
     if($avg>70&&$avg<=80)
        $grade="B"; 
     if($avg>80&&$avg<=90)
        $grade="A";
     if($avg>90)
        $grade="E" ; 
  
   //  $course = $_POST["courseEdit"];
  
    //sql query to be executed
    $sql = "UPDATE `grading1` SET `name` = '$name' , `sub1` = '$sub1' ,`sub2` = '$sub2', `sub3` = '$sub3', `sub4` = '$sub4' ,`sub5` = '$sub5',`average` = '$avg',`total` = '$sum',`grade` = '$grade'  WHERE `grading1`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result) {
     $update = true;
   }
   else{
     echo "we could not update the record succesfully";
   }
 }else{
  $name = $_POST["name"];
  $sub1 = $_POST["sub1"];
  $sub2 = $_POST["sub2"];
  $sub3 = $_POST["sub3"];
  $sub4 = $_POST["sub4"];
  $sub5 = $_POST["sub5"];

  $sum=$sub1+$sub2+$sub3+$sub4+$sub5; //total marks
    $avg=$sum/5;
    if($avg>=0&&$avg<=50)
        $grade="Fail";
     if($avg>50&&$avg<=70)
        $grade="C";
     if($avg>70&&$avg<=80)
        $grade="B"; 
     if($avg>80&&$avg<=90)
        $grade="A";
     if($avg>90)
        $grade="E" ; 

  //sql query to be executed
  $sql = "INSERT INTO `grading1` (name, sub1, sub2, sub3, sub4 , sub5,average,total,grade)
   VALUES ('$name', $sub1, $sub2, $sub3, $sub4,$sub5,$avg,$sum,'$grade')";
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
  <title>grading page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style2.css">

  <!-- <title></title> -->

</head>

<body>

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

        <form class="form_container1" action="/PROJECT/login_system/grading.php " method="POST">
          <div class="modal-body">
            <!-- form for modal body -->
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Subject1</label>
              <input type="text" class="form-control" id="sub1Edit" name="sub1Edit" aria-describedby="emailHelp" placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Subject2</label>
              <input type="text" class="form-control" id="sub2Edit" name="sub2Edit" aria-describedby="emailHelp"placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Subject3</label>
              <input type="text" class="form-control" id="sub3Edit" name="sub3Edit" aria-describedby="emailHelp"placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Subject4</label>
              <input type="text" class="form-control" id="sub4Edit" name="sub4Edit" aria-describedby="emailHelp"placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Subject5</label>
              <input type="text" class="form-control" id="sub5Edit" name="sub5Edit" aria-describedby="emailHelp"placeholder="Out of 100">
            </div>
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
    <h3><span>admin</span>page</h3>
    <div class="admin_nav_bar">
      <ul>
        <li><a href="admin_page.php">Home</a></li>
        <li ><a href="student.php">Student List</a></li>
        <li><a href="attendence.php">Attendence</a></li>
        <li class="active"><a href="grading.php">Grading</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
  <!-- </div class="admin_navbar_mssg">
  <br>
  <h2>Welcome <span style="background: blue;color:#fff;border-radius: 5px;padding:0 15px;">
      <?php echo $_SESSION['admin_name'] ?>
    </span></h2>
  <div> -->
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
    
  <!--Add Student Modal -->
  <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertModalLabel">Enter Marks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form class="form_container1" action="/PROJECT/login_system/grading.php " method="POST">
          <div class="modal-body">  
            <!-- form for modal body -->
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"placeholder="Enter your name">
            </div>
            <div class="form-group">
              <label>Subject1</label>
              <input type="text" class="form-control" name="sub1" id="sub1"placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label>Subject2</label>
              <input type="text" class="form-control" name="sub2" id="sub2"placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label>Subject3</label>
              <input type="text" class="form-control" name="sub3" id="sub3"placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label>Subject4</label>
              <input type="text" class="form-control" name="sub4" id="sub4"placeholder="Out of 100">
            </div>
            <div class="form-group">
              <label>Subject5</label>
              <input type="text" class="form-control" name="sub5" id="sub5"placeholder="Out of 100">
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
          <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container my-4">
  <button type="button" class="btn btn-primary my-4" data-toggle="modal" data-target="#insertModal">
       Add  Student Marks
   </button>



    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">sno</th>
          <th scope="col">Name</th>
          <th scope="col">Subject1</th>
          <th scope="col">Subject2</th>
          <th scope="col">Subject3</th>
          <th scope="col">Subject4</th>
          <th scope="col">Subject5</th>
          <th scope="col">Average</th>
          <th scope="col">Total</th>
          <th scope="col">Grade</th>
          <!-- <th scope="col">Course</th> -->
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql  = "SELECT * FROM `grading1`";
        $result = mysqli_query($conn, $sql);
        $sno = 0; //$sno is inititalised so that we can see serail no. in the table
        while ($row = mysqli_fetch_assoc($result)) {

          $sno = $sno +1;
          echo " <tr>
          <th scope='row'>" . $sno . "</th>
          <td>" . $row['name'] . "</td>
          <td>" . $row['sub1'] . "</td>
          <td>" . $row['sub2'] . "</td>
          <td>" . $row['sub3'] . "</td>
          <td>" . $row['sub4'] . "</td>
          <td>" . $row['sub5'] . "</td>
          <td>" . $row['average'] . "</td>
          <td>" . $row['total'] . "</td>
          <td>" . $row['grade'] . "</td>
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
    edits = document.getElementsByClassName('insert');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("insert ",);
        $('#insertModal').modal('toggle')
      })
    })
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",);
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        sub1 = tr.getElementsByTagName("td")[1].innerText;
        sub2 = tr.getElementsByTagName("td")[2].innerText;
        sub3 = tr.getElementsByTagName("td")[3].innerText;
        sub4 = tr.getElementsByTagName("td")[4].innerText;
        sub5 = tr.getElementsByTagName("td")[5].innerText;
        // student_id = tr.getElementsByTagName("td")[2].innerText;
        // phone = tr.getElementsByTagName("td")[3].innerText;
        // course = tr.getElementsByTagName("td")[4].innerText;
        console.log(name,sub1,sub2,sub3,sub4,sub5);

        nameEdit.value = name;
        sub1Edit.value = sub1;
        sub2Edit.value = sub2;
        sub3Edit.value = sub3;
        sub4Edit.value = sub4;
        sub5Edit.value = sub5;
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
          window.location = `/PROJECT/login_system/grading.php?delete=${sno}`;
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