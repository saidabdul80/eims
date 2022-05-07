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
                <div class="counter"  style="border-bottom:5px solid #075c8a">
                <i class="fa fa-users fa-x text-warning"></i>
                <h2 class="timer count-title count-number" data-to="157" data-speed="1500" id="nicare_enrollees"><?php echo e(number_format($data['nicare-bhcpf-count'][0]->total)); ?></h2>
                <p class="count-text ">NiCare Enrollees</p>
                </div>
         </div>
	        <div class=" col-md-3 col-lg-3 pd-3">
	        <div class="counter"  style="border-bottom:5px solid #db3b99">
                <i class="fa fa-users fa-x text-primary"></i>
                <h2 class="timer count-title count-number" data-to="157" data-speed="1500"><?php echo e(number_format($data['providers-count'])); ?></h2>
                <p class="count-text ">Accredited Providers</p>
                </div>
	        </div>
			
              <div class="col-md-2 col-lg-3 pd-3">
               <div class="counter"  style="border-bottom:5px solid #075c8a">
                <i class="fa fa-money fa-x text-info"></i>
                <h2 class="timer count-title count-number" data-to="1700" data-speed="1500">&#8358;<?php echo e(number_format($months[intval(date('m'))]['nicare_cap'] )); ?></h2>
                <p class="count-text ">Capitation  (<?php echo e(date('M')); ?>, <?php echo e(date('Y')); ?>)</p>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 pd-l ">
                <div class="counter"  style="border-bottom:5px solid #db3b99">
                <i class="fa fa-money fa-x text-danger"></i>
                <h2 class="timer count-title count-number" data-to="11900" data-speed="1500" id="next_month_cap">&#8358;<?php echo e(number_format($data['nicare-bhcpf-count'][0]->total * 360)); ?></h2>
                <p class="count-text "> Capitation (Next Month)</p>
                </div></div>
             
			   
			  
         </div><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/nicare_dashboard_top_figures.blade.php ENDPATH**/ ?>