<?php
			$con=mysqli_connect("localhost","root","","student_detail");			
	
?>

<?php
	if(isset($_POST["btnsubmit"]))
	{
		
		$date = $_POST["cyear"]."-".$_POST["cmonth"]."-".$_POST["cdate"];
               		
		$query = "select *from `students` ";
		$result = mysqli_query($con,$query)or die("select error");
        $sno = 0; //$sno is inititalised so that we can see serail no. in the table
       

        //   $sno = $sno +1;
		while($row = mysqli_fetch_array($result))
		{
            // $sno = $sno +1;
			$mno = $row["sno"];
			if(isset($_POST[$mno]))
			{
				$query1 = "INSERT INTO  `attendence`(`sno` ,  `date` ,  `value`) VALUES('$mno','$date','1')";
			}
			else
			{
				$query1 = "INSERT INTO  `attendence`(`sno` ,  `date` ,  `value`) VALUES('$mno','$date','0')";
			}
			mysqli_query($con,$query1)or die("insert error".$mno);
			print "<script>";
			print "alert('Attendance get successfully....');";
			print "self.location='getattendance1.php';";
			print "</script>";
		}
		
		
			
		
	}
	else
	{
		header("Location:attendence.php");
	}
?>


