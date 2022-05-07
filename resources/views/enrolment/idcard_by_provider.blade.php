
@extends('layouts/master')
@section('content-body')

  <br/>
  <br/>
<div class="container">
    <div class="alert alert-info">
        Select provider below to print ID of all enrollees whose choice of provider is selected.
    </div>
       <form action="{{route('enrolment.print-id-by-provider')}}" method="POST" >
			{{ csrf_field() }}
        <div class="row">
                <div class="col-md-6">
                    <select name="provider_id" id="provider_id" class="form-control">
                        <option value="">-- select provider --</option>
                        @foreach ($providers as $provider)
                            <option value="{{$provider->id}}">{{$provider->hcpname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary form-control">Print All ID card</button>
                </div>
        </div>
       </form>
           
   
</div>
   @include('layouts.modal');
@endsection
@section('scripts_section')
<script>

 
</script>

@endsection