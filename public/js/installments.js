function getCommodity(id){
    $.ajax({
        method : 'GET' ,
        url : '/installments/getCommodity/'+id ,

    }).done(function(data){
        var x = data.split(',') ;
        var price = x[2] ;
        var description = x[1] ;
        var name  = x[0] ; 
        $("#description").val(description) ;
        $("#price").val(price) ;
        calculateTotal();
    }) ;
}

function calculateTotal(){
    console.log('calculating total') ;
    var interest = parseFloat($("#interest").val()) ;
    var price = parseFloat($('#price').val()) ;
    var managementFees = parseFloat($("#management_fees").val()) ;
    var taxes = 0.0 ;
    var firstPayment = parseFloat($("#first_payment").val());
    var duration = parseInt($("#duration").val()) ;

    if(duration === 0) 
        return ;

    var total = price*(1+interest) + managementFees - firstPayment ;

    $("#monthly_payment").val(total/duration) ;

    console.log("total is ",interest,price,managementFees,taxes,firstPayment,total,duration) ;

    $("#total").val(total) ;

    makeTable(total,duration) ;
}

function makeTable(total,duration) {
    var monthly = Math.floor(total/duration) ;
    var lastMonth = Math.floor(monthly + (total%duration)) ;
    var table = "<table  class='table table-bordered' width='100%'>\
                    <thead>\
                        <tr>\
                            <th>رقم</th>\
                            <th>التاريخ</th>\
                            <th>المبلغ</th>\
                            <th>الحالة</th>\
                        </tr>\
                    </thead>\
                    <tbody>" ;
    date = new Date() ;
    for (var i =0 ; i < duration ; i++) {
        table += "<tr>" ;
        if (i == duration -1){
            table +=   "<td>"+(i+1)+"</td>\
                        <td>"+formatDate(date)+"</td>\
                        <td>"+lastMonth+"</td>\
                        <td>جديد</td>" ;
        }else {
            table +=   "<td>"+(i+1)+"</td>\
                        <td>"+formatDate(date)+"</td>\
                        <td>"+monthly+"</td>\
                        <td>جديد</td>" ;
        }
        table += "</tr>" ;
        date.setMonth(date.getMonth()+1) ;
    }
    table += "</tbody></table>" ;

    $("#scheduleTableHolder").html(table) ;

}

function formatDate(dat) {
    var year = dat.getFullYear() ; 
    var month = dat.getMonth() ; 
    var day = dat.getDate() ;
    
    return year+"/"+padd(month+1) + "/" + padd(day) ;
}
function padd(n) {
    return n<10? '0'+n : n ;
}

function paySchedule(id){
    $.ajax({
        url : "/installments/getSchedule/"+id , 
        method : "get" , 

    }).done(function(data){
        $("#dataHolder").html(data) ;
        $("#payModal").modal('show') ;
        console.log("Showing payment modal") ;
    })
}

function getSchedule(id){
    $.ajax({
        url : "/installments/getSchedule/"+id , 
        method : "get" , 

    }).done(function(data){
        $("#dataHolder").html(data) ;
       // $("#payModal").modal('show') ;
        console.log("Showing payment modal") ;
    })
}

function submitForm(formId){
    $.ajax({
        url : '/installments/pay' , 
        data : $("#"+formId).serialize() , 
        method : "POST" 
    }).done(function(data){
        //$("#"+formId).html(data) ;
        $("#dataHolder").html(data) ;
        console.log("payment done", data,resultTableId) ;
    }) ; 
}

function choose(type){
    if(type) {
        $("#bank_id")[0].disabled = false ; 
        $("#receipt")[0].disabled = false ; 
        return ;
    }
    $("#bank_id")[0].disabled = true ; 
    $("#receipt")[0].disabled = true ; 
}