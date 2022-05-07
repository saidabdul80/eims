<div class="w3-card" style="padding:20px">

    <div id="features" class=" ">
        <div class="container-fluid">
           


            <hr />
            <p><a href="<?php echo e(route('manage_providers')); ?>"><i class="fa fa-arrow-left"></i> Back to Manage Providers</a></p>
            <div>
                <p>
                    <center><img src="<?php echo e(asset('images/logo.png')); ?>" id="project_logo" width="60" height="60" /></center>
                </p>
                <h3 class="text-center text-danger">Niger State Contributory Health Scheme (Nicare) </h3>
                <h4 class="text-center"><span style="padding:4px;" class="b3-theme">Provider Information </span></h4><br />
            </div>

            <fieldset>
                <legend>Provider Code - <?php echo e($provider->hcpcode); ?></legend>
                <div class="table-responsive w3-card ">
                    <table class="table  table-striped" id="">
                        <tr>
                            <td>HCPNAME: <?php echo e($provider->hcpname); ?></td>
                            <td>HCPCATEGORY: <?php echo e($provider->hcpcategory); ?></td>
                        </tr>
                        <tr>

                            <td>HCPTYPE: <?php echo e($provider->hcptype); ?></td>
                            <td>HCPSTATUS: <?php echo e($provider->hcpstatus); ?></td>
                        </tr>
                    </table>
            </fieldset>
            <hr />
            <fieldset>
                <legend>Provider Contact </legend>
                <table class="table  table-striped" id="">
                    <tr>

                        <td>CONTACT PHONE NO.: <?php echo e($provider->hcpcontactphone); ?></td>
                        <td>CONTACT EMAIL: <?php echo e($provider->hcpemailaddress); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">ADDRESS: <?php echo e($provider->hcpaddress); ?></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Provider BANK DETAILS </legend>
                <table class="table  table-striped" id="">
                    <tr>

                        <td>BANK NAME.:<?php echo e($provider->hcpBankName); ?> </td>
                        <td>ACCOUNT NAME: <?php echo e($provider->hcpBankAccountName); ?></td>
																</tr>
																<tr>
																		<td >ACCOUNT NUMBER: <?php echo e($provider->hcpBankAccountNumber); ?></td>
                        <td>BANK SORT CODE: <?php echo e($provider->sortCode); ?></td>
																</tr>
															</table>
															</fieldset>
															<fieldset>
															<legend>Provider ENROLEE DETAILS </legend>
																 <table class="table  table-striped" id="">
																<tr>
																
																	<td>FORMAL ENROLEE.: <?php echo e($provider->hcpBankName); ?></td>
                        <td>INFORMAL ENROLEE: <?php echo e($provider->hcpBankAccountName); ?></td>
																</tr>
															</table>
															</fieldset>
											<hr class="hr1">

										</div><!-- end container -->
									</div><!-- end section -->
												
								
								</div>
							</div><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/providers/_provider_view.blade.php ENDPATH**/ ?>