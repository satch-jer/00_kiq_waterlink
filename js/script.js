$('.error').hide();

$(document).ready(function(){

    //errorfields as jquery objects
    var $naam_error = $("#naam_error");
    var $voornaam_error = $("#voornaam_error");
    var $postcode_error = $("#postcode_error");
    var $vraag_een_error = $('#vraag_een_error');
    var $vraag_twee_error = $('#vraag_twee_error');
    var $email_error = $('#email_error');

    //check input q2
    $("#vraag_twee").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val())){
            addErrorBorder($(this));
            $vraag_twee_error.text("Doe een gokje!").show();
        }else{
            removeErrorBorder($(this));
            $vraag_twee_error.text("").hide();
        }
    });


    //check input naam
    $("#naam").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val())){
            addErrorBorder($(this));
            $naam_error.text("Wij kennen graag jouw naam.").show();
        }else{
            removeErrorBorder($(this));
            $naam_error.text("").hide();
        }
    });

    //check input voornaam
    $("#voornaam").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val())){
            addErrorBorder($(this));
            $voornaam_error.text("Wij kennen graag jouw voornaam.").show();
        }else{
            removeErrorBorder($(this));
            $voornaam_error.text("").hide();
        }
    });

    //check input postcode
    $("#postcode").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val())){
            addErrorBorder($(this));
            $postcode_error.text("Postcode is een verplicht veld.").show();
        }else{
            removeErrorBorder($(this));
            $postcode_error.text("").hide();
        }
    });

    //check input email
    $("#email").on("focusout", function(e){
        e.preventDefault();

        var email = $(this).val();

        $.post("php/mail.php", {email: email},
            function(result){
                if(result != 'null'){
                    addErrorBorder($("#email"));
                    $email_error.text(result).show();
                }else{
                    $email_error.text("").hide();
                }
            }, "json"
        );
    });

    //full ajax submission
    $('form').submit(function(e) {
        //prevent default
        e.preventDefault();

        //reset errors
        $('.error').text("").hide();
        removeErrorBorder($('input'));

        //do ajax submission
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'php/process.php',
            data: $(this).serialize(),
            encode: true
        }).done(function(data){
           if(data == 'true'){
               $("#feedback_success").text("Woehoew, deelname voltooid!");
           }else{
               //set errormessages
               $.each(data, function(i,v){
                   //display error messages
                   var errorfield = "#" + i + "_error";
                   addErrorBorder($("#" + i));
                   $(errorfield).text(v).show();
               });
               //give focus to first 'error'
               var keys = Object.keys(data);
               $('#' + keys[0]).focus();
           }

        });
    });
});

function checkEmpty(inputvalue) {
    if(inputvalue == ""){
        return true;
    }else{
        return false;
    }
}

function removeErrorBorder(errorfield){
    errorfield.removeClass('error_border');
}

function addErrorBorder(errorfield){
    errorfield.addClass('error_border');
}