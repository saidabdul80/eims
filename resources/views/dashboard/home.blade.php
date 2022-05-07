@extends('layouts/master')

@section('breadcrumb','Dashboard')
@section('content-body')
    @if (session()->exists('welcome'))
        <hr/> <div class="alert alert-success"> {{ session('welcome')}} </div>
    @endif
  
@endsection