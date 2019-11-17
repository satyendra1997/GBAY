<?php
session_start();
include('config.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
}

if(isset( $_POST['submit'] )){
	$_SESSION['submitbtn']=$_POST['submit'];
	$plotid=$_POST['plotid'];
	$_SESSION['plotid']=$plotid;
    $aname1=$_POST['aname1'];
	$_SESSION['aname1']=$aname1;
	$wname1=$_POST['wname1'];
	$dob1=$_POST['dob1'];
	$results1="";
	if(isset($_POST['estatus1'])){
	
		foreach($_POST['estatus1'] as $selected) {
		// Here $results holding all the check box values as a string
		$results1 .= $selected. " ";	
		//if you need space for each value use $results .= $selected . " ";
		}
	}
	$results2="";
	if(isset($_POST['rstatus1'])){
	
		foreach($_POST['rstatus1'] as $selected) {
		// Here $results holdig all the check box values as a string
		$results2 .= $selected. " ";	
		//if you need space for each value use $results .= $selected . " ";
		}
	}	
	$madd1=$_POST['madd1'];
	$padd1=$_POST['padd1'];
	$mob1=$_POST['mob1'];
	$eml1=$_POST['eml1'];
	$mars1=$_POST['mars1'];
	$pan1=$_POST['pan1'];
	$idt1=$_POST['idt1'];
	
	//detail of second applicant
	$aname2=$_POST['aname2'];
	if($aname2)
	$_SESSION['aname2']=$aname2;
    else
     $_SESSION['aname2']="";
	$wname2=$_POST['wname2'];
	$dob2=$_POST['dob2'];
	$results3="";
	if(isset($_POST['estatus2'])){
	
		foreach($_POST['estatus2'] as $selected) {
		// Here $results holding all the check box values as a string
		$results3 .= $selected. " ";	
		//if you need space for each value use $results .= $selected . " ";
		}
	}
	$results4="";
	 if(isset($_POST['rstatus2'])){
	
		foreach($_POST['rstatus2'] as $selected) {
		// Here $results holding all the check box values as a string
		$results4 .= $selected. " ";	
		//if you need space for each value use $results .= $selected . " ";
		}
	 }
	$madd2=$_POST['madd2'];
	$padd2=$_POST['padd2'];
	$mob2=$_POST['mob2'];
	$eml2=$_POST['eml2'];
	$mars2=$_POST['mars2'];
	$pan2=$_POST['pan2'];
	$idt2=$_POST['idt2'];
     $d=date('Y-m-d');
	//insertion of data
	
	$sql="INSERT INTO owners (`plotid`,`aname1`, `wname1`, `dob1`, `occupation1`, `resident status1`, `mailadd1`, `pemaadd1`, `mobileno1`, `email1`, `maritalstatus1`, `pan1`, `identity1`, `aname2`, `wname2`, `dob2`, `occupation2`, `resident status2`, `mailadd2`, `pemaadd2`, `mobileno2`, `email2`, `maritalstatus2`, `pan2`, `identity2`,`dor`) VALUES ('$plotid','$aname1', '$wname1', '$dob1', '$results1','$results2', '$madd1', '$padd1', '$mob1', '$eml1', '$mars1', '$pan1', '$idt1', '$aname2', '$wname2', '$dob2', '$results3', '$results4', '$madd2', '$padd2', '$mob2', '$eml2', '$mars2', '$pan2', '$idt2','$d')";
	if(mysqli_query($conn, $sql)) {
		echo "New record created successfully";
		header('Location:sell_detail_plot.php');
	} else {
		echo "Error: " . $sql. "<br>" . mysqli_error($conn);
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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detail of Applicant</h1>
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
                                    <form action="" method="post" id="regform" name="regform">
									 <div class="form-group">
                                            <label>Plot id</label>
                                            <input class="form-control required" type="text" name="plotid">
                                          
                                        </div>
                                        <div class="form-group">
                                            <label>Name of Applicant</label>
                                            <input class="form-control required" type="text" name="aname1">
                                            <p class="help-block">Example:Mr/Mrs/Dr. xyz</p>
                                        </div>
                                         <div class="form-group">
                                            <label>-so/wife/daughter of</label>
                                            <input class="form-control required" type="text" name="wname1">
                                         
                                        </div>
                                      
                                        <div class="form-group">
										      <label>Date Of Birth</label>
						                     <input type="text" class="form-control required dob" name="dob1">
					                    </div>
                                        <div class="form-group">
                                            <label>Occupation(Please Tick)</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="estatus1[]" value="employed">Employed
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox"name="estatus1[]" value=" self employed">self Employed
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox" name="estatus1[]" value="professional">Professional
                                            </label>
                                        </div>
                                          <div class="form-group">
                                            <label>Residential status(Please Tick)</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"name="rstatus1[]" value="resident">Resident
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox"name="estatus1[]" value="no resident india"> No Resident india
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox" name="estatus[]" value="foreign national">foreign National
                                            </label>
                                        </div>
                                        
                                       
                                         <div class="form-group">
                                            <label>Mailing address</label>
                                            <textarea class="form-control required" rows="2" id="madd1" name="madd1"></textarea>
                                        </div>
									       <div class="form-group">
											   <label class="checkbox-inline">
                                                <input type="checkbox" id="fillpp"> if permanent Address of applicant is same as mailaddress Tick
                                            </label>
										</div>
										 <div class="form-group">
                                            <label>Permanent address</label>
                                            <textarea class="form-control required" rows="2" id="padd1" name="padd1"></textarea>
											</div>
										  
										 <div class="form-group">
										       <label>Mobile number</label>
						                     <input type="text" class="form-control required" maxlength="10" minlength="10"name="mob1">
					                    </div>
										
										<div class="form-group">
										       <label>Email Id</label>
						                     <input type="text" class="form-control required email" name="eml1">
					                    </div>
                                        <div class="form-group">
                                            <label>Marital status</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="mars1" value="married" checked>Married
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="mars1" value="unmarried" >Unmarried
                                            </label>
                                          
                                        </div>
                                         <div class="form-group">
										       <label>Income Tax Pan</label>
						                     <input type="text" class="form-control required" name="pan1"></input>
					                    </div>
										
										<div class="form-group">
										       <label>Passport/Adhar/Voter card/DL</label>
						                     <input type="text" class="form-control required"  name="idt1">
					                    </div>
                                       
                                      
                                </div>
								<div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Name of Second Applicant</label>
                                            <input class="form-control" type="text" name="aname2">
                                            <p class="help-block">Example:Mr/Mrs/Dr. xyz</p>
                                        </div>
                                         <div class="form-group">
                                            <label>wife/daughter of</label>
                                            <input class="form-control req" type="text" name="wname2"  >
                                            
                                        </div>
                                      
                                        <div class="form-group">
										      <label>Date Of Birth</label>
						                     <input type="text" class="form-control dob"  name="dob2">
					                    </div>
                                        <div class="form-group">
                                            <label>Occupation(Please Tick)</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="estatus2[]" value="employed">Employed
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox"  name="estatus2[]" value="self employed" >self Employed
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox"  name="estatus2[]" value="professional">Professional
                                            </label>
                                        </div>
                                          <div class="form-group">
                                            <label>Residential status(Please Tick)</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"  name="rstatus2[]" value="resident">Resident
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox"  name="rstatus2[]" value="no resident india"> No Resident India
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox" name="rstatus2[]" value="Foreign national" >Foreign national
                                            </label>
                                        </div>
                                        
                                       
                                         <div class="form-group">
                                            <label>Mailing address</label>
                                            <textarea class="form-control" rows="2" id="madd2" name="madd2"></textarea>
                                        </div>
										 <div class="form-group">
											   <label class="checkbox-inline">
                                                <input type="checkbox" id="fillm"> if mailing Address of second applicant is same as first Tick
                                            </label>
										</div>
										 <div class="form-group">
                                            <label>Permanent address</label>
                                            <textarea class="form-control" rows="2"id="padd2" name="padd2"></textarea>
									   </div>
									    <div class="form-group">
                                             <label class="checkbox-inline">
                                                <input type="checkbox" id="fillp"> if permanent Address of second applicant is same as first Tick
                                            </label>
										</div>
										 <div class="form-group">
										       <label>Mobile number</label>
						                     <input type="text" class="form-control number" name="mob2" maxlength="10" minlength="10">
					                    </div>
										
										<div class="form-group">
										       <label>Email Id</label>
						                     <input type="text" class="form-control email"name="eml2">
					                    </div>
                                        <div class="form-group">
                                            <label>Marital status</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="mars2" id="" value="married" checked>Married
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio"  name="mars2" id="" value="unmarried">Unmarried
                                            </label>
                                          
                                        </div>
                                         <div class="form-group">
										       <label>Income Tax Pan</label>
						                     <input type="text" class="form-control" name="pan2">
					                    </div>
										
										<div class="form-group">
										       <label>Passport/Adhar/Voter card/DL</label>
						                     <input type="text" class="form-control" name="idt2">
					                    </div>
                                        <input  type="submit" name="submit" class="btn btn-success" value="submit"></input>
                                        <button type="reset" class="btn btn-info">Reset Button</button>
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
		$("#regform").validate();
	});
	</script>
  <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</body>

</html>
