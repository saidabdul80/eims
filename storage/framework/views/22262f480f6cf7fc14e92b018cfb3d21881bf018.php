<?php
$sn = 0;
?>


<?php $__env->startSection('breadcrumb','Manage Providers'); ?>
<?php $__env->startSection('content-body'); ?>
    
    <?php if(session()->exists('welcome')): ?>
        <hr/> <div class="alert alert-success"> <?php echo e(session('welcome')); ?> </div>
    <?php endif; ?>
    <div class="row bg-white" style="width: 100%; min-height: 500px; padding: 10px; margin: 0px;">      
	    <div class="row" style="margin:0; width: 100%;height: 93px;padding: 0px;">
			<div class="col-md-6 col-sm-6 col-xs-12" style="">
				<ul class="features-left shadow-1 pd-4 b-round" style="margin:0; height: 90px;">
					<li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
						<a href="sa.new_provider.php">
						<i class="fa fa-plus"></i>
						<div class="fl-inner">
		<!-- 					<h4>New User</h4> -->
							<p>Add New Provider </p>
						</div>
						</a>
					</li>

				</ul>
			</div>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<ul class="features-right shadow-1 pd-4 b-round" style="margin:0;height: 90px;">
					<li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
						<a href="#">
						<i class="fa fa-search"></i>
						<div class="fr-inner">
							<!-- <h4>Providers Overview </h4> -->
							<p><input type="text" class="form-control" placeholder="Search Provider"> </p>
						</div>
						</a>
					</li>


				</ul>
			</div><!-- end col -->
		</div>
	    <div>
	    	<table id="table_id" class="display dataTable no-footer" style="font-size: 12px; width: 911px;" role="grid" aria-describedby="table_id_info">
				<thead>
					<tr role="row">
						<td class="sorting_asc" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="SN: activate to sort column descending" style="width: 20px;">SN</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="HCPNAME: activate to sort column ascending" style="width: 140px;">HCPNAME</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="HCPCODE : activate to sort column ascending" style="width: 94px;">HCPCODE </td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="LGA: activate to sort column ascending" style="width: 67px;">LGA</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="WARD: activate to sort column ascending" style="width: 121px;">WARD</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="ENROLLEE: activate to sort column ascending" style="width: 154px;">ENROLLEE</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 63px;"></td>
					</tr>
				</thead>
				<tbody>

				<?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($loop->index + 1); ?></td>
						<td><?php echo e($provider->hcpname); ?></td>
						<td><?php echo e($provider->hcpcode); ?></td>
						<td><?php echo e($provider->lga); ?></td>
						<td><?php echo e($provider->ward); ?></td>
						<td></td>
						<td>
							<a href="<?php echo e(route('provider.view', [$provider->id] )); ?>" class="btn btn-sm btn-info"> <i class="fa fa-eye" style="color:aliceblue"></i></a>
							<a href="<?php echo e(route('provider.edit', [$provider->id] )); ?>" class="btn btn-sm btn-info"> <i class="fa fa-edit" style="color:aliceblue"></i></a>
						</td>
					</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
	    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/providers/manage_providers.blade.php ENDPATH**/ ?>