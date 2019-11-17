<?php 
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	function getAsscName($conn,$asid){
		$q="select name from associates where asid='$asid'";
		$result=mysqli_query($conn, $q); 
		$row=mysqli_fetch_assoc($result);
		return $row['name'];
	}
	function assParentTree($conn,$asid){
		$sql = "select * from associates where asid='".$asid."'";
		$result=mysqli_query($conn, $sql);
		$row=mysqli_fetch_assoc($result);
		if($row['refid']==123){
			echo "(Direct Associate)";
		}else{
			echo ' > <a href="associate.php?asid='.$row['refid'].'">'.getAsscName($conn,$row['refid']).'</a>';
			assParentTree($conn,$row['refid']);
		}													
	}
	
	function percentageCom($conn,$ndeals){
		switch($ndeals){
			case 0:{
				$pc=0;
				break;
			}
			case 1:{
				$pc=7;
				break;
			}
			case 2:{
				$pc=8;
				break;
			}
			case 3:{
				$pc=9;
				break;
			}
			case 4:{
				$pc=10;
				break;
			}
			case 5:{
				$pc=11;
				break;
			}
			case 6:{
				$pc=12;
				break;
			}
			case 7:{
				$pc=13;
				break;
			}
			case 8:{
				$pc=14;
				break;
			}
			case 9:{
				$pc=15;
				break;
			}
			case 10:{
				$pc=16;
				break;
			}
		}
		if($ndeals>10){
			$pc=16;
		}
		return $pc;
	}
	function CalulateCom($plotssold,$pc,$bsp,$ppid,$conn){
		$x=getPlotAssocId($conn,$ppid);
		$oldpc=getPlotAssocId($conn,$ppid);
		if($pc==$x){
			$pc=$pc;
		}else{
			if($pc>$x){
				$pc=$pc-$x;
			}else{
				$pc=0;
			}
		}
		return $bsp*($pc/100);
	}
	
	function assCalcTree($conn,$asid,$bsp,$ppid){
		$sql = "select * from associates where asid='".$asid."'";
		$result=mysqli_query($conn, $sql);
		$row=mysqli_fetch_assoc($result);
		if($row['refid']==123){ ?>
			<button type="button" class="btn btn-primary">
			<?php echo getAsscName($conn,$row['asid']);?>
			<span class="badge">
			<?php echo $plotssold=asscSoldPlotNo($conn,$row['asid']);?>
			</span>
			<?php echo '<span class="badge">'.$pc=percentageCom($conn,$plotssold).' %</span>'; ?>
			<?php echo '<span class="badge">'.CalulateCom($plotssold,$pc,$bsp,$ppid,$conn).'</span>'; ?>
			</button>
		<?php }else{
			echo '<button type="button" class="btn btn-primary">';
			echo getAsscName($conn,$row['asid']);
			echo ' <span class="badge">';
			echo $plotssold=asscSoldPlotNo($conn,$row['asid']);
			echo '</span>';
			echo ' <span class="badge">'.$pc=percentageCom($conn,$plotssold).' %</span>';
			echo '<span class="badge">'.CalulateCom($plotssold,$pc,$bsp,$ppid,$conn).'</span>';
			echo '</button>&nbsp;';
			assCalcTree($conn,$row['refid'],$bsp,$ppid);
		}
		$GLOBALS['oldplotsold']=$plotssold;
		$GLOBALS['oldper']=$pc;
		$asID=$row['asid'];
		$GLOBALS['asPlotArray'][$asID]=$plotssold;
	}
	
	function asscSoldPlotNo($conn,$asid){
		$nq="select * from soldproperty where asid='$asid'";
		$nresults=mysqli_query($conn,$nq);
		return mysqli_num_rows($nresults);
	}
	
	
	
	
	function getPlotAssocId($conn,$ppid){
		$q="select asid from soldproperty where propid='$ppid'";
		$result=mysqli_query($conn, $q);
		$row=mysqli_fetch_assoc($result); 
		$asid=$row['asid'];
		$plotssold=asscSoldPlotNo($conn,$row['asid']);
		return $pc=percentageCom($conn,$plotssold);
	}
	function gc($asid,$plotsold,$mainBSP,$conn){
		$pc=percentageCom($conn,$plotsold);
		return $mainBSP*($pc/100);
	}
	function allpropList(){
		
	}
?>