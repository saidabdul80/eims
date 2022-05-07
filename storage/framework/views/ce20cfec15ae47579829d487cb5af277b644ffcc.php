<?php
use App\Sessions;

$sessions = Sessions::all();
?>



<?php $__env->startSection('breadcrumb','Dashboard'); ?>

<?php $__env->startSection('content-body'); ?>

<?php if(session()->exists('welcome')): ?>

<hr />
<div class="alert alert-success"> <?php echo e(session('welcome')); ?> </div>
<?php endif; ?>

<?php if(session()->exists('message')): ?>
<hr />
<div class="alert alert-success"> <?php echo session('message'); ?> </div>
<?php endif; ?>
<?php if(session()->exists('error')): ?>
<hr />
<div class="alert alert-danger"> <?php echo session('error'); ?> </div>
<?php endif; ?>
<div >
    <br>
    <br>
    <div  class="jumbotron px-3 py-2 text-dark d-inline-block">::Manage Session</div>
    <div id="sessionApp">
        <div  class="w-100 display-none" style="height: 68vh;">
            <div btn-type="tpa_institution"  >
                    <div id="tpaData" class="row w-100 shadow pm">
                        <input type="text" class="form-control mx-auto serachX" placeholder="Search" style="width: 250px;">
                        <table class="table w-100" >
                            <thead>
                                <tr>
                                    <th style="width: 5%;">S/n</th>
                                    <th style="width: 45%;">Name</th>
                                    <th style="width: 25%;">Set Current</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="dataTablex">
                                <tr v-for="(session,index) in sessions">
                                    <td>{{index+1}}</td>
                                    <td>{{session.name}}</td>
                                    <td>
                                        <span  v-if="typeof(session.is_current) !== 'object' " class="badge bg-success">Current</span>
                                    </td>
                                    <td>                                        
                                            <form action="<?php echo e(route('set_session')); ?>" method="GET" class="d-inline-block mx-1">
                                                <input type="text" :value="session.id" style="display: none;" name="id">
                                                <button type="submit" class="btn btn-success mx-1">set</button>
                                            </form>                                        

                                        <form action="<?php echo e(route('delete_session')); ?>" method="GET" class="d-inline-block mx-1">
                                            <input type="text" :value="session.id" name="id" style="display: none;">
                                            <button type="submit" class="btn btn-danger mx-1">Delete</button>
                                        </form>                                        
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
            </div>
        
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_section'); ?>

<script>

    
var vuePayStack = Vue.createApp({
    data(){
        return{
            sessions:<?= json_encode($sessions) ; ?>,
            loading:true,
        }
    },
      computed: {
        totalNumber: function () {
           // return  store.getters.totalNumber
        },        
    },
    methods:{        
         

    },
    mounted(){
        let $this = this;
        $(document).ready(function(){
            $("#sessionApp div").removeClass("display-none");
        })
    }
  })  
  vuePayStack.mount('#sessionApp');
</script>
<?php $__env->stopSection(); ?>
<style>
    table tr td, tr th{
        font-size: 1em !important;
    }
    .display-none{
        display: none;
    }
</style>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Desktop\eims.ngscha.ni.gov.ng\resources\views/institution/session.blade.php ENDPATH**/ ?>