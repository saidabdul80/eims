<?php
            QRcode::png($enrollee->enrolment_number, 'qrcode_image.png');
            ?>
            <div class="card" style="page-break-after: always; font-size:10px">
                <div class="preview" style="padding:20px 30px">
                    <div class="text-center">

                        <?php if($enrollee->mode_of_enrolment == 'Premium'): ?>
                        <img src="<?php echo e(env('FULL_APP_URL')); ?>apps/img/slip_heading.PNG" />
                        <?php else: ?>
                        <img src="<?php echo e(env('FULL_APP_URL')); ?>apps/img/huwe_slip_heading.png" />
                        <?php endif; ?>

                        <table style="color:#000" width="100%">

                            <tr>
                                <td class="">
                                    <p class="text-left" style="font-size: 12px">
                                        <img src="qrcode_image.png" />
                                        <br> NiCare Number.: <?php echo e($enrollee->enrolment_number); ?>

                                        <br> Date Enroled: <?php echo e($enrollee->enrol_date); ?>


                                        <?php if($enrollee->mode_of_enrolment == 'Premium'): ?>
                                        <br>NIN Number: <?php echo e($enrollee->nin); ?>

                                        <?php else: ?>

                                        <br> BHCPF Number: <?php echo e($enrollee->BHCPF_number); ?>

                                        <br> NIN Number: <?php echo e($enrollee->nin); ?>

                                        <br> Category: <?php echo e($enrollee->vulnerability_status); ?>

                                        <?php endif; ?>

                                    </p>
                                </td>

                                <td class="">
                                    <p class="text-right" style="text-align:right !important"><img src="https://ngscha.ni.gov.ng/apps/img_data/enrollees/<?php echo e($enrollee->id); ?>.jpg" style="float:right" width="120px" height="120px" alt="passport" /></p>

                                </td>
                            </tr>
                        </table>
                    </div>


                    <fieldset>



                        <table class="table  table-bordered " border="2" width="100%" id="" style="color:#000;font-size:10px" border="1">



                            <?php if($enrollee->mode_of_enrolment == 'Premium'): ?>
                            <tr>
                                <td colspan="4">
                                    <h5>Enrolment Number: <strong><?php echo e($enrollee->enrolment_number); ?></h5></strong>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <h5>Enrolment Number: <strong><?php echo e($enrollee->enrolment_number); ?></h5></strong>
                                </td>
                            </tr>

                            <?php endif; ?>
                            <tr>
                                <td>Surname:</td>
                                <td><?php echo e($enrollee->surname); ?></td>
                                <td>First Name:</td>
                                <td><?php echo e($enrollee->first_name); ?></td>
                            </tr>
                            <tr>

                                <td>Other Name:</td>
                                <td><?php echo e($enrollee->other_name); ?></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            <tr>

                                <td>Sex:</td>
                                <td><strong><?php echo e($enrollee->sex); ?></strong></td>
                                <td>Age:</td>
                                <td><?php echo e($enrollee->date_of_birth); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?php echo e($enrollee->email_address); ?></td>
                                <td>Phone Number:</td>
                                <td><?php echo e($enrollee->phone_number); ?></td>
                            </tr>
                            <tr>
                                <td>Marital Status:</td>
                                <td><?php echo e($enrollee->marital_status); ?></td>
                                <td>Occupation:</td>
                                <td><?php echo e($enrollee->occupation); ?></td>
                            </tr>
                            <tr>
                                <td>LGA :</td>
                                <td><?php echo e(lga_name($lgas,$enrollee->lga)); ?>

                                </td>
                                <td>Ward:</td>
                                <td><?php echo e(ward_name($wards,$enrollee->ward)); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Benefit Plan:</td>
                                <td><?php echo e($enrollee->benefit_plan); ?></td>
                                <td>Choice of Provider:</td>
                                <td><?php echo e(provider_name($providers,$enrollee->provider_id)); ?></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><?php echo e($enrollee->address); ?></td>
                                <td>Date Enroled:</td>
                                <td><?php echo e($enrollee->enrol_date); ?></td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <h5>National Identification Number (NIN): <?php echo e($enrollee->nin); ?></h5>
                                </td>
                            </tr>
                        </table>
                </div>
                </fieldset>

                <fieldset>
                    <div class="preview" style="padding:3px 30px">
                        <h4>Next of Kin (NOK)</h4>
                        <table class="table  table-bordered " border="2" width="100%" id="" style="color:#000;font-size:10px" border="1">
                            <tr>
                                <td>Name of Next of Kin:</td>
                                <td><?php echo e($enrollee->nok_name); ?></td>
                                <td>Next of Kin Phone Number:</td>
                                <td> <?php echo e($enrollee->nok_phone_number); ?></td>
                            </tr>
                            <tr>
                                <td>Relationship:</td>
                                <td colspan="3"><?php echo e($enrollee->nok_relationship); ?></td>
                            </tr>
                        </table>
                    </div>
                </fieldset>
            </div><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/enrolment/slip/slip_template.blade.php ENDPATH**/ ?>