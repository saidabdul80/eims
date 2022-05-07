<div class="panel">
	<div class="panel-title">
		Summary Report
	</div>
	<div class="panel-body">


		<!---- SIDE SUMMARIES--->
		        
		        
		        @if($data['expired_premium_count'] > 0 || $data['expired_premium_count_this_month'] > 0 || $data['expired_premium_count_next_month'] > 0)
		            
		              		<hr>
		<div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Premium Expiration</div>
		<hr>
		        @if($data['expired_premium_count'] > 0)
		                	<div class="bg-white border my-2">
			
                			<div class="row p-3" style="font-size:8px;color:red;font-weight:bolder">
                				<div class="col-lg-12">
                					<span class=" mt-2 text-size-1">Expired:</span>
                					<span class=" text-size-1" style="font-size:12px; float:right;color:red;font-weight:bolder"><strong id=""> {{$data['expired_premium_count'] }}</strong></span>
                				</div>
                			</div>
                		</div>
		        @endif
		        
		         @if($data['expired_premium_count_this_month'] > 0)
		                	<div class="bg-white border my-2">
			
                			<div class="row p-3" style="font-size:8px;color:red;font-weight:bolder">
                				<div class="col-lg-12">
                					<span class=" mt-2 text-size-1">To Expire This Month:</span>
                					<span class=" text-size-1" style="font-size:12px; float:right;color:red;font-weight:bolder"><strong id=""> {{$data['expired_premium_count_this_month'] }}</strong></span>
                				</div>
                			</div>
                		</div>
		        @endif
		        
		        
		         @if($data['expired_premium_count_next_month'] > 0)
		                	<div class="bg-white border my-2">
			
                			<div class="row p-3" style="font-size:8px">
                				<div class="col-lg-12">
                					<span class=" mt-2 text-size-1">To Expire Next Month:</span>
                					<span class=" text-size-1" style="font-size:12px; float:right"><strong id=""> {{$data['expired_premium_count_next_month'] }}</strong></span>
                				</div>
                			</div>
                		</div>
		        @endif
		        
		        @endif
		  
		
		
		        
				<hr>
		<div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Encounter Report</div>
		<hr>
		<div class="bg-white border my-2">
		
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-12">
					<span class=" mt-2 text-size-1">Today:</span>
					<span class=" text-size-1" style="font-size:12px; float:right"><strong id="">{{$data['encounter_arr']['nicare_encounter_today']}}</strong></span>
				</div>
			</div>
		</div>
		<div class="bg-white border my-2">
			
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-12">
					<span class=" mt-2 text-size-1">This Month:</span>
					<span class=" text-size-1" style="font-size:12px; float:right"><strong id=""> {{$data['encounter_arr']['nicare_encounter_this_month']}}</strong></span>
				</div>
			</div>
		</div>
		<div class="bg-white border my-2">
			
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-12">
					<span class=" mt-2 text-size-1">This Year:</span>
					<span class=" text-size-1" style="font-size:12px; float:right"><strong id=""> {{$data['encounter_arr']['nicare_encounter_this_year']}}</strong></span>
				</div>
			</div>
		</div>
		
		
		<hr>
		<div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Enrollees Category</div>
		<hr>
		<div class="bg-white border my-2">
		
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-12">
					<span class=" mt-2 text-size-1">Informal:</span>
					<span class=" text-size-1" style="font-size:12px; float:right"><strong id="">{{
										number_format(isset($data['nicare-type-count'][0] ) ? $data['nicare-type-count'][0]->informal_enrolee : 0)
									}}</strong></span>
				</div>
			</div>
		</div>
		<div class="bg-white border my-2">
			
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-12">
					<span class=" mt-2 text-size-1">Formal:</span>
					<span class=" text-size-1" style="font-size:12px; float:right"><strong id="">{{
										  number_format(isset($data['nicare-type-count'][1] ) ? $data['nicare-type-count'][1]->formal_enrolee : 0)
									  }}</strong></span>
				</div>
			</div>
		</div>
		
	

		<hr>
		<div class="bg-primary text-white d-flex justify-between p-13 d-title " style="font-size:14px;color:#fff">Enrollees by Gender</div>
		<hr>

		<div class="bg-white border my-2">
		

			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1">Total Male:</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="">{{ number_format($data['nicare-bhcpf-sex-count'][0]->sex == 'Male'  
									 ? $data['nicare-bhcpf-sex-count'][0]->total 
									 : $data['nicare-bhcpf-sex-count'][1]->total )}}</strong></div>
				</div>
			</div>
		</div>

		<div class="bg-white border my-2">
			
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1">Total Female:</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="">{{ number_format($data['nicare-bhcpf-sex-count'][0]->sex == 'Female'  
									 ? $data['nicare-bhcpf-sex-count'][0]->total 
									 : $data['nicare-bhcpf-sex-count'][1]->total )}}</strong></div>
				</div>
			</div>
		</div>

		<br>

		<div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Enrollee By LGA:</div>
		<hr>
		@foreach($data['enrollees-by-lga'] as $enrollee_lga)
		@if($enrollee_lga->scheme == 'Premium')
		<div class="bg-white border my-2">
		
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1"> {{$enrollee_lga->lga}}</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="dropped_cals"> {{$enrollee_lga->total}}</strong></div>
				</div>
			</div>
		</div>



		@endif
		@endforeach

		<br>

		<div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Others</div>
		<hr>
		<div class="bg-white border my-2">
			
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1">Total TPA:</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="dropped_cals">0</strong></div>
				</div>
			</div>
		</div>

		<div class="bg-white border my-2">
		
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1">Total EOs:</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="call_on_queue">0</strong></div>
				</div>
			</div>
		</div>
		<div class="bg-white border my-2">
		
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1">Total LGA:</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="call_on_queue">25</strong></div>
				</div>
			</div>
		</div>
		<div class="bg-white border my-2">
			
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1">Total Wards:</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="call_on_queue">274</strong></div>
				</div>
			</div>
		</div>
		<div class="bg-white border my-2">
			
			<div class="row p-3" style="font-size:8px">
				<div class="col-lg-9">
					<div class=" mt-2 text-size-1">Total Lots:</div>
				</div>
				<div class="col-lg-3">
					<div class=" mt-2 text-size-1 text-center"><strong id="call_on_queue">0</strong></div>
				</div>
			</div>
		</div>

		<br><br>


		<!---- SIDE SUMMARIES--->


	</div>
</div>