<?php





$icons = ['child', 'wheelchair-alt', 'heartbeat', 'plus-square', 'wheelchair-alt', 'wheelchair-alt', 'wheelchair-alt', 'wheelchair-alt', 'wheelchair-alt'];

$icons2 = ['blind', 'head-vr', 'child', 'wheelchair-alt'];

$total_bhcpf_enrollees = $data['nicare-bhcpf-count'][1]->total;

$none_disable_total = 0;

$disable_total = 0;





?>



<div class="viewer-plain" onclick="clickOUT()"></div>

<div class="row" style="width: 100%; padding: 0px; margin: 0px;">

	<div class="col-md-3" style="padding: 0px;">

		<div class="just-center twoData">

			<img src="<?php echo e(asset('/images/FC_Loader.gif')); ?>" width="40%">

		</div>

		<!-- top -->

		<div class="borderb " rel="huweChart" style="display: flex;width: 100%;justify-content: center; border-bottom:5px solid #075c8a" data-aos="zoom-in-right">



			<div style="padding: 10px;">

				<div class="d-title"><span class="fa fa-user" style="color:#67b1e6;"></span> Total BHCPF Enrollees</div>

				<div class="d-body"><?php echo e(number_format($total_bhcpf_enrollees)); ?></div>

			</div>



		</div>

		<!-- top -->

	</div>

	<div class="col-md-3" style="padding: 0px;">

		<div class="just-center twoData">

			<img src="<?php echo e(asset('/images/FC_Loader.gif')); ?>" width="40%">

		</div>

		<!-- top -->

		<div class="borderb" onclick="location.href=''" rel="claimChart" style=" display: flex; width: 100%;justify-content: center;border-bottom:5px solid #08c" data-aos="zoom-in-left">



			<div style="padding: 10px;">

				<div class="d-title"><span class="fa fa-plus-square" style="color:#67b1e6;"></span> Total claims</div>

				<div class="d-body">0</div>

			</div>



		</div>

		<!-- top -->

	</div>

	<div class="col-md-3" style="padding: 0px;">

		<div class="just-center twoData">

			<img src="<?php echo e(asset('/images/FC_Loader.gif')); ?>" width="40%">

		</div>

		<!-- top -->

		<div class="borderb chartBtn" rel="capChart" style=" display: flex; width: 100%;justify-content:center; border-bottom:5px solid #db3b99" data-aos="zoom-in-left">



			<div style="padding: 10px;">

				<div class="d-title"><span class="fa fa-plus-square" style="color:#67b1e6;"></span> Total Cap.</div>

				<div class="d-body">&#8358;<?php echo e(number_format($months[intval(date('m'))]['bhcpf_cap'] )); ?></div>

			</div>



		</div>

		<!-- top -->

	</div>

	<div class="col-md-3" style="padding: 0px;">

		<div class="just-center twoData">

			<img src="<?php echo e(asset('/images/FC_Loader.gif')); ?>" width="40%">

		</div>

		<div class="borderb" rel="proChart" style=" display: flex; width: 100%;justify-content: center;border-bottom:5px solid #0aad72" data-aos="zoom-in-left">



			<div style="padding: 10px;">

				<div class="d-title"><span class="fa fa-plus-square" style="color:#67b1e6;"></span> Next Month Cap.</div>

				<div class="d-body">&#8358;<?php echo e(number_format($total_bhcpf_enrollees * 570)); ?></div>

			</div>



		</div>

	</div>

</div>

<div class="row" style="padding: 10px; margin:0px 10px auto auto">

	<!--//////////////////////////////////////// chart/////////////////////////////////////////// -->

	<div class="col-md-8">



		<div class="border-all chart" id="capChart" style="padding: 10px; width: 100%; height: 420px;">

			<div class="d-flex justify-between p-13 d-title">Total Capitation <span><span class="fa fa-area-chart text-danger"></span></span></div>

			<hr>



			<canvas id="myChart_bhcpf"></canvas>





			<script>

				var ctx = document.getElementById('myChart_bhcpf').getContext('2d');

				var chart = new Chart(ctx, {

					// The type of chart we want to create

					type: 'line',



					// The data for our dataset

					data: {

						labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

						datasets: [{

							label: 'Monthly Capitaions (<?= date('Y'); ?>)',

							backgroundColor: 'rgb(255, 99, 132)',

							borderColor: 'rgb(255, 99, 132)',

							data: [

								<?= $months[1]['bhcpf_cap']; ?>,

								<?= $months[2]['bhcpf_cap']; ?>,

								<?= $months[3]['bhcpf_cap']; ?>,

								<?= $months[4]['bhcpf_cap']; ?>,

								<?= $months[5]['bhcpf_cap']; ?>,

								<?= $months[6]['bhcpf_cap']; ?>,

								<?= $months[7]['bhcpf_cap']; ?>,

								<?= $months[8]['bhcpf_cap']; ?>,

								<?= $months[9]['bhcpf_cap']; ?>,

								<?= $months[10]['bhcpf_cap']; ?>,

								<?= $months[11]['bhcpf_cap']; ?>,

								<?= $months[12]['bhcpf_cap']; ?>,

							]

						}]

					},



					// Configuration options go here

					options: {}

				});

			</script>



		</div>

	</div>

	<!-- /////////////////////////////end chart/////////////////////////////// -->

	<div class="col-md-4" style="color: #075c8a; font-weight:bold">
        
        	<div class="bg-primary text-white p-13 d-title" style="color:#fff">Encounter Report<span><span class="fa fa-list text-info" style="color:#fff"></span></span></div>
        		<div class="bg-white border ">

			<div class="just-center twoData mt-3">

				<img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%">

			</div>

			<div style="width: 100%; height: 30px;" class="  d-flex pad ld-zoom-in" data-aos="fade-left">

				<div class="d-flex flex-column just-center-c  w-50">

					<span>Today:</span>

				</div>

				<div class=" mt-2 text-size-1"><?php echo e($data['encounter_arr']['bhcpf_encounter_today']); ?></div>

			</div>

		</div>
		
		<div class="bg-white border ">

			<div class="just-center twoData mt-3">

				<img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%">

			</div>

			<div style="width: 100%; height: 30px;" class="  d-flex pad ld-zoom-in" data-aos="fade-left">

				<div class="d-flex flex-column just-center-c  w-50">

					<span>This Month:</span>

				</div>

				<div class=" mt-2 text-size-1"><?php echo e($data['encounter_arr']['bhcpf_encounter_this_month']); ?></div>

			</div>

		</div>
		
		
		<div class="bg-white border ">

			<div class="just-center twoData mt-3">

				<img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%">

			</div>

			<div style="width: 100%; height: 30px;" class="  d-flex pad ld-zoom-in" data-aos="fade-left">

				<div class="d-flex flex-column just-center-c  w-50">

					<span>This Year:</span>

				</div>

				<div class=" mt-2 text-size-1"><?php echo e($data['encounter_arr']['bhcpf_encounter_this_year']); ?></div>

			</div>

		</div>
		
		
        	
		<hr>

		<div class="bg-primary text-white p-13 d-title" style="color:#fff">Vulnerability Category<span><span class="fa fa-list text-info" style="color:#fff"></span></span></div>

		<hr>



		<?php $__currentLoopData = $data['bhcpf-categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<div class="bg-white border my-2">

			<div class="just-center twoData mt-3">

				<img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%">

			</div>

			<div style="width: 100%; height: 40px;" class="  pad  d-flex ld-zoom-in" data-aos="fade-left">

				<div class="d-flex flex-column just-center-c  w-50">

					<span class="b-title"><?php echo e($category->category); ?>:</span>

					<span class="fa fa-<?php echo e($icons[$loop->index]); ?> ml-4 text-info" style="font-size:25px;"></span>

				</div>

				<div class=" mt-2 text-size-1"><?php echo e(number_format($category->total)); ?> <code><?php echo e(round( ($category->total*100)/$total_bhcpf_enrollees, 1)); ?>%</code></div>

			</div>

			<?php if($category->category == 'Female Reproductive (15-45 years)'): ?>

			<div class=" w-100 text-right" style="color:#3ac779;font-weight:bold">

				<span class="b-title">% of Pregnant Women : <?php echo e(number_format($data['bhcpf-pregnant-enrollee-count'])); ?> <code><?php echo e(round( ($data['bhcpf-pregnant-enrollee-count']*100)/$category->total, 1)); ?>%</code></span>

				<span class="fa fa-female}} ml-4 text-info" style="font-size:25px;"></span>

				<hr>

			</div>

			<div class=" w-100 text-right" style="color:#239656;font-weight:bold">

				<span class="b-title">% of Women Not Pregnant : <?php echo e(number_format($category->total - $data['bhcpf-pregnant-enrollee-count'])); ?> <code><?php echo e(round( (($category->total - $data['bhcpf-pregnant-enrollee-count'])*100)/$category->total, 1)); ?>%</code></span>

				<span class="fa fa-female}} ml-4 text-info" style="font-size:25px;"></span>

				<hr>

			</div>

			<?php endif; ?>

		</div>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<div class="d-flex justify-between p-13 d-title bg-primary text-white" style="color:#fff">Disability Group<span><span class="fa fa-list text-info text-white" style="color:#fff"></span></span></div>

		<hr>

		<?php $__currentLoopData = $data['bhcpf-disabilities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<?php if($group->disability != 'None' && !empty($group->disability)): ?>

		<?php

		$disable_total = $disable_total + $group->total;

		?>

		<div class="bg-white border my-2">

			<div class="just-center twoData mt-3">

				<img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%">

			</div>

			<div style="width: 100%; height: 40px;" class="  pad  d-flex ld-zoom-in" data-aos="fade-left">

				<div class="d-flex flex-column just-center-c  w-50">

					<span class="b-title"><?php echo e($group->disability); ?>:</span>

					<span class="fa fa-<?php echo e(isset($icons2[$loop->index]) ? $icons2[$loop->index] : ''); ?> ml-4 text-info" style="font-size:25px;"></span>

				</div>

				<div class=" mt-2 text-size-1"><?php echo e(number_format($group->total)); ?> </div>

			</div>

		</div>

		<?php else: ?>

		<?php

		$none_disable_total = $none_disable_total + $group->total;

		?>

		<?php endif; ?>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<h4>

			Overall % Disabled = <?php echo e($disable_total); ?> - <code><?php echo e((100 - round( ($none_disable_total*100)/$total_bhcpf_enrollees, 1))); ?>%</code> <br>

			Overall % None Disabled = <?php echo e(number_format($none_disable_total)); ?> - <code><?php echo e(round( ($none_disable_total*100)/$total_bhcpf_enrollees, 1)); ?>%</code>

		</h4>

		<div class="d-flex justify-between p-13 d-title bg-primary text-white" style="color:#fff">Enrollee By Sex Group<span><span class="fa fa-list text-info text-white" style="color:#fff"></span></span></div>

		<div class="bg-white border ">

			<div class="just-center twoData mt-3">

				<img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%">

			</div>

			<div style="width: 100%; height: 40px;" class="  d-flex pad ld-zoom-in" data-aos="fade-left">

				<div class="d-flex flex-column just-center-c  w-50">

					<span>Total Male:</span>

					<span class="fa fa-male ml-4" style="font-size:25px;"></span>

				</div>

				<div class=" mt-2 text-size-1"><?php echo e(number_format($data['nicare-bhcpf-sex-count'][2]->sex == 'Male'  

									 ? $data['nicare-bhcpf-sex-count'][2]->total 

									 : $data['nicare-bhcpf-sex-count'][3]->total )); ?></div>

			</div>

		</div>

		<div class="bg-white border my-2">

			<div class="just-center twoData mt-3">

				<img src="<?php echo e(asset('/images/point_Loader.gif')); ?>" width="20%">

			</div>

			<div style="width: 100%; height: 40px;" class="   d-flex pad  ld-zoom-in" data-aos="fade-left">

				<div class="d-flex flex-column just-center-c  w-50">

					<span>Total Female:</span>

					<span class="fa fa-female ml-4 text-primary" style="font-size:25px;"></span>

				</div>

				<div class=" mt-2 text-size-1"><?php echo e(number_format($data['nicare-bhcpf-sex-count'][2]->sex == 'Female'  

									 ? $data['nicare-bhcpf-sex-count'][2]->total 

									 : $data['nicare-bhcpf-sex-count'][3]->total )); ?></div>

			</div>

		</div>

	</div>

</div>

<br>

<br>

<br>

<br>

<div class="row">

	<div class="col-md-12">



		<div class="col-md-12">



			<div class="border-all chart" id="capChart" style="padding: 10px; width: 100%;">

				<div class="d-flex justify-between p-13 d-title">

					<span id="lgaChartCover1" class="chartState">Total Enrollee By lga</span>

					<span id="zoneChartCover1" class="chartState" style="display: none;">Total Enrollee By Zone</span>

					<ul class="nav nav-tabs">

						<li class="active chartTabs" id="btN2" onclick="switchBtn('zoneChartCover','#btN2')"><a href="#zoneChartCover">Zone</a></li>

						<li class="chartTabs" id="btN1" onclick="switchBtn('lgaChartCover','#btN1')"><a href="#lgaChartCover">lga</a></li>



					</ul>

					<span class="fa fa-area-chart text-danger"></span>

				</div>

				<hr>

				<div style="width: 100%;display: none;" id="lgaChartCover" class="chartState">

					<canvas id="lgaChart" width="100%" height="70%"></canvas>

					<hr>

					<script>

						var lga_names_bhcpf = <?php echo json_encode($lga_names_bhcpf); ?>;

						var lga_count_bhcpf = <?php echo json_encode($lga_count_bhcpf); ?>;

						var lgas = <?php echo json_encode($lgas); ?>;



						var current_lga_id = 0;

						var current_ward_id = 0;

						var activeChart;









						var ctx11 = document.getElementById('lgaChart').getContext('2d');

						var lgaChart = new Chart(ctx11, {

							type: 'bar',

							data: {

								labels: lga_names_bhcpf,

								datasets: [{

									label: 'Enrollee By LGA ',

									data: lga_count_bhcpf,

									backgroundColor: [

										'rgba(255, 99, 132, 0.2)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)',

										'rgba(75, 192, 192, 0.2)',

										'rgba(153, 102, 255, 0.2)',

										'rgba(255, 159, 64, 0.2)',

										'rgba(255, 99, 132, 0.2)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)',

										'rgba(75, 192, 192, 0.2)',

										'rgba(153, 102, 255, 0.2)',

										'rgba(255, 159, 64, 0.2)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)',

										'rgba(75, 192, 192, 0.2)',

										'rgba(153, 102, 255, 0.2)',

										'rgba(255, 159, 64, 0.2)',

										'rgba(255, 99, 132, 0.2)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)',

										'rgba(75, 192, 192, 0.2)',

										'rgba(153, 102, 255, 0.2)',

										'rgba(255, 159, 64, 0.2)',

										'rgba(255, 99, 132, 0.2)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)'





									],

									borderColor: [

										'rgba(255, 99, 132, 1)',

										'rgba(54, 162, 235, 1)',

										'rgba(255, 206, 86, 1)',

										'rgba(75, 192, 192, 1)',

										'rgba(153, 102, 255, 1)',

										'rgba(255, 159, 64, 1)',

										'rgba(255, 99, 132, 1)',

										'rgba(54, 162, 235, 1)',

										'rgba(255, 206, 86, 1)',

										'rgba(75, 192, 192, 1)',

										'rgba(153, 102, 255, 1)',

										'rgba(255, 159, 64, 1)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)',

										'rgba(75, 192, 192, 0.2)',

										'rgba(153, 102, 255, 0.2)',

										'rgba(255, 159, 64, 0.2)',

										'rgba(255, 99, 132, 0.2)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)',

										'rgba(54, 162, 235, 0.2)',

										'rgba(255, 206, 86, 0.2)',

										'rgba(75, 192, 192, 0.2)',

										'rgba(153, 102, 255, 0.2)',

										'rgba(255, 159, 64, 0.2)'

									],

									borderWidth: 1

								}]

							},

							options: {

								scales: {

									yAxes: [{

										ticks: {

											beginAtZero: true

										}

									}]

								},

								onClick: function(event) {

									var activePoints = lgaChart.getElementsAtEvent(event);

									var lga_label = activePoints[0]._view.label;

									getLgaId(lga_label);



								}

							}

						});



						var enrollees_by_ward = <?php echo json_encode($data['enrollees-by-ward']); ?>;

						var enrollees_by_providers = <?php echo json_encode($data['enrollees-by-provider']); ?>;













						function getLgaId(name) {

						// let current_lga_id = 0;



							Object.entries(lgas).forEach(element => {

								if (element[1].name == name) {

									current_lga_id = element[1].id

								}

							});



							$('#modal-content2').html('');

							$('#myModal').modal('show');

							$('#modal-content2').html(' <h3 id="ward_modal_heading" class="text-center"></h3> <canvas id="wardChart_" width="80%" height="70%"></canvas><p id="modal_loading"></p>')

							$('#ward_modal_heading').html(name + ' ENROLLEES BY WARD');

							$('#modal_loading').html('Loading, Please wait...')

							let obj = get_label_name_and_count(current_lga_id);



							$('#modal_loading').html('')



							var ctxWard = document.getElementById('wardChart_').getContext('2d');

							var warChart = new Chart(ctxWard, {

								type: 'horizontalBar',

								data: {

									labels: obj.labels,

									datasets: [{

										label: '#',

										data: obj.counts,

										backgroundColor: [

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)'





										],

										borderColor: [

											'rgba(255, 99, 132, 1)',

											'rgba(54, 162, 235, 1)',

											'rgba(255, 206, 86, 1)',

											'rgba(75, 192, 192, 1)',

											'rgba(153, 102, 255, 1)',

											'rgba(255, 159, 64, 1)',

											'rgba(255, 99, 132, 1)',

											'rgba(54, 162, 235, 1)',

											'rgba(255, 206, 86, 1)',

											'rgba(75, 192, 192, 1)',

											'rgba(153, 102, 255, 1)',

											'rgba(255, 159, 64, 1)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)'

										],

										borderWidth: 1

									}]

								},

								options: {

									scales: {

										yAxes: [{

											ticks: {

												beginAtZero: true

											}

										}]

									},

									onClick: function() {

										var activePoints = warChart.getElementsAtEvent(event);

										var ward_label = activePoints[0]._view.label;

										getWardId(ward_label);

									}

								}

							});

						}













						function get_label_name_and_count(search_id) {

							let labels = [];

							let counts = [];

							enrollees_by_ward.forEach(element => {

								if (element.lga_id == search_id) {

									labels.push(element.ward)

									counts.push(element.total)

								}

							});



							return {

								labels: labels,

								counts: counts

							}

						}





						function getWardId(name) {

						

								let current_ward_id = 0;

							enrollees_by_ward.forEach(element => {



								if (element.ward == name && element.lga_id == current_lga_id) {

									current_ward_id = element.id

									///return current_ward_id;

								}

							});





							$('#modal-content').html('');

							$('#myModal_').modal('show');

							$('#modal-content').html(' <h3 id="provider_modal_heading" class="text-center"></h3> <canvas id="providerChart_" width="80%" height="70%"></canvas><p id="modal_loading_"></p>')

							$('#provider_modal_heading').html(name + ' ENROLLEES BY Provider');

							$('#modal_loading_').html('Loading, Please wait...')



							let obj = get_label_name_and_count2(current_ward_id);

						



							$('#modal_loading_').html('')

							//make_chart(obj, 'horizontalBar', 'providerChart_', null)



							var ctxProvider = document.getElementById('providerChart_').getContext('2d');

							var providerChart = new Chart(ctxProvider, {

								type: 'bar',

								data: {

									labels: obj.labels,

									datasets: [{

										label: '#',

										data: obj.counts,

										backgroundColor: [

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)'





										],

										borderColor: [

											'rgba(255, 99, 132, 1)',

											'rgba(54, 162, 235, 1)',

											'rgba(255, 206, 86, 1)',

											'rgba(75, 192, 192, 1)',

											'rgba(153, 102, 255, 1)',

											'rgba(255, 159, 64, 1)',

											'rgba(255, 99, 132, 1)',

											'rgba(54, 162, 235, 1)',

											'rgba(255, 206, 86, 1)',

											'rgba(75, 192, 192, 1)',

											'rgba(153, 102, 255, 1)',

											'rgba(255, 159, 64, 1)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)',

											'rgba(255, 99, 132, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(54, 162, 235, 0.2)',

											'rgba(255, 206, 86, 0.2)',

											'rgba(75, 192, 192, 0.2)',

											'rgba(153, 102, 255, 0.2)',

											'rgba(255, 159, 64, 0.2)'

										],

										borderWidth: 1

									}]

								},

								options: {

									scales: {

										yAxes: [{

											ticks: {

												beginAtZero: true

											}

										}]

									},

									onClick: function() {

										alert('Hello! NiCare')

									}

								}

							});

						}











						function get_label_name_and_count2(search_id) {

							let labels = [];

							let counts = [];

							enrollees_by_providers.forEach(element => {

								if (element.ward_id == search_id) {

									labels.push(element.provider)

									counts.push(element.total)

								}

							});



							return {

								labels: labels,

								counts: counts

							}

						}





						function make_chart(obj, chart_type, container, clickEvent) {



						}

					</script>



				</div>

				<div style="width: 100%;text-align:center !important" class="chartState" id="zoneChartCover">

					<div class="text-center"><canvas id="zoneChart"></canvas></div>

					<script>

						var ctx = document.getElementById('zoneChart').getContext('2d');

						var chart = new Chart(ctx, {

							//The type of chart we want to create

							type: 'pie',



							//The data for our dataset

							data: {

								labels: ['Zone A', 'Zone B', 'Zone C'],

								datasets: [{

									label: 'Enroollees by Zones',

									backgroundColor: ["rgb(255, 99, 132)", "#08c", ],

									data: [<?= $data['bhcpf-zone-count'][0]->total; ?>, <?= $data['bhcpf-zone-count'][1]->total; ?>, <?= $data['bhcpf-zone-count'][2]->total; ?>]





								}]

							},



							//Configuration options go here

							options: {
								responsive: false
							}

						});

					</script>

				</div>

			</div>

		</div>

	</div>

</div>

</div>

<div style="width: 100%; position: fixed;top: 0; left: 0; height: 100vh; background: rgba(0,0,0,.2); display: flex;flex-wrap: center; justify-content: center;display: none;z-index: " id="searching">

	<!-- <img src="<?php echo e(asset('/images/FC_Loader.gif')); ?>" width="40%"> -->

</div>





<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-lg">

		<div class="modal-content" style="height: 75%px; overflow:auto;">

			<div class="modal-body" id="modal-content2">

				<h3 id="ward_modal_heading" class="text-center"></h3>

				<canvas id="wardChart_" width="80%" height="70%"></canvas>

				<p id="modal_loading"></p>

			</div>

			<div class="modal-footer" id="modal-footer2">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>

		</div>

	</div>

</div>





<!-- Modal -->

<div class="modal fade" id="myModal_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<div class="modal-body" id="modal-content">

				<h3 id="provider_modal_heading" class="text-center"></h3>

				<canvas id="providerChart_" width="80%" height="70%"></canvas>

				<p id="modal_loading_"></p>

			</div>

			<div class="modal-footer" id="modal-footer2">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>

		</div>

	</div>

</div>







<br><br><br>

<style>

	.d-title {

		text-align: center;

		font-size: 14px;

		text-transform: capitalize;

		font-weight: bold;

		color: #6781a6;



	}



	.d-body {

		font-family: 'Roboto', sans-serif;

		text-align: center;

		font-size: 30px;

		-webkit-transition: color 1s;

		/* Safari */

		transition: color 1s;

		color: #6781a6;

		font-weight: bolder;



	}



	.pad {

		cursor: pointer;

		padding: 5px 9px;

	}



	.pad:hover {

		box-shadow: 1px 2px 5px #ccc;

	}



	.b-title {

		font-size: 0.8em;

		line-height: 16px;

		margin-bottom: 5px;

	}

</style>

<script type="text/javascript">

	var pad = $('.pad'),

		ddf, st;

	setTimeout(function() {

		pad.removeClass('ld');

	}, 2000);



	$('.pad').click(function() {

		$(this).addClass('viewer1 ld');

		$('.viewer-plain').show();

		$('.viewer-plain').fadeIn(500);

	});

	$('.viewer-plain').click(function() {

		$(this).fadeOut(500);

		pad.removeClass('ld viewer1');

	})



	$('.chartBtn').click(function() {

		var chart = $(this).attr('rel');

		$('.chart').hide();

		$('#' + chart).show();

	})



	function switchBtn(chart, id) {

		$('.chartState').hide();

		$('.chartTabs').removeClass('active');

		$('#' + chart).show();

		$('#' + chart + '1').show();

		$(id).addClass('active');

	}





	if ($(document).width() < 597) {

		$('#chart_cap').attr('height', '70%');

	}

	if ($(document).width() <= 923 && $(document).width() > 597) {

		$('#chart_cap').attr('height', '50%');

	}

</script>

</script><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/huweDashboard.blade.php ENDPATH**/ ?>