 <?php
session_start();
include('config.php');
include('fun.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
} 
$msg="";
if(isset( $_POST['submit'] )){
	$plotid=strtoupper($_POST['plotid']);
    $saname1=test_input($_POST['aname1']);
	$saname2=test_input($_POST['aname2']);
	$plan=test_input($_POST['p1']);
	$discount=test_input($_POST['discount']);
	$brokerid=test_input($_POST['bid']);
	$bperc=test_input($_POST['bper']);
	$through=test_input($_POST['through']);
	$count=0;
    $results2="";
		if(isset($_POST['plc'])){
	     $plc=$_POST['plc'];
		foreach($_POST['plc'] as $selected) {
		// Here $results holdig all the check box values as a string
		$results2 .= $selected. " ";
        $count=$count+1;		
		//if you need space for each value use $results .= $selected . " ";
		}
		
	}
	if(!(isset($_POST['plc']))){
		$plc=array(0,0,0);	
	}
	
	$sql="INSERT INTO selldetail (`pid`, `saname1`, `saname2`, `plan`, `plc`, `discount`, `brokerid`,`Brokerage`,`sellthrough`) VALUES ('$plotid', '$saname1', '$saname2', '$plan', '$results2', '$discount', '$brokerid','$bperc','$through')";
	if(mysqli_query($conn, $sql)) {
		$msg="register successfully!!!";
	} else {
		echo "Error: " . $sql. "<br>" . mysqli_error($conn);
	}
	
	$firstCharacter=$plotid;
	if($firstCharacter[0]=='G'&&$firstCharacter[1]=='O'){
	  
     $sql = "SELECT * from `price_list` where Notation_plot_id='GO'";
	  $result=mysqli_query($conn, $sql);	  
	  $row=mysqli_fetch_assoc($result);	
	}
	
	else if($firstCharacter[0]=='G'||$firstCharacter[0]=='S'||$firstCharacter[0]=='Y'){
	$sql = "SELECT * from `price_list` where Notation_plot_id='$firstCharacter[0]'";
	$result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);	
	} 
     $amount=$row['total_price'];	
	 if($count==1)
	 $amount=$row['total_price']+($row['total_price']*$plc[0]/100);
	if ($count==2){
		
	 $amount=$row['total_price']+(($row['total_price']*$plc[0])/100+($row['total_price']*$plc[1])/100);	
	  $amount=$amount*95/100;
	}
	if ($count==3){
		
	 $amount=$row['total_price']+(($row['total_price']*$plc[0])/100+($row['total_price']*$plc[1])/100+($row['total_price']*$plc[2])/100);	
	 $amount=$amount*95/100;
	}
	
	$totalamount=($amount*(100-$discount))/100;
	$first=$totalamount*10/100;
	$due=$totalamount-$first;
    $d=date("Y-m-d");
	$sql="INSERT INTO payment (`plotid`, `saname1`, `saname2`, `paid`, `remaining`, `date_of_lastpayment`,`bid`) VALUES ('$plotid', ' $saname1', ' $saname2', '0', '$totalamount', '$d','$brokerid')";
      mysqli_query($conn, $sql);
	
	//to save due detail like date and amount at that day
	if($plan=='A'){
		 $current=date('Y-m-d');
		 $d=strtotime("+30 days",strtotime($current));
		 $d1=date("Y-m-d",$d);
		 $due1=$totalamount*90/100;
		 $tillpaid=$due1;
		 $sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due1','$tillpaid','$d1')";
		 mysqli_query($conn, $sql);
	}
	
	if($plan=='B'){
		$current=date('Y-m-d');
		$d=strtotime("+15 days",strtotime($current));
		$d1=date("Y-m-d",$d);
		$due1=$totalamount*15/100;
		$tillpaid=$due1;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due1','$tillpaid','$d1')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+90 days",strtotime($current));
		$d2=date("Y-m-d",$d);
		$due2=$totalamount*25/100;
		$tillpaid=$due1+$due2;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due2','$tillpaid','$d2')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+210 days",strtotime($current));
		$d3=date("Y-m-d",$d);
		$due3=$totalamount*25/100;
		$tillpaid=$due1+$due2+$due3;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due3','$tillpaid','$d3')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+330 days",strtotime($current));
		$d4=date("Y-m-d",$d);
		$due4=$totalamount*25/100;
		$tillpaid=$due1+$due2+$due3+$due4;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due4','$tillpaid','$d4')";
		mysqli_query($conn, $sql);
	}
	
	if($plan=='C'){
		$current=date('Y-m-d');
		$d=strtotime("+15 days",strtotime($current));
		$d1=date("Y-m-d",$d);
		$due1=$totalamount*15/100;
		$tillpaid=$due1;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due1','$tillpaid','$d1')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+90 days ",strtotime($current));
		$d2=date("Y-m-d",$d);
		$due2=$totalamount*15/100;
		$tillpaid=$due1+$due2;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due2','$tillpaid','$d2')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+120 days ",strtotime($current));
		$d3=date("Y-m-d",$d);
		$due3=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due3','$tillpaid','$d3')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+180 days ",strtotime($current));
		$d4=date("Y-m-d",$d);
		$due4=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3+$due4;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due4','$tillpaid','$d4')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+240 days ",strtotime($current));
		$d5=date("Y-m-d",$d);
		$due5=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3+$due4+$due5;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due5','$tillpaid','$d5')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+300 days ",strtotime($current));
		$d6=date("Y-m-d",$d);
		$due6=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3+$due4+$due5+$due6;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due6','$tillpaid','$d6')";
		mysqli_query($conn, $sql);
		$d=strtotime("+360 days ",strtotime($current));
		$d7=date("Y-m-d",$d);
		$due7=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due7','$tillpaid','$d7')";
		mysqli_query($conn, $sql);
		$d=strtotime("+420 days ",strtotime($current));
		$d8=date("Y-m-d",$d);
		$due8=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7+$due8;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due8','$tillpaid','$d8')";
		mysqli_query($conn, $sql);
		$d=strtotime("+480 days ",strtotime($current));
		$d9=date("Y-m-d",$d);
		$due9=$totalamount*5/100;
		
		$tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7+$due8+$due9;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due9','$tillpaid','$d9')";
		mysqli_query($conn, $sql);
		
		$d=strtotime("+540 days ",strtotime($current));
		$d10=date("Y-m-d",$d);
		$due10=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7+$due8+$due9+$due10;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due10','$tillpaid','$d10')";
		mysqli_query($conn, $sql);
		$d=strtotime("+600 days ",strtotime($current));
		$d11=date("Y-m-d",$d);
		$due11=$totalamount*5/100; 
		$tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7+$due8+$due9+$due10+$due11;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due11','$tillpaid','$d11')";
		mysqli_query($conn, $sql);
		$d=strtotime("+660 days ",strtotime($current));
		$d12=date("Y-m-d",$d);
		$due12=$totalamount*5/100;
		$tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7+$due8+$due9+$due10+$due11+$due12;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due12','$tillpaid','$d12')";
		mysqli_query($conn, $sql);
		$d=strtotime("+750 days ",strtotime($current));
		$d13=date("Y-m-d",$d);
		$due13=$totalamount*5/100;
	    $tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7+$due8+$due9+$due10+$due11+$due12+$due13;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due13','$tillpaid','$d13')";
		mysqli_query($conn, $sql);
		$d=strtotime("+840 days",strtotime($current));
		$d14=date("Y-m-d",$d);
		$due14=$totalamount*5/100;
        $tillpaid=$due1+$due2+$due3+$due4+$due5+$due6+$due7+$due8+$due9+$due10+$due11+$due12+$due13+$due14;
		$sql = "INSERT INTO futurepayments(`plotid`, `amt`, `tillpaid`, `date`) VALUES ('$plotid','$due14','$tillpaid','$d14')";
		mysqli_query($conn, $sql);		
	}
	
	header('Location:addpayment.php?plotid='.$plotid);
	
	
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

        <!-- Navigation -->
        <?php include('sidebar.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Plot detail </h1>
                     <p style="color:green;font-size:15px;font-weight:bold;"><?php echo $msg;?></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Fill sell detail of customer
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" method="post" id="regform" name="sellform">
									 <div class="form-group">
                                            <label>Plot id</label>
                                            <input readonly="readonly"  class="form-control required" type="text" name="plotid"  value="<?php echo $_SESSION['plotid']; ?>" >
                                     
                                        </div>
                                        <div class="form-group">
                                            <label>Name of Applicant</label>
                                            <input readonly="readonly"  class="form-control required" type="text" name="aname1" value="<?php echo $_SESSION['aname1']; ?>">
                                        </div>
                                         <div class="form-group">
                                            <label>second applicant</label>
                                            <input readonly="readonly"  class="form-control required" type="text" name="aname2" value="<?php echo $_SESSION['aname2']; ?>">
                                         
                                        </div>
                                           <div class="form-group">
                                            <label>Down payment plan</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="p1" value="A">Plan A
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="p1" value="B" >Plan B
                                            </label>
                                             <label class="radio-inline">
                                                <input type="radio" name="p1" value="C" >Plan C
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Prefential Location Charge (PLC)</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="plc[]" value="10">Corner PLC
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox" name="plc[]" value="10">40 Feet Wide Road PLC
                                            </label>
                                              <label class="checkbox-inline">
                                                <input type="checkbox" name="plc[]" value="5">Park PLC
                                            </label>
                                        </div>
										 <div class="form-group">
                                            <label>Discount</label>
                                            <input class="form-control required" type="text" value="0" name="discount">
                                          </div>
                                        <div class="form-group">
					<select name="bid" id="" class="form-control">
						<option value="">Choose Broker</option>
						<?php 
						$qp="select * from broker order by bid DESC";
						$resultp=mysqli_query($conn, $qp);
						$num=mysqli_num_rows($resultp);
						if($num>0){ 
							while($rowp=mysqli_fetch_assoc($resultp)){ ?>
								<option value="<?php echo $rowp['bid']?>">
								<?php echo "Broker_id:".$rowp['bid'] ?> 
								<?php echo "Name of Broker:".$rowp['name'] ?> 
								<?php echo "Email:".$rowp['email'] ?> 
								<?php echo "mibile no:".$rowp['mob'] ?> 
								 
								</option>
						<?php	}
						}
						?>
					</select>
					</div>
										  <div class="form-group">
                                            <label>Broker percantage</label>
                                            <input class="form-control required" type="text" name="bper">
                                          </div>
                                           <div class="form-group">
                                            <label>Multiple Selects</label>
                                            <select class="form-control" name="through">
                                                <option value="GBAY">GBAY</option>
                                                <option value="SHAIL VIHAR">SHAIL VIHAR</option>
                                                
                                            </select>
                                        </div>
                                        <input  type="submit" name="submit" class="btn btn-success" value="submit"></input>
										  <a style="float:right;" href="logout2.php" class="btn btn-success">ADD NEW DETAIL</a> 
                                       </form>
                                    
                                </div>

                                       
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
