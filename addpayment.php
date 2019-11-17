<?php
session_start();
include('config.php');
include('fun.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
}
if(isset($_POST['regbtn'])){
		$payamount=$_POST['amt'];
		$pid=$_POST['propid'];
	    $sql="SELECT * from payment WHERE plotid='$pid'"; 
		$result=mysqli_query($conn, $sql);
		$row=mysqli_fetch_assoc($result);
	    $newpayment=$payamount+$row['paid'];
		$newremainig=$row['remaining']-$payamount;
        $d=date('Y-m-d');
		$pid=$row['plotid'];
		$sql1="UPDATE payment
          SET paid = $newpayment, remaining = $newremainig,date_of_lastpayment='$d'
         WHERE plotid='$pid'";
		 mysqli_query($conn,$sql1);
	
	} 
$msg="";
if(isset($_POST['regbtn'])){
		//print_r($_POST);
		$propid=test_input($_POST['propid']);
		$amt=test_input($_POST['amt']);
		$mode=test_input($_POST['mode']);
		$detail=test_input($_POST['details']);
		date_default_timezone_set('Asia/Kolkata');
		$date=date('Y-m-d');
		$sql = "INSERT INTO fullpaymentdetail(`propid`, `amt`, `mode`, `paymentdetail`, `dop`) VALUES ('$propid', '$amt', '$mode', '$detail', '$date')";
		if(mysqli_query($conn,$sql)){
			$msg="Payment Successfully Added";
		}else{
			$msg="Error occured Try Again";
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
	
	<link rel="stylesheet" href="vendor/jquery/ui/jquery-ui.min.css">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     
	 <link rel="stylesheet" href="validate/jquery.validate.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
		<style>
		button, input, select, textarea{
		color:black;
		}
		</style>
</head>

<body>

    <div id="wrapper">
     
        <?php include'sidebar.php';?>   
                 <style>
					.form-control{font-weight:bold;padding:8px 12px;}
					</style>
        <div id="page-wrapper">
            <div class="row">
			<div class="col-lg-12">
                    <h1 class="page-header">Add detail of payment</h1>
                     <p style="color:green;font-size:15px;font-weight:bold;"><?php echo $msg;?></p>
                </div>
			</div>	
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Application Form
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                   <form action="" method="post" id="reg">
					<div class="form-group">
					<select name="propid" id="" class="form-control">
						<option value="">Choose Property</option>
						<?php 
						  if(isset($_GET['plotid'])){
						  $plotid=$_GET['plotid'];
						$qp="select * from selldetail where pid='$plotid'";
						$resultp=mysqli_query($conn, $qp);
						  $num=mysqli_num_rows($resultp);
						  }
						  else{
							  
							$qp="select * from selldetail order by pid ASC";
						    $resultp=mysqli_query($conn, $qp);
						    $num=mysqli_num_rows($resultp);  
						  }
						if($num>0){ 
							while($rowp=mysqli_fetch_assoc($resultp)){ ?>
								<option value="<?php echo $rowp['pid']?>">
								<?php echo $rowp['pid']."||" ?> 
								<?php echo $rowp['saname1']."||" ?> 
								<?php echo $rowp['plan'] ?> 
								 
								</option>
						<?php	}
						}
						?>
					</select>
					</div>
				  
				  <div class="form-group">
					<input type="number" class="form-control" name="amt" placeholder="Enter Amount">
				  </div>
				  
				  <div class="form-group">
					<select name="mode" id="" class="form-control">
						<option value="">Choose Payment Mode</option>
						<option value="Cash">Cash</option>
						<option value="Check">Cheque</option>
						<option value="Check">DD</option>
						<option value="Check">Bank Transfer</option>
					</select>
				  </div>
				  <div class="form-group">
					<input type="text" class="form-control" name="details" placeholder="Details Like: check no./Ref No. etc">
				  </div>
				  <div class="form-group">
					<input type="submit" name="regbtn" class="btn btn-warning" value="Add Payment" />
				  </div>
				</form>
                      
                                </div>
								
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
	


    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	<script src="vendor/jquery/ui/jquery-ui.min.js"></script>
	<script src="validate/jquery.validate.js"></script>
     	<script>
		$( ".dob" ).datepicker({
			inline: true,
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
		$("#fillm").on('change', function () {
                    if ($(this).prop('checked')) {
                      var add = $. trim($("#madd1"). val());
                      $("#madd2").append(add);
                    }
					 else{
		          $("#madd2").val("");
		          }
                });
		$("#fillp").on('change', function () {
                    if ($(this).prop('checked')) {
                      var add = $. trim($("#padd1"). val());
                      $("#padd2").append(add);
                    }
					 else{
		          $("#padd2").val("");
		          }
                });
		             
		$("#fillpp").on('change', function () {
                    if ($(this).prop('checked')) {
                      var add = $. trim($("#madd1"). val());
                      $("#padd1").append(add);
                    }
					 else{
		          $("#padd1").val("");
		          }
                });		
		 
	</script>
    <script>
	$(document).ready(function(){
		$("#").validate();
	});
	</script>
   <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>

</html>
