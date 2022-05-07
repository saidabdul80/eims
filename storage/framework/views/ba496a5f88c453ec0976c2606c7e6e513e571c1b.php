<?php
use App\Institution;
use App\Tpa_institution;

$institutions = Institution::all();
$tpa_institutions = Tpa_institution::all();
?>
<script>
    var institutions = <?= json_encode($institutions) ; ?>;
    var tpa_institutions = <?= json_encode($tpa_institutions) ; ?>;
</script>


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
    <div class="jumbotron px-3 py-2 text-dark d-inline-block">::Assign Provider to Institution</div>
    <div class=" w-100" style="height: 70vh;">     
        <div btn-type="provider_institution" >
        <div id="tpaData2" class="row w-100  pm">
                    <input type="text" class="form-control mx-auto serachX" placeholder="Search" style="width: 250px;">
                    <table class="table w-100" >
                        <thead>
                            <tr>
                                <th style="width: 5%;"></th>
                                <th style="width: 45%;"></th>
                                <th style="width: 5%;"></th>
                                <th style="width: 45%;"></th>
                            </tr>
                        </thead>
                        <tbody id="dataTablex2">
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_section'); ?>
<script>
   

    function selectInstitution(){
        let select ="<select class='iSelectBox form-control' ><option value=''>Select Institution</option>";
        institutions.forEach((item)=>{
            select +=   `<option value='${item.id}'>${item.name}</option>`;
        })
        select +="</select>";
        return select;
    }
    function getInstitutions(institutions){
        let insti = '';        
        if(institutions !== undefined){

            if(institutions.length>0){
                institutions.forEach((item)=>{
                insti += `
                    <button data-id="${item.id}" data-inst="${item.institution_id}" style="font-size:0.9em;" class="btn btn-danger text-white deAssignBtn">${item.institution.sortCode} <span class="fa fa-times text-white"></span></button>            
                `
                })
            }else{
                return '';
            }        
        }else{
            insti = ""
        }
        return insti;
    }
   var  fetchData = function(callback,url,target,assign_url, deassign_url, type, start = 0, length = 7, search = "" ){ 
             
        if(type===1){
            codeName = "tpa_code"
            institutionName = "tpa_institution"
        }else if(type === 2){
            codeName = "hcpcode"
            institutionName = "provider_institution"
        }        
        $.ajax({
            url: `${url}/${start}/${length}/${search}`,
            method: 'GET'
        }).done(function(res) {            
            let tr = "";
            //console.log(res.data.data)            
            res.data.data.forEach((item)=>{
                console.log(item.tpa_institution);
                tr += `<tr>
                    <td>${item.sn}.</td>
                    <td>
                        <div class="row shadow2 m-y mr-2 py-2">
                            <div class="col-md-5">
                                ${item[codeName]}
                                <input class="item_id" type="text" value="${item.id}" style="display:none">
                            </div>
                            <div class="col-md-7">
                                ${selectInstitution()}
                            </div>
                        </div>
                    </td>
                    <td style="display:flex; justify-content:center;align-item:center;">
                    <button class="btn bg-white shadow btnAssign"><i class="fa fa-arrow-right" class="text-info" aria-hidden="true"></i></button>                    
                    </td>
                    <td>
                        <div class="shadow2" style="min-height:30px;padding: 7px;">
                        ${getInstitutions(item[institutionName])}
                        </div>
                    </td>
                    </tr>`;
            })
            $("#"+target).html(tr);
            callback(url,target,assign_url, deassign_url, type);
        });
    }

    function executeX(url,target,assign_url, deassign_url, type){
        
        $(".btnAssign").on("click", function(){            
            let tr = $(this).parent().parent();
            let tpa_id = tr.find(".item_id").val();
            let institution_id = tr.find("select").val();
            let ids =[];
            if(institution_id ==""){
                alert("Select Institution");
                return 0;
            }
            $(this).parent().next().find("button").each(function(){
                ids.push(parseInt($(this).attr("data-inst"))) //get ids from assigned institution
            })
            let err = false;
            ids.every((id)=>{       
               if(id  == institution_id){
                   alert("Already Assigned");
                   err = true;
                   return false;
               }               
                return true;
            })
            if(err){
                return 0;
            }


            $.ajax({
                url: `${assign_url}/${tpa_id}/${institution_id}/`,
                method: 'GET'
            }).done(function(res) {     
                alert(res)
                fetchData(executeX,url,target,assign_url, deassign_url, type);
                
            })                
        })

        $(".deAssignBtn").on("click", function(){            
            let id = $(this).attr('data-id');

            $.ajax({
                url: `${deassign_url}/${id}`,
                method: 'GET'
            }).done(function(res) { 
                alert(res)    
                fetchData(executeX,url,target,assign_url, deassign_url, type);
            })                
        })

        
    }

  
    $(".serachX").on('keyup', function (e) {
        let text= $(this).val().split('/');        
        text=text.join('_')
        if (e.key === 'Enter' || e.keyCode === 13) {            
            fetchData(executeX,'providers',"dataTablex2", "assign_provider_to_institution","deassign_provider_from_institution",2, 0, 7, `${text}`    )
        }
    }); 
    

fetchData(executeX,'providers',"dataTablex2", "assign_provider_to_institution","deassign_provider_from_institution",2);

</script>
<?php $__env->stopSection(); ?>
<style>
    tr td {
        font-size: 0.9em !important;
        color: #666;
    }

    .shadow{
        box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 12px;
    }
    /* tr td:nth-child(2), tr td:nth-child(4){
        box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px !important;
    } */
    .shadow2{
        box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px !important;
    }
    tr td:first-child, tr td:nth-child(3),td{
        border-top: 1px solid transparent !important;
    }
    tr th{
        border-bottom: 0px solid transparent !important;
    }
    .pm{
        margin: 0px auto !important;
        padding: 20px 15px 20px 0px;
    }
    select{
        border:0px !important;
        border-bottom: 1px solid #aaa !important;
        border-radius: 0px !important;

    }
</style>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Desktop\eims.ngscha.ni.gov.ng\resources\views/institution/assign_provider_institution.blade.php ENDPATH**/ ?>