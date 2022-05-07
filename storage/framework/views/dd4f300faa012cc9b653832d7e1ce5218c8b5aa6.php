<style type="text/css">
.pd-3{
  padding:0px 5px !important;
}
.pd-r{
  padding: 0px 5px 0px 0px !important;
}
.pd-l{
 padding: 0px 0px 0px 5px !important; 
}
</style>
<div class="row m-0 text-center" id="dashboard_top_figures_wrap" style="width: 100%;">
        <div class="col-md-3 col-lg-3 pd-r">
                <div class="counter">
                <i class="fa fa-users fa-x text-warning"></i>
                <h2 class="timer count-title count-number" data-to="157" data-speed="1500" id="nicare_enrollees"><?php echo e(number_format($nicare_enrollees)); ?></h2>
                <p class="count-text ">NiCare Enrollees</p>
                </div>
         </div>
	        <div class=" col-md-3 col-lg-3 pd-3">
	        <div class="counter">
                <i class="fa fa-users fa-x text-primary"></i>
                <h2 class="timer count-title count-number" data-to="157" data-speed="1500"><?php echo e($all_providers); ?></h2>
                <p class="count-text ">Accredited Providers</p>
                </div>
	        </div>
			
			    <!--<div class="col-md-2 col-lg-2">
                <div class="counter">
                <i class="fa fa-users fa-x text-secondary"></i>
                <h2 class="timer count-title count-number" data-to="157" data-speed="1500" id="huwe_enrollees">100</h2>
                <p class="count-text ">Huwe Enrollees</p>
                </div>
               </div>
			    <div class="col-md-2 col-lg-2">
                <div class="counter">
                <i class="fa fa-heartbeat fa-x text-danger"></i>
                <h2 class="timer count-title count-number" data-to="157" data-speed="1500"><?php echo e($all_providers); ?></h2>
                <p class="count-text ">Huwe Accredited Providers</p>
                </div>
               </div>-->
              <div class="col-md-2 col-lg-3 pd-3">
               <div class="counter">
                <i class="fa fa-money fa-x text-info"></i>
                <h2 class="timer count-title count-number" data-to="1700" data-speed="1500"><?php echo e(html_entity_decode("&#8358;").''.$months[IntVal(date('m'))]['cap']); ?></h2>
                <p class="count-text ">Capitation  (<?php echo e(date('M')); ?>, <?php echo e(date('Y')); ?>)</p>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 pd-l ">
                <div class="counter">
                <i class="fa fa-money fa-x text-danger"></i>
                <h2 class="timer count-title count-number" data-to="11900" data-speed="1500" id="next_month_cap"><?php echo e(html_entity_decode("&#8358;").''.number_format($next_month_cap)); ?></h2>
                <p class="count-text "> Capitation (Next Month)</p>
                </div></div>
             
			   
			  
         </div><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/nicare_dashboard_top_figures.blade.php ENDPATH**/ ?>