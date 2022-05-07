<?php
 use Illuminate\Support\Facades\DB;
 $tpas = DB::table('tbl_tpa')->where('status','=','1')->get();

?>
<script type="text/javascript" src="{{asset('js/js_functions.js')}}"></script>
<script>

        var all_TPA = <?php echo json_encode($tpas); ?> ;
   
</script>
@if($type == 1)
	 	@include('users.mainform')
@endif

@if($type == 2)
	@include('users.mainform')
	<div class="col-md-12">
		<fieldset>
			<legend> Other Info</legend>
			<div class="col-md-12">
				@include('users.lga_ward_form')					
				<div class="col-md-6">
				<div class="form-group">
				 <label for="first_name">DeviceId  <span class="asterik asterik_first_name">*</span> </label>
				<p><input type="text" class="form-control" name="deviceId" value="" id="deviceId" placeholder="deviceId" required=""></p>

				</div>

				</div>
		<!-- column /-->
				<!-- column -->
				<div class="col-md-6">
					<div class="form-group">
					 <label for="first_name">DeviceModel  <span class="asterik asterik_first_name">*</span> </label>
					<p><input type="text" class="form-control" name="deviceModel" onkeyup="" value="" id="deviceModel" onblur="" placeholder="deviceModel" required=""></p>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						  <label for="occupation">DeviceIMEI <span class="asterik asterik_occupation">*</span></label>
						<p>
						</p><p><input type="text" class="form-control" name="deviceIMEI" value="" id="deviceIMEI" placeholder=" deviceIMEI" required=""></p>

						<p></p>
					</div>
				</div>
			</div>
			
		</fieldset>
	</div>
@endif


@if($type == 3)
	<div class="col-md-6">
		<div class="form-group">
			<label for="first_name">TPA <span class="asterik asterik_first_name">*</span> </label>
			<input list="tpaOption" name="tpa" id="tpaname" class="form-control" required="" onchange="(function(){$('#tpa_id_id').val(searchA(all_TPA, 'organisation', $('#tpaname').val()))})();">
		    <input type="hidden" name="tpa_id" id="tpa_id_id" class="form-control">
		    <datalist id="tpaOption"  >
		    	@foreach($tpas as $tpa)
		        	<option value="{{$tpa->organisation}}">                       
		        @endforeach
		    </datalist>      
		</div>
	</div>
	@include('users.mainform')	
			
@endif


@if($type == 4)
	@include('users.mainform')	
	@include('users.lga_ward_form')	
	<script>
		$(document).ready(function(){
			$('#providerMain').show();
		});
	</script>
@endif

@if($type == 5)
	<h5>no form Available</h5>
@endif

@if($type == 6)
	@include('users.enrollee_info_form')
@endif

@if($type == 7)
	@include('users.enrollee_info_form_informal')	
@endif
    <div class="col-md-12">
                        <div class="form-group">
                              <button type="submit" name="create_user_btn" class="btn btn-primary btn-radius btn-brd grd1 "> Create User </button>
                        </div>
                    </div>    