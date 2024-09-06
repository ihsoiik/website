$("#sendMail").on("click", function() {
    var email = $("#email").val().trim;
    var name = $("#name").val().trim;
    var phone = $("#phone").val().trim;
    var message = $("#message").val().trim;


    if(email == ""){
        $("#errorMess").text("ВВедите эмейл")
        return false;
    }else  if(name == ""){
        $("#errorMess").text("ВВедите имя")
        return false;
    }else  if(phone == ""){
        $("#errorMess").text("ВВедите телефон")
        return false;
    }else  if(message == ""){
        $("#errorMess").text("ВВедите сообщение")
        return false;
    }


    $("#errorMess").text("")

    $.ajax({
        url: 'ajax/mail.php',
        type: 'GET',
        cache: false,
        data: {'name' : name, 'email': email, 'phone':phone, 'message':message},
        dataType: 'html',
        beforeSend: function(){
            $("#sendMail").prop("disabled", true); 
        },
        success: function(data){
            if(!data)
                alert(Собщение_не_отправлено);
            else
                $("#mailForm").trigger("reset"); 

            $("#sendMail").prop("disabled", true); 
        }
    })

});