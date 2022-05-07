<?php
use App\Sessions;

$sessions = Sessions::all();
?>

@extends('layouts/master')

@section('breadcrumb','Dashboard')

@section('content-body')

@if (session()->exists('welcome'))

<hr />
<div class="alert alert-success"> {{ session('welcome')}} </div>
@endif

@if (session()->exists('message'))
<hr />
<div class="alert alert-success"> {!! session('message') !!} </div>
@endif
@if (session()->exists('error'))
<hr />
<div class="alert alert-danger"> {!! session('error') !!} </div>
@endif
<div >
    <br>
    <br>
    <div  class="jumbotron px-3 py-2 text-dark d-inline-block">::Manage Session</div>
    <div id="sessionApp">
        <div  class="w-100 display-none" style="height: 68vh;">
            <div btn-type="tpa_institution"  >
                    <div id="tpaData" class="row w-100 shadow pm">
                        <input type="text" class="form-control mx-auto serachX" placeholder="Search" style="width: 250px;">
                        <table class="table w-100" >
                            <thead>
                                <tr>
                                    <th style="width: 5%;">S/n</th>
                                    <th style="width: 45%;">Name</th>
                                    <th style="width: 25%;">Set Current</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="dataTablex">
                                <tr v-for="(session,index) in sessions">
                                    <td>@{{index+1}}</td>
                                    <td>@{{session.name}}</td>
                                    <td>
                                        <span  v-if="typeof(session.is_current) !== 'object' " class="badge bg-success">Current</span>
                                    </td>
                                    <td>                                        
                                            <form action="{{route('set_session')}}" method="GET" class="d-inline-block mx-1">
                                                <input type="text" :value="session.id" style="display: none;" name="id">
                                                <button type="submit" class="btn btn-success mx-1">set</button>
                                            </form>                                        

                                        <form action="{{route('delete_session')}}" method="GET" class="d-inline-block mx-1">
                                            <input type="text" :value="session.id" name="id" style="display: none;">
                                            <button type="submit" class="btn btn-danger mx-1">Delete</button>
                                        </form>                                        
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
            </div>
        
        </div>
    </div>
</div>



@endsection

@section('scripts_section')

<script>

    
var vuePayStack = Vue.createApp({
    data(){
        return{
            sessions:<?= json_encode($sessions) ; ?>,
            loading:true,
        }
    },
      computed: {
        totalNumber: function () {
           // return  store.getters.totalNumber
        },        
    },
    methods:{        
         

    },
    mounted(){
        let $this = this;
        $(document).ready(function(){
            $("#sessionApp div").removeClass("display-none");
        })
    }
  })  
  vuePayStack.mount('#sessionApp');
</script>
@endsection
<style>
    table tr td, tr th{
        font-size: 1em !important;
    }
    .display-none{
        display: none;
    }
</style>