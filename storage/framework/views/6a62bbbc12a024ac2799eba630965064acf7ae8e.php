<!-- ALL JS FILES -->
 <script src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/all.js')); ?>"></script>
    
 
            

    <!-- ALL PLUGINS -->
    <script src="<?php echo e(asset('wow/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/portfolio.js')); ?>"></script>
    <script src="<?php echo e(asset('js/hoverdir.js')); ?>"></script>
     <!--<script type="text/javascript" src="js/actions.js"></script>-->
     <script src="<?php echo e(asset('js/datatable.js')); ?>"></script>
   <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('js/ees.script.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('SA_swift/js/SA_swifter.js')); ?>"></script> 

<script type="text/javascript" src="<?php echo e(asset('js/chart.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('aos/aos.js')); ?>"></script>

<script>

function getId(x){
  return document.getElementById(x);
}
 $(document).ready(function(){
            $('.portalBtn li').on('click', function(){
                $(this).parent().find('li').removeClass('portalBtn-active');
                $(this).addClass('portalBtn-active');
                $('.portalCont').hide();
                let TagId = $(this).attr('role');                
                $('#'+TagId).show();
            });
        })
</script><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/layouts/scripts.blade.php ENDPATH**/ ?>