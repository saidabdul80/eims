<?php



$lgas = $data['lgas'];
$wards = $data['wards'];
$providers = $data['providers'];


function lga_name($lgas, $id)
{
    foreach ($lgas as $key => $lga) {
        if ($lga['id'] == $id) {
            return $lga['lga'];
        }
    }
}


function ward_name($wards, $id)
{
    foreach ($wards as $key => $ward) {
        if ($ward['id'] == $id) {
            return $ward['ward'];
        }
    }
}


function provider_name($providers, $id)
{
    foreach ($providers as $key => $provider) {
        if ($provider['id'] == $id) {
            return $provider['hcpname'];
        }
    }
}

?>
@extends('layouts/master')
@section('content-body')


<section>
    <form action="{{ route('enrolment.enrollees-by-provider-post') }}" method="post">
        {{ csrf_field() }}
        <fieldset id="vulnerability_wrap">
            <legend>Searh Enrollees </legend>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="surname">LGA </label>
                    <select class="form-control" onchange="load_ward_by_lga(this.value)" id="lga" name="lga">
                        <option value="">Select User lga</option>
                        @foreach($lgas as $lga)
                        <option value="{{$lga->id}}"> {{$lga->lga}}</option>
                        @endforeach

                    </select>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="surname">Ward<span class="asterik asterik_surname">*</span> </label>
                    <select class="form-control" id="ward" name="ward" onchange="load_provider_by_ward(this.value)">
                        <option value=""> Select ward </option>

                        @foreach($wards as $ward)
                        <option value="{{$ward->id}}">{{$ward->ward}}</option>

                        @endforeach
                    </select>
                </div>

            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="provider">CHOICE OF PROVIDER<span class="asterik asterik_choice_of_providers">*</span> </label>
                    <p><select class="form-control" name="provider" id="provider">
                            <option value=""> Select Provider</option>
                            @foreach($providers as $provider)
                            <option value="{{$provider->id}}">{{$provider->hcpname}}</option>

                            @endforeach
                        </select>
                    </p>
                </div>

            </div>
        </fieldset>
        <div><button class="btn btn-lg btn-primary " type="submit" style="display: block;width: 100%;">Load Enrollees</button></div>
    </form>

</section>
<br />
<br />


@include('layouts/error_success_message')

<form action="{{route('enrolment.move-enrollees-to-another-provider')}}" id="moveForm" method="POST">
    {{ csrf_field() }}
    <hr>
    @if(!empty($enrollees))

    <div class="alert alert-info">To carry out more operations on the loaded enrollees, please <a href="#bottom" onclick="window.scrollTo(0, document.body.scrollHeight);">click here</a> to scrooll down to the end of this page.</div>

    <div class="container">
        <table class="table table-bordered table-stripped">
            <tr>
                <th>SN <li><input id="selectAll" type="checkbox"><label for='selectAll'> All</label></li>
                </th>
                <th>NAME</th>
                <th>ENROLMENT NUMBER</th>
                <th>ENROLEE TYPE</th>
                <th>ENROLEE GROUP</th>
                <th>GENDER</th>
                <th>LGA</th>
                <th>WARD</th>
                <th></th>

            </tr>
            @foreach ($enrollees as $enrollee)
            <tr>
                <td>{{($loop->index + 1)}} <input type="checkbox" name="enrollees_id[]" id="$enrollee->id" value="{{$enrollee->id}}"></td>
                <td>{{$enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name}}</td>
                <td>{{$enrollee->enrolment_number}}</td>
                <td>{{$enrollee->enrolee_type}}</td>
                <td>{{$enrollee->enrolee_category}}</td>
                <td>{{$enrollee->sex}}</td>
                <td>{{lga_name($lgas, $enrollee->lga)}}</td>
                <td>{{ward_name($wards,$enrollee->ward)}}</td>
                <td class="text-center">
                    <button class="btn btn-info" title="View Enrolment Detials" onclick="load_enrollee_info({{$enrollee->id}})"><i class="fa fa-eye" style="color:#fff"></i></button>
                    <button class="btn btn-primary" title="Update Record" onclick="load_edit_enrollee_info({{$enrollee->id}})"><i class="fa fa-edit" style="color:#fff"></i></button>
                    <a href="{{route('enrolment.idcard',[base64_encode(base64_encode(base64_encode($enrollee->id)))])}}" target="_BLANK" class="btn btn-success" title="IdCard"><i class="fa fa-print" style="color:#fff"></i></a>
                </td>
            </tr>

            @endforeach
        </table>

        <hr>

        <h5>Move selected Enrollees to another provider</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">

                    <p><select class="form-control" name="provider_id" id="provider_id" required>
                            <option value=""></option>
                            @foreach($providers as $provider)
                            <option value="{{$provider->id}}">{{$provider->hcpname}}</option>

                            @endforeach
                        </select>
                    </p>
                </div>

            </div>
            <div class="col-md-6">
                <button class="btn btn-lg btn-primary" type="submit">Move Selected Enrollees to the selected Provider</button>
            </div>
        </div>
</form>
</div>
@endif
@include('layouts.modal');
@endsection
@section('scripts_section')
<script>
    $(document).ready(function() {
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
            }
        });

        $('#moveForm').submit(function(e) {
            e.preventDefault();

            let provider_id = $('#provider_id').val();
            if (provider_id == '') {
                alert('Please select provider')
            } else {
                if ($('input:checkbox:checked').length >= 1) {
                   // $("#moveForm").submit();
                   
                   var con = confirm('Are you sure  want to continue ?')
                   if(con){
                        document.getElementById('moveForm').method = 'post';
                    document.getElementById('moveForm').submit();
                   }
                   
                } else {
                    alert('No enrollee is selected')
                }
            }

        })


        function submitForm() {
            alert()
            if ($('input:checkbox:checked').length >= 1) {
                let provider_id = $('#provider_id').val();
                if (provider_id == '') {
                    alert('Please select provider')
                } else {
                    $("#moveForm").submit();
                }

            } else {
                alert('No enrollee is selected')
            }
        }


    });
</script>
<script>
    var wards = <?= json_encode($wards); ?>;
    var providers = <?= json_encode($providers); ?>;

    function load_ward_by_lga(lga) {
        let opt = '';
        wards.forEach(ward => {
            if (ward.lga_id == lga) {
                opt += '<option value="' + ward.id + '">' + ward.ward + '</option>';
            }

            $('#ward').html(opt);
        });
    }

    function load_provider_by_ward(ward) {
        let opt = '<option value=""> Select Provider</option>';
        providers.forEach(provider => {
            if (provider.hcpward == ward) {
                opt += '<option value="' + provider.id + '">' + provider.hcpname + '</option>';
            }

            $('#provider').html(opt);
        });
    }


    function update_enrollee_info(event) {
        event.preventDefault();
        //window.history.back();
        $('#feedback').html('<p style="color:red">Saving....</p>');

        $.ajax({
            type: 'POST',
            url: "/update-enrollee-info",
            data: $('#edit_enrolee_form_admin').serialize() + "&_token={{csrf_token()}}",
            //data:  {id:id, _token:'{{csrf_token()}}' },
            success: function(data) {
                if (data.status == 200)
                    $('#feedback').html('<p class="alert alert-success">' + data.message + '</p>');
                else
                    $('#feedback').html('<p class="alert alert-danger">' + data.message + '</p>');

            },
            error: function(data) {

                console.log(data);
            }
        })


    }




    function load_edit_enrollee_info(id) {
        $('#myModal').modal('show');
        $('#modal-footer').hide('slow');
        $.ajax({
            type: 'POST',
            url: "/load-edit-enrollee-info",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#modal-content').html(data.html);
            },
            error: function(data) {

                console.log(data);
            }
        })


    }


    function load_enrollee_info(id) {
        let biometric = false;
        $('#myModal').modal('show');
        $('#modal-footer').show('slow');
        $.ajax({
            type: 'POST',
            url: "/load-enrollee-info",
            data: {
                id: id,
                biometric: biometric,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#modal-content').html(data.html);
            },
            error: function(data) {

                console.log(data);
            }
        })


    }
</script>

@endsection