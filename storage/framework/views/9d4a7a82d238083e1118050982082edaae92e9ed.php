<?php
 use Illuminate\Support\Facades\DB;
    $usergroup = DB::table('user_group')->where('status','=','1')->get();
    $userrole = DB::table('user_role')->where('status','=','1')->get();    
    $tpas = DB::table('tbl_tpa')->where('status','=','1')->get();
    $LGA = DB::table('lga')->where('status','=','1')->get();
    $WARD = DB::table('ward')->get();
    $PROVIDER = DB::table('tbl_providers')->get();
        //dd($WARD);
$sn = 0;
?>
<script type="text/javascript" src="<?php echo e(asset('js/js_functions.js')); ?>"></script>
<script>
        var usergroups = <?php echo json_encode($usergroup); ?> ;
        var userroles = <?php echo json_encode($userrole); ?> ;
        var all_TPA = <?php echo json_encode($tpas); ?> ;
        var all_LGA = <?php echo json_encode($LGA); ?> ;
        var all_WARD = <?php echo json_encode($WARD); ?> ;
        var all_PROVIDER = <?php echo json_encode($PROVIDER); ?> ;
        var Sorted_userroles;

        function loadForms(group, role){
            if (group == 'NGSCHA Staff'){
                if (role != 'Enrolment Officer (EO)') {
                    $.get('<?php echo e(route("user_forms")); ?>', { type: 1, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                        //console.log(data);
                        $('#load_user_role_form').html(data);
                    });
                }else{
                    $.get('<?php echo e(route("user_forms")); ?>', {type: 2, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                        $('#load_user_role_form').html(data);
                    });
                }
            }
            if (group == 'TPA Staff'){
                $.get('<?php echo e(route("user_forms")); ?>', {type: 3, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                    $('#load_user_role_form').html(data);
                });
            }
            if(group == 'HCP Staff'){
                  $.get('<?php echo e(route("user_forms")); ?>', { type: 4, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                    $('#load_user_role_form').html(data);
                });
            }            

            if(group == 'LGA Staff'){
                  $.get('<?php echo e(route("user_forms")); ?>', {lgas: all_LGA, type: 5, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                    $('#load_user_role_form').html(data);
                });
            } 
             if(group == 'Enrolees'){
                if (role=='Principal - Formal (EES)') {
                    $.get('<?php echo e(route("user_forms")); ?>', {type: 6, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                        $('#load_user_role_form').html(data);
                    });
                }else if(role=='Principal Informal (EES)') {
                     $.get('<?php echo e(route("user_forms")); ?>', {type: 7, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                        $('#load_user_role_form').html(data);
                    });
                }
            }
             if(group == 'Developers'){
                  $.get('<?php echo e(route("user_forms")); ?>', {type: 8, _token:'<?php echo e(csrf_token()); ?>'}, function(data){
                    $('#load_user_role_form').html(data);
                });
            }
            
        }
</script>

<?php $__env->startSection('breadcrumb','Manage Users'); ?>
<?php $__env->startSection('content-body'); ?>
<style type="text/css">
   .title-head{
        text-align: center;
        color: #888;
        font-weight: bolder;
    }
    .options{
        padding: 16px;
    }
    .pd-form:nth-child(odd){
        padding: 0px 15px 0px 0px !important;
    }
    .pd-form:nth-child(even){
        padding: 0px 0px 0px 15px !important;
    }
</style>    
    <?php if(session()->exists('welcome')): ?>
        <hr/> <div class="alert alert-success"> <?php echo e(session('welcome')); ?> </div>
    <?php endif; ?>
     <?php if(session()->exists('success')): ?>
        <hr/> <div class="alert alert-success"> <?php echo e(session('success')); ?> </div>
    <?php endif; ?>
        <ul class="portalBtn">
            <li role="newUser">Add User</li>
            <li role="userRole">Assign Role</li>
            <li role="searchUser">Search User </li>
        </ul>
    <div class="row bg-white" style="width: 100%; min-height: 500px; padding: 0px; margin: 0px;">      
      <!-- add users -->
        <div id="newUser" class="portalCont">
            <div class="title-head">New User Form</div>
            <hr>
            <br>
            <div style="padding: 10px;">
                
                    <fieldset>
                        <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="surname">User Group<span class="asterik asterik_surname">*</span> </label>
                                <input list="usergroup" name="usergroup" id="user_group" onchange="(function(){$('#user_groupid').val(searchA(usergroups, 'group_name', $('#user_group').val()));  select_data_for_data(userroles, 'group_id','id', 'user_groupid', 'user_role','role_name','acronym',1,'user_role_id' );})() ;" class="form-control" placeholder="Select User Group" required="">
                                <span class="close" onclick="(function(){$('#user_role').html('');clearFunc('user_group','user_groupid', 'user_role_id','user_roleid')})()">&times</span>
                                <datalist id="usergroup">                                        
                                    <?php $__currentLoopData = $usergroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($group->group_name); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>                         
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                             <label for="surname">User Role<span class="asterik asterik_surname">*</span> </label>
                                <input list="user_role" name="user_role_id" id="user_role_id" class="form-control" placeholder="Select User role" required="" onchange="(function(){$('#user_roleid').val(searchA(userroles, 'role_name', $('#user_role_id').val())); loadForms($('#user_group').val(), $('#user_role_id').val());})();">
                                <span class="close" onclick="(function(){clearFunc('user_role_id','user_roleid');})()">&times</span>                                
                                <datalist id="user_role">                                    
                                                
                                </datalist>                                         
                            </div>
                        </div>
                        </div>
                </fieldset>
                <form method="POST" action="<?php echo e(route('add_user')); ?>">
                    <input type="hidden"  name="usergroupId" id="user_groupid" class="form-control">
                    <input type="hidden" name="userroleid" id="user_roleid" class="form-control">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />                    
                    <div id="load_user_role_form" class="row"></div>      


                                         
                </form>
              
            </div>

        </div>

        <!-- System User Roles: -->
        <div   id="userRole" class="portalCont">            
          <br>
          <h4>Search User Role</h4>
          <hr>
          <br>
            <table class="table table-bordered table-stripped" style="width: 100%;">
                <thead>
                    <tr>
                        <td>SN</td>
                        <td>ROLE</td>
                        <td>USER GROUP</td>
                        <td>NUMBER OF USERS</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody> 
                </tbody>
            </table>
        </div>

        <!-- Search for User -->
        <div class="portalCont" id="searchUser"  >
            <form action="" method="post">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <p>
                            <input type="text" class="form-control" name="nicare_code" onkeyup="restrict('nicare_code')" value="" id="nicare_code" placeholder="NiCare Code" required="">
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p><input type="submit" class="btn btn-info" value="Load Access Rights"></p>
                    </div>
                  </div>
              </div>
            </form>
        </div>
    </div>

    <!-- find user -->
    <div class="portalCont" >
        <form action="sa.search_user.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="surname">NiCare Code or CNO<span class="asterik asterik_other_name"></span></label>
                    <p><input type="text" class="form-control" name="nicare_code" onkeyup="restrict('nicare_code')" value="" id="nicare_code" placeholder="NiCare Code or CNO" required=""></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="surname"> ------  </label>
                  <p><button class="btn btn-info " type="submit" name="search_for_user_btn"> <i class="fa fa-search"></i> Search for User</button></p>
                </div>
            </div>
        </div>

        </form>
    </div>
      <hr class="hr1">
    <script type="text/javascript">

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/users/manage_users.blade.php ENDPATH**/ ?>