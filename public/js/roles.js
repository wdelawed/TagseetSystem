function edit(id) {
    $.ajax({
        url: "roles/get/"+id , 
        method: "GET" 

    }).done(function (data){
        //first render the data 
        console.log("got the data") ;
        $("#updateModalContent").html(data)
        $("#updateItModal").modal('show') ; 
    })
}

function deleteFunc(_id,name) {
    console.log('delete fucntion called with values ',_id,name)
    $("#roleName").val(name) ;
    
    var deleteButton = document.getElementById("deleteButton") ;
    deleteButton.onclick= function(){
        deleteItem(_id) ;
    }
    $("#deleteModal").modal('show') ;
}

function deleteItem(id) {
    $.ajax({
        url: "roles/delete/"+id , 
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



function refresh(resultTableId){
    $.ajax({
        url : 'roles/refresh' , 
        method : "GET" 
    }).done(function(data){
        console.log("refreshing",data) ;
        $("#"+resultTableId).html(data) ; 
    }) ;
}