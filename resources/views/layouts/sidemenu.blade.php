<br/>

<br/>

<br/>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">



<div class="panel panel-00">

<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse00" aria-expanded="false" aria-controls="collapse00">

        <div class="panel-heading mySideTab" role="tab" id="heading00" >

            <h4 class="panel-title">Dashboard  <i id="chevron_00" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

        </div>

    </a>

	<div id="collapse00" class="panel-collapse collapse" role="tabpane00" aria-labelledby="heading00">

				  <div class="panel-body">

						

							<ul>

									<li class=""> <a href="{{route('eims.home')}}" ><i class="fa fa-chevron-right"></i> Home </a></li>

									<li class=""> <a href="{{route('dashboards.general_dashboard')}}" ><i class="fa fa-chevron-right"></i> General Dashboard </a></li>

                              

							</ul>



					</div>

			</div>

</div>



<?php



 $user_data = session()->get('user_data');

         $user_id = $user_data->id;

?>

@if(session()->has('user_menus'))

	<div class="panel panel-1">

        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">

       		<div class="panel-heading mySideTab" role="tab" id="heading1" >

            	<h4 class="panel-title">Enrolment<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

            </div>

        </a>            

		<div id="collapse1" class="panel-collapse collapse" role="tabpane1" aria-labelledby="heading1">

		  <div class="panel-body">

						

				<ul>

						<li class=""> <a href="{{route('enrolment.all')}}" ><i class="fa fa-chevron-right"></i> All Enrollees </a></li>

						<li class=""> <a href="{{route('enrolment.idcard-by-provider')}}" ><i class="fa fa-chevron-right"></i> ID Card by Provider </a></li>

						<li class=""> <a href="{{route('enrolment.enrolment-approval')}}" ><i class="fa fa-chevron-right"></i> Enrolment Approval </a></li>

						<li class=""> <a href="{{route('enrolment.enrolment-slip-print')}}" ><i class="fa fa-chevron-right"></i> Bulk Enrolment Slip </a></li>

						<li class=""> <a href="{{route('enrolment.enrollees-by-provider')}}" ><i class="fa fa-chevron-right"></i> Enrollees By LGA | Ward & Provider </a></li>
						<li class=""> <a href="{{route('enrolment.bhcpf-enrollees')}}" ><i class="fa fa-chevron-right"></i> BHCPF Enrollees  </a></li>

						

                  

				</ul>

			</div>

		</div>

          

	</div>

		@if($user_id != 1 )

	<div class="panel panel-1">

        <a class="collapsed" href="{{route('manage_providers')}}">

       		<div class="panel-heading mySideTab" role="tab" id="heading1" >

            	<h4 class="panel-title">Manage Providers<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

            </div>

        </a>            	

	</div>

	@endif



	

	    	<div class="panel panel-1">

        <a class="collapsed" href="{{route('manage_users')}}">

       		<div class="panel-heading mySideTab" role="tab" id="heading1" >

            	<h4 class="panel-title">Manage Users<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

            </div>

        </a>            	

	</div>

	<div class="panel panel-1">

        <a class="collapsed" href="{{route('manage_providers')}}">

       		<div class="panel-heading mySideTab" role="tab" id="heading1" >

            	<h4 class="panel-title">Manage Providers<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

            </div>

        </a>            	

	</div>

	<div class="panel panel-2">

        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">

                <div class="panel-heading mySideTab" role="tab" id="heading2" >

                    <h4 class="panel-title">Capitation<i id="chevron_2" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

                </div>

            </a>

            <div id="collapse2" class="panel-collapse collapse" role="tabpane2" aria-labelledby="heading2">

				  <div class="panel-body">

						

							<ul>

									<li class=""> <a href="{{route('capitation.generate-capitation')}}" ><i class="fa fa-chevron-right"></i> Generate Capitation </a></li>

									<li class=""> <a href="{{route('capitation.approve-capitation')}}" ><i class="fa fa-chevron-right"></i> Approve Capitation </a></li>

									<li class=""> <a href="{{route('capitation.capitation-payment')}}" ><i class="fa fa-chevron-right"></i> Capitation Payment </a></li>

                             </ul>

					</div>

			</div>

          </div>


		  <div class="panel panel-premium">

        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsepremium" aria-expanded="false" aria-controls="collapsepremium">

                <div class="panel-heading mySideTab" role="tab" id="headingpremium" >

                    <h4 class="panel-title">Premium<i id="chevron_premium" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

                </div>

            </a>

            <div id="collapsepremium" class="panel-collapse collapse" role="tabpanepremium" aria-labelledby="headingpremium">

				  <div class="panel-body">

						

							<ul>

									<li class=""> <a href="{{route('premium.reports')}}" ><i class="fa fa-chevron-right"></i> Expiration Reports  </a></li>

                             </ul>

					</div>

			</div>

          </div>

		<div class="panel panel-3">

        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">

                <div class="panel-heading mySideTab" role="tab" id="heading3" >

                    <h4 class="panel-title">Settings<i id="chevron_3" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

                </div>

            </a>

            <div id="collapse3" class="panel-collapse collapse" role="tabpane2" aria-labelledby="heading3">

				  <div class="panel-body">

						

							<ul>

									<li class=""> <a href="{{route('settings.configure-bed')}}" ><i class="fa fa-chevron-right"></i> BED Configurations </a></li>

                             </ul>

					</div>

			</div>

          </div>





		  <div class="panel panel-12">

<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse12" aria-expanded="false" aria-controls="collapse12">

	<div class="panel-heading mySideTab" role="tab" id="heading1" >

		<h4 class="panel-title">Manage Institution<i id="chevron_1" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

	</div>

</a>            

<div id="collapse12" class="panel-collapse collapse" role="tabpane12" aria-labelledby="heading1">

<div class="panel-body">							

		<ul>

				<li class=""> <a href="{{route('mgt_institution')}}" ><i class="fa fa-chevron-right"></i>Institution & Student Management </a></li>
				
				<li class=""> <a href="{{route('assign_tpa')}}" ><i class="fa fa-chevron-right"></i>Assign Tpa </a></li>
				<li class=""> <a href="{{route('pToI')}}" ><i class="fa fa-chevron-right"></i> Provider to Institution</a></li>
				<li class=""> <a href="{{route('session')}}" ><i class="fa fa-chevron-right"></i> Manage Session</a></li>
		
		</ul>

	</div>

</div>

</div>

	<div class="panel panel-11">

        <a class="collapsed" d href="{{route('logout')}}" aria-expanded="false" aria-controls="collapse1">

       		<div class="panel-heading mySideTab" role="tab" id="heading11" >

            	<h4 class="panel-title">Logout<i id="chevron_11" style="float:right;margin-right:10px" class="fa fa-chevron-right"></i></h4>

            </div>

        </a>            	        

	</div>



   

@else 

   <h1>Hello</h1>

@endif

	



</div>





