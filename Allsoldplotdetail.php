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
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detail_of_all_sold_plot
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                <thead>
                                    <tr>
                                        <th>Plot_id</th>
                                        <th>Name of first applicant</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Date of registration</th>
                                        <th>Plan</th>
                                        <th>Plc</th>
                                        <th>Discount</th>
                                        <th>Broker_id</th>
                                        <th>Broker percentage</th>
                                        <th>Sold Through</th>
                                        
                                    </tr>  
                                </thead>
                                <tbody>
                                       <?php
                                         $sql="SELECT owners.*, selldetail.* FROM owners, selldetail WHERE owners.plotid = selldetail.pid";
	                                     $result=mysqli_query($conn, $sql);
	                                     $num=mysqli_num_rows($result);
										 
									   while($row=mysqli_fetch_assoc($result)){ ?>
										<tr id="rf">
											<td><?php echo $row['plotid']; ?></td>
											<td><?php echo $row['aname1']; ?></td>
											<td><?php echo $row['email1']; ?></td>
											<td><?php echo $row['mobileno1']; ?></td>
											<td><?php echo $row['pemaadd1']; ?></td>
											<td><?php echo $row['dor']; ?></td>
											<td><?php echo $row['plan']; ?></td>
											<td><?php echo $row['plc']; ?></td>
											<td><?php echo $row['discount']; ?></td>
											
											<td><a href="Allbroker.php?brokerwaliid=<?php echo $row['brokerid']; ?>"><?php echo $row['brokerid']; ?><a></td>
											<td><?php echo $row['Brokerage']; ?></td>
											<td><?php echo $row['sellthrough']; ?></td>
											
											
											
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
