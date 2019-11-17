<?php
session_start();
include('config.php');
include('fun.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
}
$msg="";
if(isset($_POST['regbtn'])){
		//print_r($_POST);
		
		$uname=test_input($_POST['uname']);
		$mob=test_input($_POST['mob']);
		$email=test_input($_POST['email']);
		$pan=test_input($_POST['pan']);
		$bankAc=test_input($_POST['bankAc']);
		$refid=test_input($_POST['refid']);
		//$gender=$_POST['gender'];
		date_default_timezone_set('Asia/Kolkata');
		$date=date('Y-m-d');
		$sql ="INSERT INTO broker(`name`, `email`, `mob`, `dor`, `pan`, `bankAc`, `refid`) VALUES ('$uname','$email','$mob','$date','$pan','$bankAc','$refid')";
		if(mysqli_query($conn,$sql)){
			$msg="Broker Successfully Added";
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
                    <h1 class="page-header">Detail of Broker</h1>
                     <p style="color:green;font-size:15px;font-weight:bold;"><?php echo $msg;?></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
						<input id="uname" type="text" class="form-control" name="uname" placeholder="Name" required>
					</div>
					<div class="form-group">
					<input type="number" class="form-control" name="mob" placeholder="Mobile Number" required>
				  </div>
				  <div class="form-group">
					<input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
				  </div>
				  <div class="form-group">
					<input id="pan" type="text" class="form-control" name="pan" placeholder="PAN Card No.">
				  </div>
				  <div class="form-group">
					  <label for="comment">Bank Account Details:</label>
					  <textarea class="form-control" rows="4" id="comment" name="bankAc"></textarea>
					</div>
				  <div class="form-group">
					<label for="comment">Reference ID <small style="color:red;">*[ Enter 123 for Direct Associate ]</small></label>
					<input type="number" class="form-control" name="refid" placeholder="Reference ID" required>
				  </div>
				  
				  <!--
				  <div class="form-group">
					 Male <input type="radio" name="gender" value="male"><br>  
					Female <input type="radio" name="gender" value="female"> 
				  </div>
				  -->
				  <div class="form-group">
					<input type="submit" name="regbtn" class="btn btn-warning" value="Add Broker" />
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
    <!-- /#wrapper -->

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

</body>

</html>
