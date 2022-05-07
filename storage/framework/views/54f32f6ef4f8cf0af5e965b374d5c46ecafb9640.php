<br/>
<br/>
<br/>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<div class="panel panel-00">
<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse00" aria-expanded="false" aria-controls="collapse00">
        <div class="panel-heading mySideTab" role="tab" id="heading00" >
            <h4 class="panel-title">Dashboard  <i id="chevron_00" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>
        </div>
    </a>
	<div id="collapse00" class="panel-collapse collapse" role="tabpane00" aria-labelledby="heading00">
				  <div class="panel-body">
						
							<ul>
									<li class=""> <a href="<?php echo e(route('eims.home')); ?>" ><i class="fa fa-chevron-right"></i> Home </a></li>
									<li class=""> <a href="<?php echo e(route('dashboards.general_dashboard')); ?>" ><i class="fa fa-chevron-right"></i> General Dashboard </a></li>
                              
							</ul>

					</div>
			</div>
</div>

<?php

 $user_data = session()->get('user_data');
         $user_id = $user_data->id;
?>
<?php if(session()->has('user_menus')): ?>
	<div class="panel panel-1">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
       		<div class="panel-heading mySideTab" role="tab" id="heading1" >
            	<h4 class="panel-title">Enrolment<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>
            </div>
        </a>            
		<div id="collapse1" class="panel-collapse collapse" role="tabpane1" aria-labelledby="heading1">
		  <div class="panel-body">
						
				<ul>
						<li class=""> <a href="<?php echo e(route('enrolment.all')); ?>" ><i class="fa fa-chevron-right"></i> All Enrollees </a></li>
						<li class=""> <a href="<?php echo e(route('enrolment.idcard-by-provider')); ?>" ><i class="fa fa-chevron-right"></i> ID Card by Provider </a></li>
						<li class=""> <a href="<?php echo e(route('enrolment.enrolment-approval')); ?>" ><i class="fa fa-chevron-right"></i> Enrolment Approval </a></li>
						<li class=""> <a href="<?php echo e(route('enrolment.enrolment-slip-print')); ?>" ><i class="fa fa-chevron-right"></i> Bulk Enrolment Slip </a></li>
						<li class=""> <a href="<?php echo e(route('enrolment.enrollees-by-provider')); ?>" ><i class="fa fa-chevron-right"></i> Enrollees By LGA | Ward & Provider </a></li>
                  
				</ul>
			</div>
		</div>
          
	</div>
	
	<?php if($user_id == 1 ): ?>
	
	    	<div class="panel panel-1">
        <a class="collapsed" href="<?php echo e(route('manage_users')); ?>">
       		<div class="panel-heading mySideTab" role="tab" id="heading1" >
            	<h4 class="panel-title">Manage Users<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>
            </div>
        </a>            	
	</div>
	<div class="panel panel-1">
        <a class="collapsed" href="<?php echo e(route('manage_providers')); ?>">
       		<div class="panel-heading mySideTab" role="tab" id="heading1" >
            	<h4 class="panel-title">Manage Providers<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>
            </div>
        </a>            	
	</div>
	<div class="panel panel-2">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                <div class="panel-heading mySideTab" role="tab" id="heading2" >
                    <h4 class="panel-title">Capitation<i id="chevron_2" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>
                </div>
            </a>
            <div id="collapse2" class="panel-collapse collapse" role="tabpane2" aria-labelledby="heading2">
				  <div class="panel-body">
						
							<ul>
									<li class=""> <a href="<?php echo e(route('capitation.generate-capitation')); ?>" ><i class="fa fa-chevron-right"></i> Generate Capitation </a></li>
									<li class=""> <a href="<?php echo e(route('capitation.approve-capitation')); ?>" ><i class="fa fa-chevron-right"></i> Approve Capitation </a></li>
									<li class=""> <a href="<?php echo e(route('capitation.capitation-payment')); ?>" ><i class="fa fa-chevron-right"></i> Capitation Payment </a></li>
                             </ul>
					</div>
			</div>
          </div>
		<div class="panel panel-3">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                <div class="panel-heading mySideTab" role="tab" id="heading3" >
                    <h4 class="panel-title">Settings<i id="chevron_3" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>
                </div>
            </a>
            <div id="collapse3" class="panel-collapse collapse" role="tabpane2" aria-labelledby="heading3">
				  <div class="panel-body">
						
							<ul>
									<li class=""> <a href="<?php echo e(route('settings.configure-bed')); ?>" ><i class="fa fa-chevron-right"></i> BED Configurations </a></li>
                             </ul>
					</div>
			</div>
          </div>
	<?php endif; ?>

    
		<div class="panel panel-11">
        <a class="collapsed" d href="<?php echo e(route('logout')); ?>" aria-expanded="false" aria-controls="collapse1">
       		<div class="panel-heading mySideTab" role="tab" id="heading11" >
            	<h4 class="panel-title">Logout<i id="chevron_11" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>
            </div>
        </a>            
		
          
	</div>
   
<?php else: ?> 
   <h1>Hello</h1>
<?php endif; ?>
	

</div>


<?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/layouts/sidemenu.blade.php ENDPATH**/ ?>