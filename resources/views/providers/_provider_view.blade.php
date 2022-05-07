<div class="w3-card" style="padding:20px">

    <div id="features" class=" ">
        <div class="container-fluid">
           


            <hr />
            <p><a href="{{ route('manage_providers') }}"><i class="fa fa-arrow-left"></i> Back to Manage Providers</a></p>
            <div>
                <p>
                    <center><img src="{{ asset('images/logo.png') }}" id="project_logo" width="60" height="60" /></center>
                </p>
                <h3 class="text-center text-danger">Niger State Contributory Health Scheme (Nicare) </h3>
                <h4 class="text-center"><span style="padding:4px;" class="b3-theme">Provider Information </span></h4><br />
            </div>

            <fieldset>
                <legend>Provider Code - {{ $provider->hcpcode}}</legend>
                <div class="table-responsive w3-card ">
                    <table class="table  table-striped" id="">
                        <tr>
                            <td>HCPNAME: {{ $provider->hcpname}}</td>
                            <td>HCPCATEGORY: {{ $provider->hcpcategory }}</td>
                        </tr>
                        <tr>

                            <td>HCPTYPE: {{ $provider->hcptype }}</td>
                            <td>HCPSTATUS: {{ $provider->hcpstatus }}</td>
                        </tr>
                    </table>
            </fieldset>
            <hr />
            <fieldset>
                <legend>Provider Contact </legend>
                <table class="table  table-striped" id="">
                    <tr>

                        <td>CONTACT PHONE NO.: {{ $provider->hcpcontactphone }}</td>
                        <td>CONTACT EMAIL: {{ $provider->hcpemailaddress }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">ADDRESS: {{ $provider->hcpaddress }}</td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Provider BANK DETAILS </legend>
                <table class="table  table-striped" id="">
                    <tr>

                        <td>BANK NAME.:{{ $provider->hcpBankName }} </td>
                        <td>ACCOUNT NAME: {{ $provider->hcpBankAccountName }}</td>
																</tr>
																<tr>
																		<td >ACCOUNT NUMBER: {{ $provider->hcpBankAccountNumber }}</td>
                        <td>BANK SORT CODE: {{ $provider->sortCode }}</td>
																</tr>
															</table>
															</fieldset>
															<fieldset>
															<legend>Provider ENROLEE DETAILS </legend>
																 <table class="table  table-striped" id="">
																<tr>
																
																	<td>FORMAL ENROLEE.: {{ $provider->hcpBankName }}</td>
                        <td>INFORMAL ENROLEE: {{ $provider->hcpBankAccountName }}</td>
																</tr>
															</table>
															</fieldset>
											<hr class="hr1">

										</div><!-- end container -->
									</div><!-- end section -->
												
								
								</div>
							</div>