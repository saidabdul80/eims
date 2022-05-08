<?php


?>
<form method="get" action="{{route($routename)}}">
                    <div class="group-input row">
                        <div class="col-md-3">
                            <label>Institution:</label>                            
                            <select class="form-control ht4" name="institution_id"> 
                                @foreach($institutions  as $institution)                               
                                    <option value="{{$institution->id}}"  {{ ($session->id == $sel_institution_id)? 'selected':''}}>{{$institution->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Session:</label> 
                            <select name="session_id" class="form-control ht4">
                                @foreach($sessions as $session)                               
                                    <option value="{{$session->id}}" {{ ($session->id == $sel_session_id)? 'selected':''}}>{{$session->name}}</option>
                                @endforeach
                            </select>                        
                        </div>
                        <div class="col-md-3">
                            <label>Search:</label> <input  type="text" class="form-control adx ht4" name="search"><br>
                        </div>
                        <div class="col-md-3" style="display: flex;justify-content:space-between;align-items:center;">                            
                            <button type="submit" class=" mt-2 btn btn-primary add ht4">Go</button>  
                            <div class="mt-2 mr-2">
                                {{$dataList->from}} - {{$dataList->to}} of {{$dataList->total}}
                                @if($dataList->prev_page_url != null)
                                <a  href="{{$dataList->prev_page_url}}" class="btn btn-primary fa fa-chevron-left" style="border-radius: 50% !important;"></a>    
                                @else
                                <button disabled class="btn btn-primary fa fa-chevron-left" style="border-radius: 50% !important;"></button>    
                                @endif

                                @if($dataList->next_page_url != null)
                                    <a href="{{$dataList->next_page_url}}" class="btn btn-primary fa fa-chevron-right" style="border-radius: 50% !important;"></a>    
                                @else
                                    <button disabled class="btn btn-primary fa fa-chevron-right" style="border-radius: 50% !important;"></button>    
                                @endif
                            </div>                      
                        </div>                        
                    </div>
                </form>
                            