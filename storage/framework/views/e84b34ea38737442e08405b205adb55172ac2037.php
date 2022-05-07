<div class="panel">
                    <div class="panel-title">
                        Summary Report
                    </div>
                    <div class="panel-body">
            

                <!---- SIDE SUMMARIES--->
                <hr>
                        <div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Enrollees Category</div>
                                <hr>
                        <div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
                            <div class="row p-3" style="font-size:8px">
								<div class="col-lg-12" >
									  <span class=" mt-2 text-size-1" >Informal:</span>
									<span class=" text-size-1" style="font-size:12px; float:right"><strong id=""><?php echo e(number_format($informal_enrollees)); ?></strong></span>
								</div>
                             </div>
                        </div>
                        <div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							  <div class="row p-3" style="font-size:8px">
								<div class="col-lg-12" >
									 <span class=" mt-2 text-size-1" >Formal:</span>
                                      <span class=" text-size-1" style="font-size:12px; float:right"><strong id=""><?php echo e(number_format($formal_enrollees)); ?></strong></span>
								</div>
                             </div>
                        </div>
                       
						 <hr>
                        <div class="bg-primary text-white d-flex justify-between p-13 d-title " style="font-size:14px;color:#fff">Enrollees by Gender</div>
						 <hr>
                       
                        <div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
                           
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Total Male:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id=""><?php echo e(number_format($formal_enrollees_male)); ?></strong></div>
								</div>
                             </div>	
                        </div>
						
						<div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Total Female:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id=""><?php echo e(number_format($formal_enrollees_female)); ?></strong></div>
								</div>
                             </div>	
                        </div>
                        
                        <br>
						
						 <div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Call Center</div>
                                <hr>
                        <div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Dropped Calls:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id="dropped_cals">0</strong></div>
								</div>
                             </div>	
                        </div>
						
						<div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Call on queue:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id="call_on_queue">0</strong></div>
								</div>
                             </div>	
                        </div>
						
						<br>
						
						 <div class=" bg-primary text-white p-13 d-title " style="font-size:14px;color:#fff">Others</div>
                                <hr>
                        <div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Total TPA:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id="dropped_cals">0</strong></div>
								</div>
                             </div>	
                        </div>
						
						<div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Total EOs:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id="call_on_queue">0</strong></div>
								</div>
                             </div>	
                        </div>
						<div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Total LGA:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id="call_on_queue">0</strong></div>
								</div>
                             </div>	
                        </div>
                        <div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Total Wards:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id="call_on_queue">0</strong></div>
								</div>
                             </div>	
                        </div>
                        <div class="bg-white border my-2">	
                            <div class="just-center twoData mt-3">
                                <img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%" >
                            </div>
							<div class="row p-3" style="font-size:8px">
								<div class="col-lg-9" >
									 <div class=" mt-2 text-size-1" >Total Lots:</div>
								</div>
								<div class="col-lg-3" >
									 <div class=" mt-2 text-size-1 text-center" ><strong id="call_on_queue">0</strong></div>
								</div>
                             </div>	
                        </div>

						<br><br>


                <!---- SIDE SUMMARIES--->


                </div>
                </div><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/nicare_dashboard_summary_reports.blade.php ENDPATH**/ ?>