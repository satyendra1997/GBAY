<?php
session_start();
include('config.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
}

$sql="SELECT * from due_payment"; 
$result=mysqli_query($conn,$sql);
$d=date('Y-m-d');
while($row=mysqli_fetch_assoc($result)){
	for($i=1;$i<=14;$i++){
		if($row['date'.$i]==$d && $row['dueamount'.$i]!=0){
			$pid=$row['pid'];
		    $sql="SELECT email1,mobileno1 FROM `owners` WHERE `plotid`='$pid'";
            $result2=mysqli_query($conn,$sql);
			$row2=mysqli_fetch_assoc($result2);
			echo $row2['email1'];
			echo "<br>";
			echo $row2['mobileno1'];
			echo "<br>";
			echo $row['dueamount'.$i];
			echo "<br>";
			echo $row['date'.$i];
			//code of due payment email on $row2['email1'];
			//code of due payment  msg on $row2['mobileno1'];
			
		}
		
	}
	
}
?>