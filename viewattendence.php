<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
  header('location:login_form.php');
}
?>
<?php
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>attendance page</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style2.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#example').DataTable({
				scrollX: true,
			});
		});
	</script>

</head>

<body>
	<div class="_header ">
		<h3><span>admin</span>page<span
				style="float:right;background: blue;color:#fff;border-radius: 5px;padding:0 15px;">
				<?php echo $_SESSION['admin_name'] ?>
			</span></h3>
		<div class="admin_nav_bar">
			<ul>
				<li><a href="admin_page.php">Home</a></li>
				<li ><a href="student.php">Student List</a></li>
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
	<br>
	<div style=" overflow-x: auto;">
		<table class="table table-responsive" style="width: 100%;">
			<?php
		if(isset($_POST["btnsubmit"]))
		{
			include "config.php";
			extract($_POST);
			$query = "select * from `attendence` where `student_id` = ".$student_id."";

			$result = mysqli_query($conn,$query)or die("select error error");
			while($row = mysqli_fetch_array($result))
			{	
				echo'<tr >
						<td style="padding-left: 0px;" >
						
							<table  style=" width:100% ;" align="center" bordercolor="#9966FF" bgcolor="#B8FFF9"> 
				  				<td width="100" bgcolor="#B8FFF9"><span class="style2">student_id</span></td>
				  				<td width="100" bgcolor="#B8FFF9"><span class="style2">Name</span></td>';
				  								$query1 = "select * from `attendence` where `sno` = ".$row["sno"]." order by date";
												$result1 = mysqli_query($con,$query1)or die("select error error");
												while($row1 = mysqli_fetch_array($result1))
												{
				  									echo '<td bgcolor="#B8FFF9" class=style2>'.$row1["date"].'</td>';
												}
				echo '</tr>
				<tr>
				  <td width="200"><span class="style6">'.$row["student_id"].'</span></td>
				  <td width="200"><span class="style6">'.$row["name"].'</span></td>';
				  $query1 = "select *from `attendence` where `sno` = ".$row["sno"]." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($row1 = mysqli_fetch_array($result1))
					{
						echo '<td>';
						if($row1["value"]==0)
							echo ' <ul style="background-color:red">Absent</ul>';
							
						else
							echo ' <ul style="background-color:green">Present</ul>';
						echo '</td>';
					}
				
				echo '
				</tr>				
			  </table></td></tr>';
			}
		}
		else
		{
			include "config.php";
			extract($_POST);
			$query = "select * from `students` ";
			$sno = 0;
			$result = mysqli_query($conn,$query)or die("select error error");
			while($row = mysqli_fetch_array($result))
			{
				$sno = $sno +1;
				echo '<tr style="padding: 0px;"><td style="padding: 0px;"><table  width="100%"style="padding: 0px;"bordercolor="#9966FF" bgcolor="#EFFFFD">
				<tr>
				  <td  bgcolor="#B8FFF9"><span class="style2">sno</span></td>
				  <td  bgcolor="#B8FFF9"><span class="style2">Name</span></td>
                  <td  bgcolor="#B8FFF9"><span class="style2">student_id</span></td>';
                  
				  $query1 = "select * from `attendence` where `sno` = ".$row["sno"]." order by date";
					$result1 = mysqli_query($conn,$query1)or die("select error error");
					while($row1 = mysqli_fetch_array($result1))
					{
				  		echo '<td bgcolor="#B8FFF9" class=style2>'.$row1["date"].'</td>';
					}
				echo '</tr>
				<tr>
				  <td ><span class="style6">'. $sno .'</span></td>
				  <td ><span class="style6">'.$row["name"].'</span></td>
                  <td ><span class="style6">'.$row["student_id"].'</span></td>';
				  $query1 = "select *from `attendence` where `sno` = ".$row["sno"]." order by date";
					$result1 = mysqli_query($conn,$query1)or die("select error error");
					while($row1 = mysqli_fetch_array($result1))
					{
				  		echo '<td>';
						if($row1["value"]==0)
							echo '<li class="edit btn btn-sm btn-danger">Absent</ul>';
							
						else
							echo '<ul class="edit btn btn-sm btn-success">Present</ul>';
							
						echo '</td>';
					}
				
				echo '
				</tr>
								
			  </table></td></tr>';
			}
		}
		?>
		</table>
	</div>

	</div>



</body>

</html>