<?php
 use Illuminate\Support\Facades\DB;
     $lgas = DB::table('lga')->where('status','=','1')->get();
    $WARD = DB::table('ward')->get();
    $PROVIDER = DB::table('tbl_providers')->get();        
?>

<script type="text/javascript" src="{{asset('js/js_functions.js')}}"></script>

<script type="text/javascript">    
        var lgas = <?php echo json_encode($lgas); ?>;
        var all_WARD = <?php echo json_encode($WARD); ?> ;
        var all_PROVIDER = <?php echo json_encode($PROVIDER); ?> ;
</script>
	<div class="col-md-6 col-lg-6">
        <div class="form-group">
            <label for="surname">LGA<span class="asterik asterik_surname">*</span> </label>
            <input list="lga" name="lga" id="lganame" onchange="(function(){$('#lga_selected_id').val(searchA(lgas, 'lga', $('#lganame').val()));  select_data_for_data(all_WARD, 'lga_id','id', 'lga_selected_id', 'ward_container','ward',null,1 );})() ;" class="form-control" placeholder="Select User LGA" required="">
            <span class="close" onclick="(function(){$('#ward_container').html('');clearFunc('lganame','lga_selected_id', 'wardname','ward_selected')})()">&times</span>
            <!-- main data to pass to DB or wherever -->
			<input type="hidden"  name="lga_selected_name" id="lga_selected_id" class="form-control">
			<!-- list -->
            <datalist id="lga">                                      
                @foreach($lgas as $lga)
                    <option value="{{ $lga->lga }}">
                @endforeach
            </datalist>                         
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="form-group">
         <label for="surname">User Ward<span class="asterik asterik_surname">*</span> </label>
            <input list="ward_container" name="wardname" id="wardname" class="form-control" placeholder="Select User role" required="" onchange="(function(){$('#ward_selected').val(searchA(all_WARD, 'ward', $('#wardname').val())); select_data_for_data(all_PROVIDER, 'hcpward','id', 'ward_selected', 'provider_container','hcpname',null,1 );})()">
            <span class="close" onclick="(function(){clearFunc('wardname','ward_selected','providername','provider_selected');})()">&times</span> 
            <!-- main data to pass to DB or wherever -->                                
            <input type="hidden" name="ward_selected_name" id="ward_selected" class="form-control">
            <datalist id="ward_container">                                    
                            
            </datalist>                                         
        </div>
    </div>	

<!-- this will be hidden in some cases -->
    <div class="col-md-6 col-lg-6" style="display: none;" id="providerMain">
        <div class="form-group">
         <label for="surname">Provider<span class="asterik asterik_surname">*</span> </label>
            <input list="provider_container" name="providername" id="providername" class="form-control" placeholder="Select User role" required="" onchange="(function(){$('#provider_selected').val(searchA(all_PROVIDER, 'role_name', $('#providername').val()));})()">
            <span class="close" onclick="(function(){clearFunc('providername','provider_selected');})()">&times</span> 
            <!-- main data to pass to DB or wherever -->                                
            <input type="hidden" name="provider_selected_name" id="provider_selected" class="form-control">
            <datalist id="provider_container">                                    
                            
            </datalist>                                         
        </div>
    </div>  