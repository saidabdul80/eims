
        function searchA(ArrDAta, Arrkey, searchValue ){
            var indexPoint;            
             let value = ArrDAta.map(function(n,i){ 
                if (ArrDAta[i][Arrkey] == searchValue){                
                    indexPoint = i;
                     return ArrDAta[i].id;
                }
            });
            return value[indexPoint];
        }       
        
        function select_data_for_data(ArrData, commomKey,optvalue='id', selectTag1ID, selectTag2ID,outputName,outputNameShort=null, type=1,input2ID=null) {
            let a1, searchValue, result="", resultArray = [];
            searchValue = $('#'+selectTag1ID).val();

            for(a1 in ArrData){
                if (ArrData[a1][commomKey] == searchValue){
                    if (type==1){
                        if (outputNameShort==null) {
                            result += "<option "+"value='" +ArrData[a1][outputName]+"''>";
                        }else{
                            result += "<option "+"value='" +ArrData[a1][outputName]+" ("+ArrData[a1][outputNameShort]+")'>";
                        }
                    }else{
                        if (outputNameShort===null) {
                            result += "<option "+"value='" +ArrData[a1][optvalue]+"''>"+ ArrData[a1][outputName]+"</option>";                        
                        }else{
                            result += "<option "+"value='" +ArrData[a1][optvalue]+"''>" +ArrData[a1][outputName]+" ("+ArrData[a1][outputNameShort]+")</option>";                                                    
                        }
                    }
                    resultArray.push(ArrData[a1]);
                }
            }                 
            if (result != '') {
               if (input2ID != null) {                
                    $('#'+input2ID).css({'border':'1px solid #6b2', 'box-shadow':'1px 1px 10px #efc'});                                  
               }else{
                    $('#'+selectTag2ID).css({'border':'1px solid #6b2 !important', 'box-shadow':'1px 1px 3px #fffefe !important'});                  
               }               
               
                $('#'+selectTag2ID).html(result);
            }else{
              if (input2ID != null) {                
                    $('#'+input2ID).css({'border':'1px solid #b62', 'box-shadow':'1px 1px 13px #fec'});                                  
               }else{
                    $('#'+selectTag2ID).css({'border':'1px solid #ecb !important', 'box-shadow':'1px 1px 5px #fec !important'});                  
               } 
                $('#'+selectTag2ID).focus();
                $('#'+selectTag2ID).html();
                $('#'+selectTag2ID).css('border', '1px solid red');
            }     
            return resultArray;
        }
        function clearFunc(clear1= null,clear2=null, clear3=null, clear4= null, clear5 = null) {
            if (clear1 !=null){
                $('#'+clear1).val('');
                $('#'+clear1).attr('style','');
            }
            if (clear2 !=null){
                $('#'+clear2).val('');
                $('#'+clear2).attr('style','');
            }
            if (clear3 !=null){
                $('#'+clear3).val('');
                $('#'+clear3).attr('style','');
            }
            if (clear4 !=null){
                $('#'+clear4).val('');
                $('#'+clear4).attr('style','');
            }
            if (clear5 !=null){
                $('#'+clear5).val('');
                $('#'+clear5).attr('style','');
            }
        }