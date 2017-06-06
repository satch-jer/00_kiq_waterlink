$(document).ready(function(){

    $("#email").on("focusout", function(e){
        e.preventDefault();

        var email = $(this).val();

        $.post("php/mail.php", {email: email},
            function(result){
                if(result != 'null'){
                    $("#email_error").text(result);
                }
            }, "json"
        );
    })
});