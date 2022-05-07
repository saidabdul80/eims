
  <!--  <header class="d-flex justify-between w-100 bg-white" style="position: fixed;z-index: 2;box-shadow: 0px -1px 6px #555;height:75px;background:#fff">-->
      <nav class="navbar w-100" style="position: fixed;z-index: 2;box-shadow: 0px -1px 6px #555;height:75px;background:#fff">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
               <a class="navbar-brand" href="index.html"><img src="{{ asset('images/logos/logo.png')}}" alt="image"></a>
            </div>
        
        
        <div id="navbar" class="navbar-collapse collapse" style="">
                    <ul class="nav navbar-nav navbar-right d-flex flex-row mt-3">
                        <li><a class="active" href="{{route('eims.home')}}">Home</a></li>
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Enrolment <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
							<li class=""> <a href="{{route('enrolment.all')}}" > All Enrollees </a></li>
    						<li class=""> <a href="{{route('enrolment.idcard-by-provider')}}" > ID Card by Provider </a></li>
    						<li class=""> <a href="{{route('enrolment.enrolment-approval')}}" > Enrolment Approval </a></li>
							
							</ul>
						</li>
                        
                    </ul>
                </div>
                
                </nav>
   <!-- </header>-->
    
    <div class="hidden-xs hidden-sm"> <br><br></div>
   