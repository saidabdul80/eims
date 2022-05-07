<script src="https://js.paystack.co/v1/inline.js"></script> 

<div id="payStackApp" class="d-inline-block">
    <input type="text" name="amount" :value="amount" style="display:none;">
    <button type="button" class="btn btn-success" @click="payWithPaystack()"> Use PayStack {{totalNumber*amount}} </button>
</div>


<script>

var vuePayStack = Vue.createApp({
    data(){
        return{
            amount:2000,
        }
    },
      computed: {
        totalNumber: function () {
            return  store.getters.totalNumber
        },
        key: function (){
            return store.getters.payStackKey
        }
    },
    methods:{
        payWithPaystack() {            
            let $this = this;
            //e.preventDefault();            
            let handler = PaystackPop.setup({
                key: $this.key, // Replace with your public key
                email: '<?= session('user_data')->email_address?>',
                amount: $this.amount * $this.totalNumber * 100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                // label: "Optional string that replaces customer email"
                onClose: function(){
                Swal.fire('Window closed.');
                },
                callback: function(response){
                    //console.log(response);
                    try{
                        $("input[name='ref']").val(JSON.stringify(response));
                    }catch(e){}
                        $("#payment_type").val('Other')
                    $("#uploadStudent").submit();
                ///let message = 'Payment complete! Reference: ' + response.reference;
                //Swal.fire(message);
                }
            });
            handler.openIframe();            
        }

    },
    mounted(){

        let $this = this;
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);
        

    }
  })  
  vuePayStack.mount('#payStackApp');
  
</script><?php /**PATH C:\Users\User\Desktop\Desktop\eims.ngscha.ni.gov.ng\resources\views/layouts/paymentForm.blade.php ENDPATH**/ ?>