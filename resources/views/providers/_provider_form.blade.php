<div>
    <p>
        <center><img src="{{ asset('images/logo.png')}}" id="project_logo" width="60" height="60" /></center>
    </p>
    <h3 class="text-center text-danger">Niger State Contributory Health Scheme (Nicare) </h3>
    <h4 class="text-center"><span style="padding:4px;" class="b3-theme">Provider Form </span></h4><br />
</div>
<form action="{{ route('provider.update')}}" method="POST" style="border:2px dashed #ececec; padding:20px">
        {{ csrf_field() }}
        <p><input type="hidden" class="form-control" name="id"  value="{{!empty($provider) ? $provider->id : ''}}" id="id"  placeholder="id" required></p>
    <fieldset>
        <legend>Basic Provider Information</legend>

        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">PROVIDER NAME <span class="asterik asterik_first_name">*</span> </label>
                <p><input type="text" class="form-control" name="hcpname"  value="{{!empty($provider) ? $provider->hcpname : ''}}" id="hcpname"  placeholder="HCPNAME" required></p>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surname">HCPCATEGORY<span class="asterik asterik_surname">*</span> </label>
                <select class="form-control" id="hcpcategory" name="hcpcategory" required>
                    <option value="">Select Category</option>
                    <option value="Public" {{$hcpcategory == "Public" ? "selected" : ""}}>Public</option>
                    <option value="Private" {{$hcpcategory == "Private" ? "selected" : ""}}>Private</option>


                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surname">PROVIDWER TYPE<span class="asterik asterik_surname">*</span> </label>
                <select class="form-control" id="hcptype" name="hcptype" onchange="load_service_claim_type(this.value)" required>
                    <option value="">Select Provider type</option>
                    <option value="Primary" {{$hcptype == "Primary" ? "selected" : ""}}>Primary</option>
                    <option value="Secondary" {{$hcptype == "Secondary" ? "selected" : ""}}>Secondary</option>
                    <option value="Tertiary" {{$hcptype == "Tertiary" ? "selected" : ""}}>Tertiary</option>

                </select>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label for="surname">LGA<span class="asterik asterik_surname">*</span> </label>
                <select class="form-control" id="hcplga" onchange="load_ward_by_lga(this.value)" name="hcplga" required>
                    <option value="">Select LGA</option>
                    @foreach($lgas as $lga)
                    <option value="{{ $lga->id}}" {{ $lga->id == $hcplga ? "selected" : ""}}>{{ $lga->lga}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label for="surname">WARD<span class="asterik asterik_surname">*</span> </label>
                <select class="form-control" id="ward" name="ward" required>
                    <option value="">Select Ward</option>
                    @foreach($wards as $ward)
                    <option value="{{ $ward->id}}" {{ $ward->id == $hcpward ? "selected" : ""}}>{{ $ward->ward}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label for="surname">CAP COUNT<span class="asterik asterik_surname">*</span> </label>
                <input type="number" name="hcpcap" class="form-control" value="{{!empty($provider) ? $provider->hcpcap : ''}}" placeholder="Provider Cap">
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label for="surname">SERVICE CLAIM TYPE<span class="asterik asterik_surname">*</span> </label>
                <select class="form-control" id="serviceClaimType" name="serviceClaimType" required>
                    <option value="">Select service Claim Type</option>
                    <option value="cap"  {{$serviceClaimType == "cap" ? "selected" : ""}}>Capitation</option>
                    <option value="ffs" {{$serviceClaimType == "ffs" ? "selected" : ""}}>Fee for Service</option>
                    <option value="cap/ffs" {{$serviceClaimType == "cap/ffs" ? "selected" : ""}}>Cap & FF Service</option>w

                </select>
            </div>
        </div>



    </fieldset>
    <fieldset>
        <legend> Provider Contact</legend>

        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">ADDRESS <span class="asterik asterik_first_name">*</span> </label>
                <p><input type="text" class="form-control" name="hcpaddress"  value="{{!empty($provider) ? $provider->hcpaddress : ''}}" id="hcpaddress" placeholder="ADDRESS"></p>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surname">PHONE NUMBER<span class="asterik asterik_surname">*</span> </label>
                <p><input type="text" class="form-control" name="hcpcontactphone"  value="{{!empty($provider) ? $provider->hcpcontactphone : ''}}" id="hcpcontactphone"  placeholder="hcpcontactphone"></p>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surname">EMAIL ADDRESS<span class="asterik asterik_surname">*</span> </label>
                <p><input type="text" class="form-control" name="hcpemailaddress"  value="{{!empty($provider) ? $provider->hcpemailaddress : ''}}" id="hcpemailaddress" placeholder="hcpemailaddress"></p>

            </div>
        </div>

    </fieldset>
    <fieldset>
        <legend> Bank Details </legend>

        <div class="col-md-3">
            <div class="form-group">
                <label for="first_name">BANK NAME <span class="asterik asterik_first_name">*</span> </label>
                <p><input type="text" class="form-control" name="hcpBankName"  value="{{!empty($provider) ? $provider->hcpBankName : ''}}" id="hcpBankName" placeholder="BankName" ></p>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surname">ACCOUNT NAME<span class="asterik asterik_surname">*</span> </label>
                <p><input type="text" class="form-control" name="hcpBankAccountName"  value="{{!empty($provider) ? $provider->hcpBankAccountName : ''}}" id="hcpBankAccountName"  placeholder="BankAccountName" ></p>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surname">ACCOUNT NUMBER<span class="asterik asterik_surname">*</span> </label>
                <p><input type="text" class="form-control" name="hcpBankAccountNumber" value="{{!empty($provider) ? $provider->hcpBankAccountNumber : ''}}" id="hcpBankAccountNumber"  placeholder="BankAccountNumber" ></p>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surname">SORT CODE<span class="asterik asterik_surname">*</span> </label>
                <p><input type="text" class="form-control" name="sortCode"  value="{{!empty($provider) ? $provider->sortCode : ''}}" id="sortCode"  placeholder="sortCode"></p>

            </div>
        </div>
    </fieldset>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <hr />

                @if(empty($provider))
                <input type="submit" class="btn btn-info" value="Create provider" name="create_provider">
                @else
                <input type="submit" class="btn btn-info" value="Update provider" name="edit_provider">
                @endif
            </div>
        </div>
    </div>
</form>
<hr class="hr1">