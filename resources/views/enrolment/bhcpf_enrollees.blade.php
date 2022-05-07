

@extends('layouts/master')

@section('content-body')



  <br/>

  <br/>

<div class="container">

   

       <form action="{{route('enrolment.get-bhcpf-enrollees')}}" method="POST" >

			{{ csrf_field() }}

        <div class="row">

                <div class="col-md-6">

                    <select name="category" id="category" class="form-control">

                        <option value="All">All categories </option>
                        <option value="Children under 5yrs">Children under 5yrs</option>
                        <option value="Female Reproductive (15-45 years)">Female Reproductive (15-45 years)</option>
                        <option value="Elderly (85 and above)">Elderly (85 and above)</option>
                        <option value="Others">Others</option>

                    </select>

                </div>

                <div class="col-md-6">

                    <button class="btn btn-primary form-control">Load List</button>

                </div>

        </div>

       </form>

           

   

</div>
<br>
<hr>
<br>
@if($enrollees != null)
<div class="container">
<table class="table table-bordered table-stripped">
            <tr>
                <th>SN</th>
                <th>NAME</th>
                <th>ENROLLEE ID</th>
                <hd>CATEGORY</hd>
                <th>SEX</th>
                <th>DOB</th>
            </tr>

            @foreach ($enrollees as $enrollee)

                <tr id="row_{{$enrollee->id}}">

                    <td>{{($loop->index + 1)}}</td>

                    <td>{{$enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name}}</td>

                    <td>{{$enrollee->enrolment_number}}</td>

                    <td class="text-center">{{$enrollee->vulnerability_status}}</td>

                    <td class="text-center">{{$enrollee->sex}}</td>

                    <td class="text-center">{{$enrollee->date_of_birth}}</td>

                </tr>
            @endforeach

    </table>
</div>
@endif

   

@endsection

@section('scripts_section')

<script>



 

</script>



@endsection