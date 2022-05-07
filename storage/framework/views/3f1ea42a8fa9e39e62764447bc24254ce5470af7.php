<?php
use App\Lga;
use App\Ward;
use App\Provider;


    $providers = Provider::all();


    


function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}







    $groups = $data['groups'];
    $all_groups = $data['all_groups'];
    
    $sn=1;
?>

<?php $__env->startSection('content-body'); ?>
<br>
<br>
<br>


        <div class="row">
            <div class="col-md-12 col-lg-12">
            <?php echo $__env->make('layouts.error_success_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <h3 class="text-danger">Approved Capitations, Waiting for payment</h3>
                <form action="<?php echo e(route('capitation.pay-selected-capitation')); ?>" method="post">
             <?php echo e(csrf_field()); ?>

            
                <p class=" text-right"><button class="btn btn-success" id="all_caps_btn" style="display:none">Pay Selected Capitation(s)</button></p>
                <table class="table table-stripped table-bordered">
                    <tr>
                        <th><input type="checkbox" id="all_providers" onchange="check_all(this.id,'cap_providers')">&nbsp; All</th>
                            <th>YEAR</th>
                            <th>CAPITATION</th>
                            <th>CAPITATED MONTH</th>
                            <th>PROVIDERS</th>
                            <th>TOTAL ENROLLEES</th>
                            <th>AMOUNT</th>
                            <th></th>

                        </tr>
                    <tbody>
                         
                            <?php $__currentLoopData = $all_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php
                                $provider_total = 0;
                                $total_enrolee = 0;
                                $cap_total = 0;
                                $group_info =  collect($groups)->where('group_id', $group->id)->first();
                                
                                if(!empty($group_info)){
                                    $provider_total = $group_info->provider_total;
                                    $cap_total = $group_info->cap_total;
                                    $total_enrolee = $group_info->total_enrolee;
                                }
                            ?>
                            <?php if(!empty($group_info)): ?>
                            <tr>   
                            <td class="text-center"><input type="checkbox" class="cap_providers" name="group_id[]" value="<?php echo e($group->id); ?>" onchange="select_unselect_provider()">&nbsp;</td>
                         
                            <td><?php echo e($group->year); ?></td>
                            <td><?php echo e($group->month_full); ?></td>
                            <td><?php echo e($group->name); ?></td>
                            <td class="text-center"><?php echo e($provider_total); ?></td>
                            <td class="text-center"><?php echo e($total_enrolee); ?></td>
                            <td class="text-center">&#8358;<?php echo e(number_format($cap_total)); ?></td>
                           
                            <td><a href="<?php echo e(route('capitation.approve-capitation-info',[$group->id])); ?>" class="btn btn-sm btn-primary">View Details</a></td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        
                    </tbody>
                </table>
                </form>
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
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/capitation/capitation_payment.blade.php ENDPATH**/ ?>