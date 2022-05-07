<?php



$caps_month = [];

$lga_names_nicare = [];

$lga_count_nicare = [];



$lga_names_bhcpf = [];

$lga_count_bhcpf = [];





$months = [

    1 => ['name' => 'January' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    2 => ['name' => 'February' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    3 => ['name' => 'March' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    4 => ['name' => 'April' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    5 => ['name' => 'May' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    6 => ['name' => 'June' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    7 => ['name' => 'July' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    8 => ['name' => 'August' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    9 => ['name' => 'September' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    10 => ['name' => 'October' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    11 => ['name' => 'November' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

    12 => ['name' => 'December' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],

];





$lgas = [

    1 => [  'id' => 1 , 'name' => 'AGAIE', 'total' => 0],

    2 => [  'id' => 2 , 'name' => 'AGWARA', 'total' => 0],

    3 => [  'id' => 3 , 'name' => 'BIDA', 'total' => 0],

    4 => [  'id' => 4 , 'name' => 'BORGU', 'total' => 0],

    5 => [  'id' => 5 , 'name' => 'BOSSO', 'total' => 0],

    6 => [  'id' => 6 , 'name' => 'CHANCHAGA', 'total' => 0],

    7 => [  'id' => 7 , 'name' => 'EDATI', 'total' => 0],

    8 => [  'id' => 8 , 'name' => 'GBAKO', 'total' => 0],

    9 => [  'id' => 9 , 'name' => 'GURARA', 'total' => 0],

    10 => [ 'id' => 10 ,  'name' => 'KATCHA', 'total' => 0],

    11 => [  'id' => 11 , 'name' => 'KONTAGORA', 'total' => 0],

    12 => [  'id' => 12 , 'name' => 'LAPAI', 'total' => 0],

    13 => [  'id' => 13 , 'name' => 'LAVUN', 'total' => 0],

    14 => [  'id' => 14 , 'name' => 'MAGAMA', 'total' => 0],

    15 => [  'id' => 15 , 'name' => 'MARIGA', 'total' => 0],

    16 => [  'id' => 16 , 'name' => 'MASHEGU', 'total' => 0],

    17 => [ 'id' => 17 ,  'name' => 'MOKWA', 'total' => 0],

    18 => [ 'id' => 18 ,  'name' => 'MUYA', 'total' => 0],

    19 => [  'id' => 19 , 'name' => 'PAIKORO', 'total' => 0],

    20 => [  'id' => 20 , 'name' => 'RAFI', 'total' => 0],

    21 => [  'id' => 21 , 'name' => 'RIJAU', 'total' => 0],

    22 => [ 'id' => 22 , 'name' => 'SHIRORO', 'total' => 0],

    23 => [ 'id' => 23 ,  'name' => 'SULEJA', 'total' => 0],

    24 => [ 'id' => 24 ,  'name' => 'TAFA', 'total' => 0],

    25 => [  'id' => 25 , 'name' => 'WUSHISHI', 'total' => 0]

];

foreach ($data['enrollees-by-lga'] as $key => $lga) {

    if($lga->scheme == 'huwe')

         $lgas[$lga->lga_id]['total'] = $lga->total; 

}



$sn = 1;

foreach ($lgas as $key => $lga) {

   array_push($lga_names_bhcpf, $lga['name']);

   array_push($lga_count_bhcpf, $lga['total']);

   $lgas[$sn]['total'] = 0;

   $sn++;

}





foreach ($data['enrollees-by-lga'] as $key => $lga) {

    if($lga->scheme == 'Premium')

         $lgas[$lga->lga_id]['total'] = $lga->total; 

}





foreach ($lgas as $key => $lga) {

    array_push($lga_names_nicare, $lga['name']);

    array_push($lga_count_nicare, $lga['total']);

 }









$this_month_cap_nicare = 0;

$this_month_cap_bhcpf = 0;

foreach ($data['caps'] as $key => $cap) {
    $months[$cap->month]['nicare_cap'] = $cap->total_cap;

}

foreach ($data['caps_bhcpf'] as $key => $cap) {
    $months[$cap->month]['bhcpf_cap'] = $cap->total_cap;

}





?>









<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    







<?php $__env->startSection('content-body'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<style>

    .verticaltext {

    width: 150px; height: 30px;

    position: fixed;

    left: -45px;

    top: 85%;

    transform: rotate(-90deg);

    -ms-transform: rotate(-90deg);

    -webkit-transform: rotate(-90deg);    

    z-index: 100;

    color: #ffffff;

    text-align: center;

    letter-spacing: 1px;



    line-height: 12px;

    box-shadow: 1px 2px 4px #ccc;

}

</style>

    <div class="viewer-plain"></div>

    <div id="nboard" class="bg-success shadow verticaltext">Nicare Dashboard</div>

    <div id="hboard" style="display: none;" class="bg-primary shadow verticaltext">BHCPF Dashboard</div>



    <div id="nicareDashboard">

    <div class="container-fluid p-0">

	

         <?php echo $__env->make('nicare_dashboard_top_figures', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            <?php echo $__env->make('nicare_dashboard_charts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         

        </div>

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4">

           <?php echo $__env->make('nicare_dashboard_summary_reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
        </div>

    </div>

   </div>

   <div id="huweDashboard" style="display: none;">

     <?php echo $__env->make('huweDashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



   </div>

   <div class="swift" style="width: 200px;">

      <div class="t-menu">Switch</div>

      <div id="round-tab"  class="main-tabs">   

        <div class="tabsI" onclick="(function(){$('#huweDashboard').hide();$('#nicareDashboard').show(200); $('#hboard').hide();$('#nboard').show(200);})()">Nicare</div>  

        <div class="tabsI" id="huweFace" onclick="(function(){$('#nicareDashboard').hide();$('#huweDashboard').show(200); $('#nboard').hide();$('#hboard').show(200);})()">BHCPF</div>                

      </div>

    </div>

  

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_section'); ?>

<script>







 

</script>

<script >

    var switf = new SA_SwiftMenu($('.t-menu'),100,$('#round-tab'),$('.tabsI'),'-20');

    switf.switf();

    switf.clickOutside();



      var pad = $('.pad'), ddf, st;

        setTimeout(function() {         

            pad.removeClass('ld');                  

        }, 2000);



        $('.pad').click(function(){

                $(this).addClass('viewer1 ld'); 

                $('.viewer-plain').show();

                $('.viewer-plain').fadeIn(500);                 

        });

        $('.viewer-plain').click(function(){

            $(this).fadeOut(500);

            pad.removeClass('ld viewer1');  

        })

  </script>

 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/dashboard_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/dashboard.blade.php ENDPATH**/ ?>