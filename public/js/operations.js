
function search(searchFormId, resultTableId) {
    $.ajax({
        url : 'oplog/search' , 
        data : $("#"+searchFormId).serialize() , 
        method : "POST" 
    }).done(function(data){
        $("#"+resultTableId).html(data) ;
        console.log("search done", data,resultTableId) ;
    }) ;  
}

