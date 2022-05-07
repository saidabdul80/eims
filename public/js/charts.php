
                <div class="row">

                       
                       
<div class="col-lg-9">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="pull-right">
<a href="admin.php" class="btn btn-success btn-xs ">Enrolee</a> &nbsp;|&nbsp;
<a href="admin.php?inc" class="btn btn-primary btn-xs ">Premium Income</a> &nbsp;|&nbsp;                                
<a href="admin.php?claim" class="btn btn-primary btn-xs ">Claims</a>
<hr>

                            </div>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="<?php if(isset($_GET['inc'])){?>lineChart<?php }else{?>barChart<?php }?>" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>  
                                     
 <div class="col-lg-3">
     <div align="center"> 
		<?php if(isset($_GET['gdr'])){?>
         <strong style="font-size:13px;">Gender</strong>
        <?php }elseif(isset($_GET['pin'])){?>
        <strong style="font-size:13px;">Premium Type</strong>
        <?php }else{?>
       <strong style="font-size:13px;">Sector</strong>
        <?php } ?>
 </div>
 <div id="chart"></div>
 <br>
 <div align="center">
<a href="admin.php?gdr" class="btn btn-success btn-xs ">Gender</a> &nbsp;|&nbsp;
<a href="admin.php?pin" class="btn btn-primary btn-xs ">PIN Type</a> &nbsp;|&nbsp;                                
<a href="admin.php" class="btn btn-primary btn-xs ">Sector</a>

                           
     </div>                                       
</div>
  </div>
                
<?php

if(isset($_GET['inc'])){

$year=date('Y');
$label="Premium";
$rgba="50,179,12,0.9";
$data_inc="";
$data_for="";
$data_infor="";
for ($x = 1; $x <= 12; $x++) {
		$months = array (1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		$mnx=$months[(int)$x];
			
		$stmt =$db->prepare("SELECT nicare_premium,category  FROM tbl_pin_inven WHERE month='$mnx' and year='$year'");
			$stmt->execute();
	if($stmt->rowCount()>0){
		$informal_inc=0;
		$formal_inc=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				if($row['category']=='Formal'){$formal_inc=$formal_inc+$row['nicare_premium'];}
				if($row['category']=='Informal'){$informal_inc=$informal_inc+$row['nicare_premium'];}
			}
				$inc_sum=$formal_inc+$informal_inc;
			if($inc_sum>0){$data_inc=$data_inc. $inc_sum.',';}else{$data_inc=$data_inc.'0,';}
				
				if($formal_inc>0){$data_for=$data_for. $formal_inc.',';}else{$data_for=$data_for.'0,';}
				if($informal_inc>0){$data_infor=$data_infor. $informal_inc.',';}else{$data_infor=$data_infor.'0,';}
		}else{
			 $data_inc=$data_inc.'0,';
			 $data_for=$data_for.'0,';
			 $data_infor=$data_infor.'0,';
		}
	
	 
}
		 $data_inc=substr($data_inc,0,-1);	
		 $data_for=substr($data_for,0,-1);
		 $data_infor=substr($data_infor,0,-1);
		
}else{
$year=date('Y');
for ($x = 1; $x <= 12; $x++) {
			//$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
			//	$mnx=$months[(int)$x];
			//	 $mm=$x;
			if(strlen($x)=='1'){$x='0'.$x;}
			$enrollee_date=$year.'-'.$x;
				
		//if ($x<=$mm){
			$stmt =$db->prepare("SELECT enrolee_type FROM tbl_enrolee WHERE enrol_date like '%$enrollee_date%'");
				$stmt->execute();
					if($stmt->rowCount()>0){
						
						$formal=0;
							$informal=0;
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								if($row['enrolee_type']=='Formal'){$formal++;}elseif($row['enrolee_type']=='Informal'){$informal++;}
							}
						$total_2=$informal+$formal;
					if($formal>0){$formaldata=$formaldata.$formal.',';}else{$formaldata=$formaldata.'0,';}
						if($informal>0){$informaldata=$informaldata.$informal.',';}else{$informaldata=$informaldata.'0,';}
							if($total_2>0){$data=$data. $total_2.',';}else{$data=$data.'0,';}
					}else{
							//$d1.$mm=0;
							 $formaldata=$formaldata.'0,';
							  $informaldata=$informaldata.'0,';
					$data=$data.'0,';
				}
		}
	//}
$data=substr($data,0,-1);
 $formaldata=substr($formaldata,0,-1);
 $informaldata=substr($informaldata,0,-1);
}
  ?>              
               
                
               
    			
            <script src="js/chartJs/jquery-3.1.1.min.js" type="text/javascript"></script>
             <script src="js/chartJs/bootstrap.min.js" type="text/javascript"></script>
              <script src="js/chartJs/Chart.min.js" type="text/javascript"></script>
    

                <script>
		
		<?php if(isset($_GET['inc'])){?>		
				
					    var lineData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [

            {
                label: "Formal Premium",
                backgroundColor: 'rgba(26,74,148,0.5)',
                borderColor: "rgba(26,14,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $data_for; ?>]
            },{
                label: "Informal Premium",
                backgroundColor: 'rgba(26,179,407,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $data_infor; ?>]
            },{
                label: "Both",
                backgroundColor: 'rgba(147,179,407,0.5)',
                borderColor: "rgba(26,55,455,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $data_inc; ?>]
            }
						
				]
			};
		
			var lineOptions = {
				responsive: true
			};
		
		
			var ctx = document.getElementById("lineChart").getContext("2d");
			new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});	
				
		<?php } ?>
				
							var barData = {
								labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
								datasets: [
								
									{
										label: "Formal",
										backgroundColor: 'rgba(220, 220, 220, 0.5)',
										pointBorderColor: "#fff",
										data: [<?php echo $formaldata; ?>]
									},
									{
										label: "Informal",
										backgroundColor: 'rgba(26,179,148,0.5)',
										borderColor: "rgba(26,179,148,0.7)",
										pointBackgroundColor: "rgba(26,179,148,1)",
										pointBorderColor: "#fff",
										data: [<?php echo $informaldata; ?>]
									},
									{
										label: "Both",
										backgroundColor: 'rgba(26,179,14,0.5)',
										borderColor: "rgba(26,179,148,0.7)",
										pointBackgroundColor: "rgba(26,179,148,1)",
										pointBorderColor: "#fff",
										data: [<?php echo $data; ?>]
									}									
									
								]
							};
						
							var barOptions = {
								responsive: true
							};
						
						
							var ctx2 = document.getElementById("barChart").getContext("2d");
							new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
	
				
				
		
		
						
				
				</script> 