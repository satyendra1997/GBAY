
<?php
session_start();
include('config.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
}
       $msg="";
      if(isset($_GET['paycancelwaliid'])&&$_GET['flag']==1){
	    $pid=$_GET['paycancelwaliid'];
	    $payid=$_GET['paywaliid'];
	    $amount=$_GET['paymentamt'];
		print_r($amount);
	    $flag=0;
        $sql="SELECT * from payment WHERE plotid='$pid'"; 
		$result=mysqli_query($conn, $sql);
		$row=mysqli_fetch_assoc($result);
	    $newpayment=$row['paid']-$amount;
		$newremainig=$row['remaining']+$amount;
		$query="UPDATE `payment` SET `paid` = '$newpayment',`remaining` = '$newremainig' WHERE plotid='$pid'";
		 if(mysqli_query($conn,$query)){
			$msg="Payment Successfully cancelled";
		}else{
			$msg="Error occured Try Again";
		}
		$sql = "UPDATE `fullpaymentdetail` SET `flag` ='$flag' WHERE `payid` ='  $payid'";
	    mysqli_query($conn,$sql);
		
}	 
  if(isset($_GET['paycancelwaliid'])&&$_GET['flag']==0){
	 $msg="This transaction has been cancelled already";
	 
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
<style>
.sta1{
color:green;
font-size:16px;
font-weight:bold;
}
.sta0{
color:red;
font-size:16px;
font-weight:bold;
}

</style>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'sidebar.php';?>

        <div id="page-wrapper">
	
            <div class="row">
                <div class="col-lg-9">
                    <h1 class="page-header">Payment Summary</h1>
					<p style="color:green;font-size:15px;font-weight:bold;"><?php echo $msg;?></p>
                 </div>
                <div  style="margin-top:60px;"class="col-lg-3">
                  <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search for Plot_id Payment Summary.." id="payment_id">
                                <span class="input-group-btn">
                                <button class="btn btn-default" id="paysearch">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
							</li>
						
					</ul>
                </div>
                <!-- /.col-lg-12 -->
  
                </div>
				
                <!-- /.col-lg-12 -->
  
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" id="output">
					<?php

									 if(isset($_GET['payment_id'])){
									$payment_id=strtoupper($_GET['payment_id']);
									$sql="SELECT * FROM fullpaymentdetail WHERE propid='$payment_id'";
									$result=mysqli_query($conn, $sql);
									$num=mysqli_num_rows($result);	
								  
								  ?>
							<div style="color:#333;font-size:15px;font-weight:bold;" class="panel-heading">
                           <?php echo "Detail_Of_Payment For Plot_id  ". $payment_id;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" >
							
  
  <thead>
  
          <tr>
              
               <th>Amount</th>
               <th>Mode</th>
			   <th>Transaction Detail</th>
               <th>Date Of Payment</th>
               <th>Status</th>
               <th>Action</th>
         </tr>
 </thead>

                                   
                               			
	<?php if($num>0){
		           
		$sum=0;
		while($row=mysqli_fetch_assoc($result)){ 
		
		?>
		     
			<tr id="rf">
				
				<td><?php echo $row['amt']; ?></td>
				<td><?php echo $row['mode']; ?></td>
				<td><?php echo $row['paymentdetail']; ?></td>
				<td><?php echo $row['dop']; ?></td>
				<td class="<?php echo "sta".$row['flag'];?>"><?php 
				if($row['flag']==1){
				echo "Successfull";}
				else{
				echo "Cancelled";	
				}
				?></td>	
				<td><a href="plotpaymentdetail.php?paycancelwaliid=<?php echo $payment_id;?>&&flag=<?php echo $row['flag'];?>&&paymentamt=<?php echo $row['amt'];?>&&paywaliid=<?php echo $row['payid'];?>" id="cancel">Cancel payment</a></td>
			</tr>
	<?php	$sum=$sum+$row['amt'];}
	}else{ ?>
           <td colspan="5">No Result Found
			</td>
	<?php }
  ?>
  <?php
   
    $sql="SELECT * FROM payment WHERE plotid='$payment_id'";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	$toltal=$row['paid']+$row['remaining'];
    ?> 
   <tr>
		<td  colspan="4" style="color:blue;font-weight:bold;font-size:15px;">Total Amount</td>
		<td colspan="2" style="color:red;font-size:15px;"><?php echo $toltal; ?></td>
    </tr>		
	<tr>
	     <td  colspan="4"style="color:blue;font-weight:bold;font-size:15px;">Paid Amount till now</td> 
		 	<td colspan="2" style="color:red;font-size:15px;"><?php echo $row['paid']; ?></td>
     </tr>	
	<tr>
		<td  colspan="4"style="color:blue;font-weight:bold;font-size:15px;">Remaining</td> 
			<td colspan="2"  style="color:red;font-size:15px;"><?php echo $row['remaining']; ?></td>
     </tr>	
	 <?php
   }
	 ?>	 

                            </table>
                            <!-- /.table-responsive -->
                         
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
                
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

</body>

</html>
