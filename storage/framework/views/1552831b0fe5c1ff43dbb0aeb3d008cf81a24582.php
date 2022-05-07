
<!DOCTYPE html>
<html lang="en">

       <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>.::NiCare Portal</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="apple-touch-icon" href="images/logo.png">

    <!-- Bootstrap CSS -->
    
     
     <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles2.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>


</head>
<body>

    <div class="parallax section noover" data-stellar-background-ratio="0.7" style="background-image:url('images/parallax_05.png');margin:0">
        <div class="container" >

            <div class="row">
                <div class="col-md-8">
					<div class="scheme-home-text-wrap">

						<p class=""><img src="images/logos/logo.png" width="180" height="80" alt="logo"/></p>
						<h2 style="color:#67b1e6"><strong> Enrollee Information Management System (<span>EIMS</span>)</strong></h2>
						<div>  </div>
						<hr/>
						<div class="hidden-sm hidden-xs">
							<div class="about-system">
								This is the online/web version of the Enrollee Enrolment System (EES) of Tonic Insurance Solutions (TiS) deployed for the administration of Niger State Contributory Health Scheme (NiCare) to residents of Niger State by the Niger State Contributory Agency (NGSCHA)'							</div>
							<br/>
						</div>
						<br/>


					</div>
                </div><!-- end col -->
				<div class="col-md-4">
                    <div class="text-center image-center ">
						
	<h2 class="app-header-radius">SIGN IN</h2>
		
	<div class="w3-card w3-white" style="padding:20px">
		
    <form action="<?php echo e(url('post-login')); ?>" method="POST" id="logForm">
			<?php echo e(csrf_field()); ?>

			<fieldset class="row-fluid">
			<p class="text-center" style="color:skyblue;font-weight:bolder">NiCare  Portal</p>
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2><input type="text"  name="nicare_code" id="nicare_code" value="<?php echo e(old('nicare_code')); ?>" class="form-control" placeholder="User ID" autocomplete="off" required /></h2>
				</div>
				<hr/>
				<hr/>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 style="margin-top:10px"><input type="password"  name="password" id="password" value="<?php echo e(old('password')); ?>" class="form-control" placeholder="Password" autocomplete="off" required/></h2>
				</div>
				<hr/>
				<hr/>
					<div>
											</div>
				<hr/>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right">
				<h2 style="margin-top:10px">	<button type="submit" name="login-button" id="submit" class="btn btn-light btn-radius btn-brd grd1 ">LOGIN</button></h2>
				</div>
			</fieldset>
            <?php if($errors->any()): ?>
                <hr/>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-danger">
                        <?php echo e($err); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if(session()->exists('error')): ?>
                <hr/>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
            <?php endif; ?>
			<p class="" style="color:skyblue;"><a href="forget.password.php">Forget Password?</a></p>
		</form>
		
	 </div>
                                        </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->






    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-left">                   
                    <p class="footer-company-name">All Rights Reserved. &copy; 2020 <a href="#">NiCare</a> Design By : 
					<!--<a href="https://html.design/">Tonic Insurance Scheme</a></p>-->
					<a href="http://ihsanmulticoncept.org.ng" target = 'blank'>Ihsan Multi-Concept Nig. Ltd</a></p>
                </div>

                
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
    <script src="js/portfolio.js"></script>
    <script src="js/hoverdir.js"></script>  	

</body>
</html>
<?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/index.blade.php ENDPATH**/ ?>