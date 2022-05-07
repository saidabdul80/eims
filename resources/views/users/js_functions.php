<script type="text/javascript">
    

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
        
        function select_data_for_data(ArrData, commomKey,optvalue='id', selectTag1ID, selectTag2ID,outputName,outputNameShort=null, type=1) {
            let a1, searchValue, result="", resultArray = [];
            searchValue = $('#'+selectTag1ID).val();

            for(a1 in ArrData){
                if (ArrData[a1][commomKey] == searchValue){
                    if (type==1){
                        if (outputNameShort===null) {
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
            $('#'+selectTag2ID).html(result);
            return resultArray;
        }
        function clearFunc(clear1= null,clear2=null, clear3=null, clear4= null, clear5 = null) {
            if (clear1 !=null){
                $('#'+clear1).val('');
            }
            if (clear2 !=null){
                $('#'+clear2).val('');
            }
            if (clear3 !=null){
                $('#'+clear3).val('');
            }
            if (clear4 !=null){
                $('#'+clear4).val('');
            }
            if (clear5 !=null){
                $('#'+clear5).val('');
            }
        }
</script>