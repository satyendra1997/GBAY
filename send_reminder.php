<?php
session_start();
include('config.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
}
$msg="";
include('config.php');
$sql="SELECT * from payment"; 
$result=mysqli_query($conn,$sql);
$current=date('Y-m-d');    
$d=strtotime("+30 days",strtotime($current));
$d=date("Y-m-d",$d);		
 if(isset($_POST['notbtn'])){
	        $sendto=$_POST['send'];
		
	        foreach ($sendto as $detail){
			$duedetail=explode(',',$detail);
			
			$pid=$duedetail[0];
		    $sql="SELECT * FROM owners WHERE `plotid`='$pid'";
            $result2=mysqli_query($conn,$sql);
			$row2=mysqli_fetch_assoc($result2);
			echo $row2['email1'];
			echo "please make sure to pay Amount:$duedetail[1] at date $duedetail[2]";//send this message
			echo "<br>";
			//code of due payment email on $row2['email1'];
			//code of due payment  msg on $row2['mobileno1'];
            $msg="reminder sent successfully!!!";
			}
		}
		
	 
  
  
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GBAY</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'sidebar.php';?>

        <div id="page-wrapper">
	
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Our customers</h1>
                     <p style="color:green;font-size:15px;font-weight:bold;"><?php echo $msg;?></p>
                 </div>
                
                <!-- /.col-lg-12 -->
  
                </div>
				
                <!-- /.col-lg-12 -->
  
            <!-- /.row -->
         
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detail_of_customer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="post" ><table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                <thead>
                                    <tr>
                                        <th>Plot_id</th>
                                        <th>Name</th>
                                        <th>Total Paid</th>
                                        <th>Remaining</th>
                                        <th>last payment</th>
										<th>Due Amount and date</th>
                                        <th>Pay now</th>
                                     </tr>  
                                </thead>
                                <tbody>
                                 <?php  while($row=mysqli_fetch_assoc($result)){?>	
 										<tr>
											<td><a href="plotpaymentdetail.php?payment_id=<?php echo $row['plotid']; ?>"><?php echo $row['plotid']; ?><a></td>
											<td><?php echo $row['saname1']; ?></td>
											<td><?php echo $row['paid'];$toPaid=$row['paid']; ?></td>
											<td><?php echo $row['remaining'];?></td>
											<td><?php echo $row['date_of_lastpayment'];?></td>
											<td>
											<?php if($row['remaining']>0){ 
											    $p=$row['plotid'];
												$sql="SELECT * FROM futurepayments WHERE `plotid`='$p' AND tillpaid>=$toPaid order by date ASC";
												$result2=mysqli_query($conn,$sql);
												while($row2=mysqli_fetch_assoc($result2)){
													echo $row2['amt']." | ".$row2['date']."<br>"; 
												}
											} ?>
											</td>
											<td><a href="addpayment.php?plotid=<?php echo $p?>" >PAY</td>
									     </tr>
									<?php	}?>
									
                                </tbody>
								
                            </table>
							
							</form>
                            <!-- /.table-responsive -->
                         
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
                
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                   
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	<!--apni js -->
    <script src="js/myjs.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	   <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
    

</body>

</html>
