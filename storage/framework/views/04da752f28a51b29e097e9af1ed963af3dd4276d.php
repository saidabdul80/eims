<?php
use App\Lga;
use App\Ward;
use App\Provider;



    $lgas = Lga::all();
    $wards = Ward::all();
    $providers = Provider::all();


   function lga_name($lgas, $id){
        foreach ($lgas as $key => $lga) {
            if($lga['id'] == $id){
                return $lga['lga'];
            
            }   
        }
   }


   function ward_name($wards, $id){
    foreach ($wards as $key => $ward) {
        if($ward['id'] == $id){
            return $ward['ward'];
        
        }
    }
}


function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}

function finger_text($finger){
		if(empty($finger) || $finger==null){
			$status = '<span class="bg-danger">Absent</span>';
		}else{
			$status = '<span class="bg-success">Present</span>';
		}
		
		echo $status;
	}
	
	
	 $user_data = session()->get('user_data');
         $user_id = $user_data->id;
         $first_name = $user_data->first_name;
         
         $total_approved_by_user = DB::table('tbl_enrolee')->where('approved_by', $user_id)->where('status', '1')->get()->count();
         $total_approved = DB::table('tbl_enrolee')->where('enrolment_approval_status', '!=', '0')->where('status', '1')->get()->count();
         
         $date = date('Y-m-d');
         $total_approved_by_user_today = DB::table('tbl_enrolee')->where('approved_by', $user_id)->where('approved_date', 'LIKE', $date.'%')->where('status', '1')->get()->count();

?>

<?php $__env->startSection('content-body'); ?>


<div class="well well-sm">
    <h3> Hello, <strong><?php echo e($first_name); ?></strong></h3>
      <h5> Your Approval Records:</h5>
        <table class="table table-bordered table-stripped">
                <tr>
                    <th>Total Enrolment Approved: </th>
                    <td><?php echo e($total_approved_by_user); ?></td>
                </tr>
                 <tr>
                    <th>Total Enrolment Approved Today: </th>
                    <td><?php echo e($total_approved_by_user_today); ?></td>
                </tr>
            
        </table>
    
</div>
<p class="text-right"> <a href="<?php echo e(route('enrolment.recapture-list')); ?>" class="btn btn-sm btn-primary"> See Re-capture Lists [In progress...]</a></p>
  <br/>
  <br/>
<div class="container">
    <table class="table table-bordered table-stripped">
            <?php $__currentLoopData = $enrollees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="row_<?php echo e($enrollee->id); ?>">
                    <td><?php echo e(($loop->index + 1)); ?></td>
                    <td><?php echo e($enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name); ?></td>
                    <td><?php echo e($enrollee->enrolment_number); ?></td>
                    <td class="text-center"><?php echo e($enrollee->enrolee_type); ?></td>
                    <td class="text-center"><?php echo e($enrollee->enrolee_category); ?></td>
                    <td class="text-center"><?php echo e($enrollee->sex); ?></td>
                    <td class="text-center"><?php echo e($enrollee->date_of_birth); ?></td>
                    <td class="text-center"><?php echo e($enrollee->nin); ?></td>
                    <td class="text-center" >
                        <button class="btn btn-info" title="View Enrolment Detials"  onclick="load_enrollee_info(<?php echo e($enrollee->id); ?>)"><i class="fa fa-eye" style="color:#fff"></i></button>
                       <button class="btn btn-primary" title="Update Record" onclick="load_edit_enrollee_info(<?php echo e($enrollee->id); ?>)"><i class="fa fa-edit" style="color:#fff"></i></button>
                       <!-- <button class="btn btn-danger" title="Reject Enrolment" id="reject_btn_<?php echo e($enrollee->id); ?>" onclick="approve_reject_enrolment(<?php echo e($enrollee->id); ?>,2)" 
			<?php echo e(($enrollee->enrolment_approval_status == '2' ? 'disabled' :'')); ?>><i class="fa fa-close" style="color:#fff" ></i></button>
			
            <button class="btn btn-success" title="Approve Enrolment" id="approve_btn_<?php echo e($enrollee->id); ?>" onclick="approve_reject_enrolment(<?php echo e($enrollee->id); ?>,1)" 
			<?php echo e(($enrollee->enrolment_approval_status == '1' ? 'disabled' :'')); ?>><i class="fa fa-check" style="color:#fff" ></i></button>-->
                        
                    </td>
                </tr>
               
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    
   
</div>
   <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>
function update_enrollee_info(event){
    event.preventDefault();
    //window.history.back();
    $('#feedback').html('<p style="color:red">Saving....</p>');
   
    $.ajax({
         type: 'POST',
         url:  "/update-enrollee-info",
         data : $('#edit_enrolee_form_admin').serialize() + "&_token=<?php echo e(csrf_token()); ?>",
         //data:  {id:id, _token:'<?php echo e(csrf_token()); ?>' },
         success: function(data){
             if(data.status == 200)
                 $('#feedback').html('<p class="alert alert-success">'+data.message+'</p>');
            else
                 $('#feedback').html('<p class="alert alert-danger">'+data.message+'</p>');

            },
         error: function(data){
            
             console.log(data);
         }
     })

     
}




function approve_reject_enrolment(id, enrolment_approval_status){
    let proceed = false;
    let approval_comment = $('#approval_comment').val();
    let reject_reason = '';
      /*  if(enrolment_approval_status == 1){
            proceed = confirm('Are you sure you want to approve the ennrolment?')
        }else{
            proceed = confirm('Are you sure you want to reject the ennrolment?')
            if(proceed){
                reject_reason = prompt('Reason for rejecting the enrolment:');
                console.log(reject_reason)
                if(reject_reason == null){
                    alert('Sorry cannot continue without specifying reason for rejeceting the enrolment')
                    proceed = false
                }
            }
        }
    
        if(proceed){
            */
        
        if(enrolment_approval_status == '2' && approval_comment == 'None'){
            alert('Please select Biometric Issue')
        }else{
             $.ajax({
             type: 'POST',
             url:  "/approve-reject-enrolment",
             data:  {id:id,enrolment_approval_status:enrolment_approval_status,reject_reason:reject_reason,approval_comment:approval_comment, _token:'<?php echo e(csrf_token()); ?>' },
             success: function(data){
                
                    alert(data.message)
                    if(enrolment_approval_status == 1){
                        $('#approve_btn').attr('disabled','disabled')
                        $('#reject_btn').attr('disabled',false)
    
                        $('#approve_btn_'+id).attr('disabled','disabled')
                        $('#reject_btn_'+id).attr('disabled',false)
                        
                         $('#row_'+id).css('color','green');
                    }else{
                        $('#approve_btn').attr('disabled',false)
                        $('#reject_btn').attr('disabled','disabled')
    
                        $('#approve_btn_'+id).attr('disabled',false)
                        $('#reject_btn_'+id).attr('disabled','disabled')
                        $('#row_'+id).css('color','red');
                    }
                    
                    $('#approve_btn_'+id).attr('disabled','disabled')
                   $('#reject_btn_'+id).attr('disabled','disabled')
                 },
             error: function(data){
                
                 console.log(data);
             }
         })
        }
        
        
       
       
   // }
}


    function load_enrollee_info(id){
        
        $('#myModal').modal('show');
        $('#modal-footer').hide('slow');
        $('#modal-content').html('<h2 class="text-center text-danger">Loading Enrollee Info.,Please wait...</h2>');
        $.ajax({
         type: 'POST',
         url:  "/load-enrollee-info-with-biometric",
         data:  {id:id, _token:'<?php echo e(csrf_token()); ?>' },
         success: function(data){
           
               $('#modal-content').html(data.html);
             },
         error: function(data){
            
             console.log(data);
         }
     })

     
    }
    
    
    function load_edit_enrollee_info(id){
        $('#myModal2').modal('show');
        $('#modal-footer2').hide('slow');
        $.ajax({
         type: 'POST',
         url:  "/load-edit-enrollee-info",
         data:  {id:id, _token:'<?php echo e(csrf_token()); ?>' },
         success: function(data){
            
               $('#modal-content2').html(data.html);
             },
         error: function(data){
            
             console.log(data);
         }
     })

     
    }
 
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/enrolment/enrolment_approval.blade.php ENDPATH**/ ?>