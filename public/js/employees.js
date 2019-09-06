function edit(id) {
    $.ajax({
        url: "employees/get/"+id , 
        method: "GET" 

    }).done(function (data){
        //first render the data 
        console.log("got the data") ;
        $("#updateModalContent").html(data)
        $("#updateItModal").modal('show') ; 
    })
}

function deleteFunc(_id,name,identityNum) {
    $("#employeeName").val(name) ;
    $("#identityCard").val(identityNum) ;
    var deleteButton = document.getElementById("deleteButton") ;
    deleteButton.onclick= function(){
        deleteItem(_id) ;
    }
    $("#deleteModal").modal('show') ;
}

function deleteItem(id) {
    $.ajax({
        url: "employees/delete/"+id , 
        method: "GET" 

    }).done(function (data){
        //first render the data 
        //$("#updateModalContent").html = data ; 
        //$("#updateModal").modal('show') ; 
        $('#deleteModal').modal('hide') ;
        refresh("searchResult") ;
    })
}

function submitForm(formId,modalId){
    var form = document.getElementById(formId)
    var formData = new FormData(form) ; 
    var request = new XMLHttpRequest() ;
    request.open(form.method,form.action) ; 
    request.onreadystatechange = function(){
        if (request.readyState == 4) {
            if (request.status == 200) {
                //submit is successful 
                console.log("Submitted form ",form,request.responseText) ;
                if(modalId) {
                    $("#"+modalId).modal('hide') ;
                }
                refresh("searchResult") ;
            }
        }
    }
    request.onerror = function () {
        console.log("Error Submitting the form") ;
        alert('error while submitting the form') ;
        if(modalId) {
            $("#"+modalId).modal('hide') ;
        }
    }
    request.send(formData) ;
}

function search(searchFormId, resultTableId) {
    $.ajax({
        url : 'employees/search' , 
        data : $("#"+searchFormId).serialize() , 
        method : "POST" 
    }).done(function(data){
        $("#"+resultTableId).html(data) ;
        console.log("search done", data,resultTableId) ;
    }) ;  
}

function refresh(resultTableId){
    $.ajax({
        url : 'employees/refresh' , 
        method : "GET" 
    }).done(function(data){
        console.log("refreshing",data) ;
        $("#"+resultTableId).html(data) ; 
    }) ;
}