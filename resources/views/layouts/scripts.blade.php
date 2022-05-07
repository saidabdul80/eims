<!-- ALL JS FILES -->

 <script src="{{ asset('js/jquery-3.1.1.min.js')}}"></script>

<script src="{{ asset('js/all.js')}}"></script>

    

 

            



    <!-- ALL PLUGINS -->

    <script src="{{ asset('wow/js/wow.min.js')}}"></script>

    <script src="{{ asset('js/custom.js')}}"></script>

    <script src="{{ asset('js/portfolio.js')}}"></script>

    <script src="{{ asset('js/hoverdir.js')}}"></script>

     <!--<script type="text/javascript" src="js/actions.js"></script>-->

     <script src="{{ asset('js/datatable.js')}}"></script>

   <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>



<script type="text/javascript" src="{{ asset('js/ees.script.js')}}"></script> 

<script type="text/javascript" src="{{ asset('SA_swift/js/SA_swifter.js')}}"></script> 



<script type="text/javascript" src="{{ asset('js/chart.js')}}"></script> 
<script type="text/javascript" src="{{ asset('js/xlsReader.js')}}"></script> 

<script type="text/javascript" src="{{asset('aos/aos.js')}}"></script>



<script>


var customAlert = function(msg = ""){
     alert(msg);
    }

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

</script>