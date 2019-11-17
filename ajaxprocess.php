<?php
session_start();
include('config.php');?>

  
 
<?php

   if(isset($_POST['payment_id'])){
	$payment_id=strtoupper($_POST['payment_id']);
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
			<td colspan="2" style="color:red;font-size:15px;"><?php echo $row['remaining']; ?></td>
     </tr>	
	 <?php
   }
	 ?>	 
