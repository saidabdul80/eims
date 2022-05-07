

    <meta name="keywords" content="Nicare nicare">

    <meta name="description" content="">

    <meta name="author" content="">



    <!-- Site Icons -->

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico')}}" type="image/x-icon" />

    <link rel="apple-touch-icon" href="{{ asset('images/logo.png')}}">



    <!-- Bootstrap CSS -->

    

    <!-- Site CSS -->

    <link rel="stylesheet" href="{{ asset('style.css')}}">

    <link rel="stylesheet" href="{{ asset('CSS/bootstrap4.css')}}">

	<link rel="stylesheet" href="{{ asset('styles2.css')}}">

    <!-- Responsive CSS -->

    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">

    <!-- Custom CSS -->



    <link rel="stylesheet" href="{{ asset('wow/css/animate.css')}}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ asset('SA_swift/css/SA_swifter.css')}}">

  

    <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js')}}"></script>



    <link href="{{ asset('css/datatable.css')}}" rel="stylesheet" media="all">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

  

<script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/sweetalert2.js')}}"></script>
<script src="{{asset('js/vue3.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/vuex.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/store.js')}}"></script>

<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />



<style media="screen">

.mySideTab{

  color: #67b1e6;

  box-shadow: 0 5px 10px 0 rgba(5, 16, 44, .15);

  background: #ffffff;

  padding:10px 20px;

  text-align:left;

  font-size: 12px;

  font-weight:bolder;

}

#dashboard_top_figures_wrap .fa{

	font-size: 2.5em;

}

.mySideTab:hover,.mySideTab:active{

  color: #fff;

  background: #67b1e6;

}





#overlay{	

	position: fixed;

	top: 0;

	z-index: 100;

	width: 100%;

	height:100%;

	display: none;

	background: rgba(0,0,0,0.6);

}

.cv-spinner {

	height: 100%;

	display: flex;

	justify-content: center;

	align-items: center;  

}

.spinner {

	width: 40px;

	height: 40px;

	border: 4px #ddd solid;

	border-top: 4px #2e93e6 solid;

	border-radius: 50%;

	animation: sp-anime 0.8s infinite linear;

}

@keyframes sp-anime {

	100% { 

		transform: rotate(360deg); 

	}

}

.is-hide{

	display:none;

}



.counter {

    background-color:#ffffff;

    padding: 10px 0;

    border-radius: 5px;

    box-shadow: 0px 1px 5px 0px rgba(153, 153, 153, 0.2);

    border-left: 4px solid #08c;

    margin-top: 5px;

}



.counter :nth-child(2){

   

}



.count-title {

    font-size: 1.5em;

    font-weight: normal;

    margin-top: 2px;

    margin-bottom: 0;

    text-align: center;

}



.count-text {

    font-size: 12px;

    font-weight: normal;

    margin-top: 2px;

    margin-bottom: 0;

    font-weight: bolder;

    text-align: center;

}



.fa-2x {

    margin: 0 auto;

    float: none;

    display: table;

    color: #4ad1e5;

}





    	.d-title{

    		text-align: center;

    		font-size: 14px;

    		text-transform: capitalize;

    		font-weight: bold;

    		color: #6781a6;

			border-radius:none !important;

    	}

    	.d-body{

    		font-family: 'Roboto', sans-serif;

    		text-align: center;

    		font-size: 30px;

    		-webkit-transition: color 1s; /* Safari */

    		transition: color 1s;

    		color:#6781a6;

    		font-weight: bolder;



    	}   

    	.pad{

    		cursor: pointer;

    		padding: 5px 9px;

    	} 	

    	.pad:hover{

    		box-shadow: 1px 2px 5px #ccc;

    	}

    	.b-title{

    		font-size: 1.2em;

    		line-height: 16px;    		

            margin-bottom: 5px;

            font-weight: bolder;

    	}

    	

    	

    	.counter-number-1{

    	    font-size: 30px;

             font-weight: normal;

    	}

    	

    	.counter-number-2{

    	   font-size: 30px;

            font-weight: normal;

    	}

    	

    	.counter-number-3{

    	    font-size: 30px;

            font-weight: normal;

    	}

    	

    .text-size-1{

        font-size: 1.5em;

    }

</style>