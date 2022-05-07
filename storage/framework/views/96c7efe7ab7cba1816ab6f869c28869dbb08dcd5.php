<?php
use App\Lga;
use App\Ward;
use App\Provider;


    $providers = Provider::all();

    $capitated_providers = Provider::where('serviceClaimType','cap')->orWhere('serviceClaimType','cap/ffs')->get();
    function get_full_month($mth){
        $months_array = months_array();
        
        foreach($months_array as $key => $month){
             $month_db = $month["month"];
                $month_db_full = $month["month_full"];
             if($mth == $month_db){
                 return $month_db_full;
             }	
        }
        return '';
    }
    
    function months_array(){
        return [
            ['month'=> 1, 'month_full'=> 'January'],
            ['month'=> 2, 'month_full'=> 'February'],
            ['month'=> 3, 'month_full'=> 'March'],
            ['month'=> 4, 'month_full'=> 'April'],
            ['month'=> 5, 'month_full'=> 'May'],
            ['month'=> 6, 'month_full'=> 'June'],
            ['month'=> 7, 'month_full'=> 'July'],
            ['month'=> 8, 'month_full'=> 'August'],
            ['month'=> 9, 'month_full'=> 'September'],
            ['month'=> 10, 'month_full'=> 'October'],
            ['month'=> 11, 'month_full'=> 'November'],
            ['month'=> 12, 'month_full'=> 'December']
        ];
    }
    


function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}

$group = $data['group'];
$capitations = $data['capitations'];



$group_id = $group->id;
 
   $total_cap =  collect($capitations)->sum('total_cap'); 
   $total_enrolee =  collect($capitations)->sum('total_enrolee'); 
   $total_providers =  collect($capitations)->groupBy('provider_id')->count('provider_id');
  

?>

<?php $__env->startSection('content-body'); ?>
<br>
<hr/>
<p><a href="<?php echo e(route('capitation.approve-capitation')); ?>" onclick="load_capitation_files_table()"><i class="fa fa-arrow-left"></i> Back to HOME </a></p>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="panel panel-default">
		  <div class="panel-body">
		  <a href="#" class="btn btn-sm btn-default" onclick="ClickheretoprintDiv('content2')">Print &nbsp;<span class="glyphicon glyphicon-print"></span></a>
          <form action="<?php echo e(route('capitation.approve-selected-capitation')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

             <p><input type="hidden" name="group_id" id="group_id" value="<?php echo e($group->id); ?>"></p>
				<div  class="preview" id="content2" style="padding:20px 30px">
                    <p class="text-center"><img src="<?php echo e(asset('images/logo.png')); ?>" alt="" width="50">
                    <br><span class="text-danger">Niger State Contributory Health Scheme (NiCare)</span>
                    <br><span style="padding:4px;" class="b3-theme"><?php echo e($group->name); ?></span></p>
					<div class="">
						<table class="table table-bordered">
							<tr>
								<td>Capitation File name :</td>
								<td><?php echo e($group->name); ?></td>
							</tr>
							<tr>
								<td>Capitation Year :</td>
								<td><?php echo e($group->year); ?></td>
							</tr>
                            <tr>
								<td>Capitated Month :</td>
								<td><?php echo e($group->month_full); ?></td>
							</tr>
							<tr>
								<td>Total Provider :</td>
								<td><?php echo e($total_providers); ?></td>
							</tr>
							<tr>
								<td>Total ENROLEES :</td>
								<td><?php echo e(number_format($total_enrolee)); ?></td>
							</tr>
							<tr>
								<td>Total Capitation :</td>
								<td>&#8358;<?php echo e(number_format($total_cap)); ?></td>
							</tr>
						</table>
					</div>
					<h5> List of Providers on Cap</h5>
					<div class="">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th class="text-center">
                                    All <input type="checkbox" id="cap_all_providers" value="<?php echo e($group->id); ?>" onchange="check_all_cap(this.id,'cap_provider_class')">&nbsp;
                                </All>
								<th class="text-center">SN</th>
								<th class="text-center">PROVIDER</th>
								<th class="text-center">Total Enrolee</th>
								<th class="text-center">Total Cap</th>
								<th class="text-center">DATE GENERATED</th>
							</tr>
							</thead>
							<tbody>
                            <?php $__currentLoopData = $capitations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="row_cap_<?php echo e($cap->provider_id); ?>">
                                        <td class="text-center">
                                        <input type="checkbox" class="cap_provider_class" name="provider_id[]"  value="<?php echo e($cap->provider_id); ?>" onchange="select_unselect_cap_provider()">&nbsp;
                                        </td>
                                        <td class="text-center"><?php echo e($loop->index + 1); ?></td>
                                        <td><?php echo e(provider_name($providers, $cap->provider_id)); ?></td>
                                        <td class="text-center"><?php echo e($cap->total_enrolee); ?></td>
                                        <td class="text-center">N<?php echo e(number_format($cap->total_cap)); ?></td>
                                        <td class="text-center"><?php echo e($cap->date_created); ?></td>
                                        
                                    </tr>
                                  
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
							
						</table>
                        
					</div>
				</div>
                <?php echo $__env->make('layouts.error_success_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <p class=" text-right"   id="approving_feedback2">
                        <button style="display:none" class="btn btn-success" id="approve_cap_button" >Approve Capitation</button></p>
            </form>
		  </div>
		</div>
		
	</div>


</div>
   <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>

function select_unselect_cap_provider(){
					//$('#provider_count').text($('.cap_providers:input:checkbox:checked').length);
					 if($('.cap_provider_class:input:checkbox:checked').length < $('.cap_provider_class:input:checkbox').length){
						  $('#cap_all_providers:input:checkbox').each(function() { this.checked = false; });
					 }else{
						  $('#cap_all_providers:input:checkbox').each(function() { this.checked = true; });
					 }
					 
					 if($('.cap_provider_class:input:checkbox:checked').length > 0){
						  $('#approve_cap_button').fadeIn('fast');
					 }else{
						   $('#approve_cap_button').fadeOut('fast');
					 }
				}
				function select_unselect_provider(){
					
					 $('#provider_count').text($('.cap_providers:input:checkbox:checked').length);
					 if($('.cap_providers:input:checkbox:checked').length < $('.cap_providers:input:checkbox').length){
						  $('#all_providers:input:checkbox').each(function() { this.checked = false; });
					 }else{
						  $('#all_providers:input:checkbox').each(function() { this.checked = true; });
					 }
					 
					 if($('.cap_providers:input:checkbox:checked').length > 0){
						  $('#approve_all_btn').fadeIn('fast');
						  $('#all_caps_btn').fadeIn('fast');
					 }else{
						   $('#approve_all_btn').fadeOut('fast');
						   $('#all_caps_btn').fadeOut('fast');
					 }
					 
				}
				function check_all_cap(id,class_name){
					if($('#'+id).is(":checked")){
						 $('.'+class_name+':input:checkbox').each(function() { this.checked = true; });
						  $('#approve_cap_button').fadeIn('fast');
					 }else{
						  //$("."+class_name).attr("unchecked", "true");
						  $('.'+class_name+':input:checkbox').each(function() { this.checked = false; });
						   $('#approve_cap_button').fadeOut('fast');
					 }
				}
				
				function check_all(id,class_name){
					 if($('#'+id).is(":checked")){
						 $('.'+class_name+':input:checkbox').each(function() { this.checked = true; });
						  $('#approve_all_btn').fadeIn('fast');
						  $('#all_caps_btn').fadeIn('fast');
					 }else{
						  //$("."+class_name).attr("unchecked", "true");
						  $('.'+class_name+':input:checkbox').each(function() { this.checked = false; });
						   $('#approve_all_btn').fadeOut('fast');
						   $('#all_caps_btn').fadeOut('fast');
					 }
					 
					 $('#provider_count').text($('.'+class_name+':input:checkbox:checked').length);
				}

                function ClickheretoprintDiv(div_id)
				{ 
				  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
					  disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
				  var content_vlue = document.getElementById(div_id).innerHTML; 
				  
				  var docprint=window.open("","",disp_setting);  
					docprint.document.write('<html><head><title>.::Nicare</title> <link rel="stylesheet" href="../css/bootstrap.min.css">');
					docprint.document.write('</head><body onLoad="self.print()" style="width: 900px; height="auto" font-size:16px; font-family:arial;">');
					docprint.document.write(content_vlue);
					docprint.document.write('</body></html>');
				   docprint.document.close(); 
				   docprint.focus(); 
				}

                function filter_by_input(search){
				search = search.toUpperCase();
				if(search !=''){
					$(".filter_container:not(:contains('"+search+"'))").hide("slow");
					$(".filter_container:contains('"+search+"')").show("slow");
					
					active_search = true;
				}else{
					$(".filter_container").show("slow");
					active_search = false;
				}
			}
				
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/capitation/approve_capitation_info.blade.php ENDPATH**/ ?>