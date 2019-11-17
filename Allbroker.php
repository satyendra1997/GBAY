<?php
session_start();
include('config.php');
if( !(isset($_SESSION['email'])) ){
	header('Location: index.php');
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
                <div class="col-lg-9">
                    <h1 class="page-header">Detail of Brokers </h1>
                 </div>
                
                <!-- /.col-lg-12 -->
  
                </div>
				
                <!-- /.col-lg-12 -->
  
            <!-- /.row -->
           
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detail_of_All brokers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                <thead>
                                    <tr>
                                        <th>Broker_id</th>
                                        <th>Name </th>
                                        <th>Email</th>
                                        <th>Mobile no</th>
                                        <th>Account detail</th>
                                        <th>Refrence to</th>
                                       
                                    </tr>  
                                </thead>
                                <tbody>
								       <?php
									     $sql="SELECT * FROM broker";
	                                     $result=mysqli_query($conn, $sql);
                                       while($row=mysqli_fetch_assoc($result)){ ?>
										<tr id="rf">
											<td><?php echo $row['bid']; ?></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['mob']; ?></td>
											<td><?php echo $row['bankAc']; ?></td>
											<td style="color:blue;font-weight:bold;"><?php 
											if($row['refid']==123){
												echo "Direct";
											}else{
												$rid=$row['refid'];
												$sql1="SELECT name,bid FROM broker WHERE bid='$rid'";
												$result1=mysqli_query($conn, $sql1);
												$row1=mysqli_fetch_assoc($result1);
												echo $row1['name']." id [". $row1['bid']."]";
											}

											?></td>
											
										</tr>
									<?php	}?>
                                </tbody>
                            </table>
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
    

</body>

</html>
