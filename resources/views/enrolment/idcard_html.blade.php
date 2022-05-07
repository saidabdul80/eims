<?php
use App\Lga;
use App\Ward;
use App\Provider;
require('phpqrcode/qrlib.php');
QRcode::png($enrollee->enrolment_number, 'qrcode_image.png'); 

    $providers = Provider::all();



function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}

?>
<!DOCTYPE html>
<html lang="en">
	 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <!-- Site Metas -->
    <title>.::NiCare Portal</title>
    <meta name="keywords" content="Nicare nicare">
    <meta name="description" content="">
    <meta name="author" content="">

    

<style media="screen">
.mySideTab{
  color: #67b1e6;
  box-shadow: 0 5px 10px 0 rgba(5, 16, 44, .15);
  background: #ffffff;
  padding:10px 20px;
  text-align:left;
  font-weight:bolder;
}

.mySideTab:hover,.mySideTab:active{
  color: #fff;
  background: #67b1e6;
}
</style>

	<style>
	html { margin: 0px;}
		@page { margin: 0px; padding:0; }
		body { margin: 0px;padding:0; font-size:9px;}

		.content-main{
			
		}
		td{
			color:rgb(0,51,102);
			font-weight:bolder;
		}
		
		.data{
			font-size:10px;
			font-weight:bold;
			color: #0a2b61;
			margin:0;
			padding:0;
		}
		
		.data-huwe{
			font-size:12px;
			font-weight:lighter;
			color: #0a2b61;
			margin:0;
			padding:0;
			line-height:12px;
		}
		
		.data-huwe span{
			font-size:8px;
			font-weight:bolder;
		}
		
		.data2{
			font-size:10px;
			font-weight:bold;
			margin:0;
		}
		
		@page{ margin: 0;}

		.page{
			
			width:319px 
			height: 210px; 
			max-height:210px;
			overflow: hidden; 
			font-family: Arial, Helvetica; 
			position: relative; 
			color: #545554;
			padding:2px;
			margin-right:2px;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center; 
			background-size: 100% 100%;
		}
		
		p{
			margin:0;
		}
		.page_break { page-break-before: always; }
		
            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
		#watermark {
                position: fixed;

                /** 
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   10cm;
                left:     5.5cm;

                /** Change image dimensions**/
                width:    8cm;
                height:   8cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
	</style>
</head>
<body>


	@if($enrollee->mode_of_enrolment == 'Premium')		
            <div class="page ">
				<p><img src="https://ngscha.ni.gov.ng/apps/img/heading.png" style="width:320.52px;height:50px"/></p>
					<table width="100%" style="background:none">
					<tr>
							<td style="margin-right:120px">
							<div style="padding: 0px 5px">
								<p class="data"> NICARE NO.: {{$enrollee->enrolment_number}}</p>
								<p class="data"> NAME : {{$enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name}}</p>
								<p class="data"> SEX: {{$enrollee->sex}}</p>
								<p class="data"> DOB: {{$enrollee->date_of_birth}}</p>
                                <p class="data"> OCCUPATION: {{$enrollee->occupation}}</p>
								<p class="data">  PROVIDER: {{provider_name($providers,$enrollee->provider_id)}}</p>
							</div>
						</td>
						<td style="width:100px;"><br>
								<img src="https://ngscha.ni.gov.ng/apps/img_data/enrollees/{{$enrollee->id}}.jpg" width="90px" height="100px" style="border:3px solid #fff;margin-right:2px"/><br>
								Exp. Date: 
						</td>
					</tr>
				</table>
			</div>
			
				<div class="page">
				<footer>
            Copyright
        </footer>
				<table width="100%" valign="">
					<tr border="0">
						<td colspan="2" >
						
						<div style="padding: 0px 5px">
							<span class="data" style="font-size:10px" style="color:#2466d1">
							For Enquiries &amp; Complaints: please call NiCare agents through 23456</span>
						</div>
						</td>
					</tr>
					<tr>
						<td style="margin-right:120px">
							<div style="padding: 0px 5px">
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
								<small>Visit our website: www.ngscha.org.ng</small>
							</div>
						</td>
						<td style="width:100px;">
							
						</td>
					</tr>
				</table>
			</div>

@else
<div class="page">
    <table width="100%" style="background:none;">
                    <tr>
                        <td style="padding:0;margin:0;" width="20%">
                        <br/>
                                <p style="padding-left: 30px"><img src="https://ngscha.ni.gov.ng/apps/img/nicare_logo.png" width="30px" /><img src="https://ngscha.ni.gov.ng/apps/img/huwe_logo.png" width="50px"  style="margin-left:10px"/></p>
                                <p style="margin-bottom: 5px"><img src="https://ngscha.ni.gov.ng/apps/img_data/enrollees/{{$enrollee->id}}.jpg" width="100px" height="100px" style="border:3px solid #3e9c62;margin-left:20px"/></p>
                                
                                <div style="text-align:center;line-height:10px"> 
                                    {{$enrollee->enrolment_number}}<br/>
                                    <span class="text-danger">NIGER STATE
                                </div>
                          </td>
                        <td style="padding:0;margin:0" width="80%">
                                <div style="padding-top: 10px;padding-left: 10px">
                                        <br/>
                                <p class="data-huwe"> <span>LUNIQUE ID.:</span><br/> {{$enrollee->BHCPF_number}}
                                <br/> <span>NAME : </span><br/>Abdulkarim Abdullahi Mohammed
                                <br/> <span>SEX: :</span><br/> {{$enrollee->sex}}
                                <br/> <span>Date of Birth	: :</span><br/> {{$enrollee->date_of_birth}}
                                </p>
                            </div>
                            
                            <div style="text-align:right;padding-right:20px"> <img src="https://ngscha.ni.gov.ng/apps/qrcode_image.png" width="50px" height="50px"/></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="page page_break">
            
            <table width="100%" valign="">
                <tr border="0">
                    <td colspan="2" >
                        <p style="padding: 20px">
                            <img src="https://ngscha.ni.gov.ng/apps/img/huwe_logo.png" width="60px" />
                            
                            <img src="https://ngscha.ni.gov.ng/apps/img/ministry_of_health.png" width="80px" style="float:right" />
                        </p>
                        
                        <p style="padding: 2px 10px">
                            This card guarantees you access to Basic Minimum Package of Health Services (BMPHS)
                            in accredited primary health facilities. When presented, the bearer will receive free of charge, the services
                            covered under BMPHS.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="margin-right:120px">
                        <div style="padding: 0px 5px">
                        <br>
                            <small>Visit our website: www.ngscha.ni.gov.ng</small>
                        </div>
                    </td>
                    <td style="width:100px;">
                        
                    </td>
                </tr>
                
            </table>
            
    
        </div>

@endif

</body>

</html>