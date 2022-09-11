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
            <li class="active"><a href="attendence.php">Attendence</a></li>
            <li><a href="grading.php">Grading</a></li>
            <!-- <li><a href="grading3.php">Grading</a></li> -->
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
<style type="text/css">
<!--
.style1 {
	font-family: "Courier New", Courier, monospace;
	font-size: 60px;
	color: #FFFFFF;
	font-style: italic;
}
.style2 {
	font-size: 24px;
	color: #0000FF;
}
.style7 {color: #FFCCFF}
-->
</style>
<style type="text/css">
	.menu{
		color: white;
		background-color: black;
      /* position: relative; */
      margin-left: 10px;
      border-radius: 5px;
		padding: 10px;
		font-size: 1.3em;
		text-decoration: none;
      text-align: center;
	}
	.menu:hover{
		color: tomato;
		background-color: yellow;
      border-radius: 5px;

		padding: 10px;
		box-shadow: 5px 4px 5px 1px;
	}
   
</style>
<br>
<!-- <ul style="list-style:none;display:inline-block"> -->
   <a href="/PROJECT/login_system/viewattendence.php" class="menu">View Attendence</a>
<!-- </ul> -->
<br>

<style type="text/css">
<!--
.style1 {
	font-family: "Courier New", Courier, monospace;
	font-size: 60px;
	color: #FFFFFF;
	font-style: italic;
}
.style2 {
	font-size: 24px;
	color: #0000FF;
}
.style7 {color: #FFCCFF}
-->
</style>
   <!-- <title></title> -->
   <script type="text/javascript">
	function getatt(value)
	{
		if(value == true)
		{
			document.getElementById("txtAbsent").value = "1";

			document.getElementById("txtAbsent").value = parseInt(document.getElementById("txtAbsent").value) -1;
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) + 1;
		}
		else 
		{
			document.getElementById("txtAbsent").value = parseInt(document.getElementById("txtAbsent").value) + 1;
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) - 1;

		}
	}
</script>
<script type="text/javascript">
	function getatt1(value)
	{
		if(value == true)
		{
   		document.getElementById("txtAbsent").value = parseInt(document.getElementById("txtAbsent").value) - 1;
         document.getElementById("txtAbsent").value = "0";
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) + 1;
		}
		else
		{
         window.location.href="attendence.php";
		}
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) -2;

	}
</script>



<table width="800" border="1" align="center">
      <!-- <tr>
        <td bordercolor="#330033" bgcolor="#CCCCFF"><h1 align="center"><strong><span class="style1">Attendance System</span></strong></h1></td>
      </tr> -->
      <tr>
        <td bgcolor="#999966"><div align="center">
       					
        				</div>       </td>
      </tr>
      <tr>
        <td>
        <form action="getattendance1.php" method="post">
        <table width="180px" align="left" style="margin: 10px;">
            	<tr>
                	<td> Select date : <br />
                   <?php 
				 		    $dt = getdate();
							$day = $dt["mday"];
							$month = date("m");
							$year = $dt["year"];
							
							echo "<select name='cdate'>";
							for($a=1;$a<=31;$a++)
							{
								if($day == $a)
									echo "<option value='$a' selected='selected'>$a</option>";
								else
									echo "<option value='$a' >$a</option>";
							}
							echo "</select><select name='cmonth'>";
							for($a=1;$a<=12;$a++)
							{
								if($month == $a)
									echo "<option value='$a' selected='selected'>$a</option>";
								else
									echo "<option value='$a' >$a</option>";
							}
							echo "</select><select name='cyear'>";
							for($a=2010;$a<=$year;$a++)
							{
								if($year == $a)
									echo "<option value='$a' selected='selected'>$a</option>";
								else
									echo "<option value='$a' >$a</option>";
							}
							echo "</select>";
						?>                    
                    </td>
                </tr>
             </table>	
            
        <div class="container my-4">
          <table style="  margin-left: auto;
  margin-right: auto;"; "width="800px" height="400px" border="0"2"   >
            <tr>
              <td colspan="3"width="800px style="text-align: center;"><div align="center"><strong><span class="style2">Get Attendance</span></strong></div></td>
            </tr>
            <tr>
               <th style ="text-align: center;"width="152"><span >S.no</span></th>
              <th  width="152" ><span >Name</span></th>
              <th  width="152"><span >Student_id</span></th>
              <th  width="110"><input type="checkbox" name="select-all" id="select-all" . onclick="getatt1(this.checked);"/><span >Attend</span></th>
            </tr>
            <?php
			$con=mysqli_connect("localhost","root","","student_detail");			
	
?>

            <?php
			
				extract($_POST);
				$query =  "SELECT * FROM `students`";
				$s = 0;
				$result = mysqli_query($con,$query)or die("select error");
            $sno = 0;
				while($row = mysqli_fetch_array($result))
				{
               $sno = $sno +1;
					$s = $s + 1;
					echo ' <tr>
                        <td  style ="text-align: center;" width="152">'. $sno . '</td>
							  <td width="152">'.$row["name"].'</td>
							  <td width="152">'.$row["student_id"].'</td>
							  <td style ="text-align: center;"width="110"><input type="checkbox" id="checkbox"name='.$row["sno"].' onclick="getatt(this.checked);"/></td>
							</tr>';
				}
			?>			
            <tr>
              <td colspan="3"><div align="center">
                <input type="submit"  style="background-color: #6beb34; border: 5px solid #6beb34;border-radius: 4px;"value="Get Attendance" name="btnsubmit"/>
               </div></td>
            </tr>
          </table>
          </form>
          </div>
         
         	<table style="position:absolute;position: absolute;
  top: 240px;
  left: 850px;

 "width="100px" align="right" style="margin-left:35px">
            	<tr>
                	<td> Total Absent : <input type="text" id="txtAbsent" value="<?php print $sno; ?>" size="10" disabled="disabled"/></td>
                </tr>
                <tr>
                	<td> Total Present : <input type="text" id="txtPresent" value="0" size="10"  disabled="disabled"/></td>
                </tr>
                <tr>
                	<td> Total Strength : <input type="text" id="txtStrength" value="<?php print $sno; ?>" size="10" disabled="disabled"/></td>
                </tr>
             </table>
         
         </td>
      </tr>
    </table>
    


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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script>
   $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
            getatt(this.checked);                   
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
            getatt(this.checked);
                                
        });
    }
}); </script>

</body>

</html>