$('.error').hide();

$(document).ready(function(){

    //check input q1
    $("#vraag_een").on("focusout", function(e){
        e.preventDefault();

        if($(this).selectedIndex == 0){
            addError($(this), "Je moet wel antwoorden om te kunnen winnen ...");
        }else{
            removeError($(this));
        }
    });

    //check input q2
    $("#vraag_twee").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val())){
            addError($(this), "Doe een gokje!");
        }else{
            removeError($(this));
        }
    });

    //check input naam
    $("#naam").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val())){
            addError($(this), "Wij kennen graag jouw naam.");
        }else{
            removeError($(this));
        }
    });

    //check input voornaam
    $("#voornaam").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val())){
            addError($(this), "Wij kennen graag jouw voornaam.");
        }else{
            removeError($(this));
        }
    });

    //check input postcode
    $("#postcode").on("focusout", function(e){
        e.preventDefault();

        //check if empty
        if(checkEmpty($(this).val()) || ($(this).val().length != 4)){
            addError($(this), "Postcode is een verplicht numeriek veld van 4 karakters lang.");
        }else{
            removeError($(this));
        }
    });

    //check input email
    $("#email").on("focusout", function(e){
        e.preventDefault();

        //enable submit
        $("#submit").prop("disabled", false);

        //remove error styling
        removeError($(this));

        //value of inputfield
        var email = $(this).val();

        $.post("php/mail.php", {email: email},
            function(result){
                if(result != ""){
                    addError($("#email"), result);
                    //disable submit
                    $("#submit").prop("disabled", true);
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

        //do ajax submission
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'php/process.php',
            data: $(this).serialize(),
            encode: true
        }).done(function(data){
           if(data == 'true'){
               //reset form
               $('form')[0].reset();

               //disable submit
               $("#submit").prop("disabled", true);

               //show feedback
               $("#feedback_success").text("Woehoew, deelname voltooid!");
           }else{
               console.log(data);
               //set errormessages
               $.each(data, function(i,v){
                   if(i!="conditions"){
                       //display error messages
                       addError($("#" + i), v);
                   }

                   //for conditions error
                   if(i=="conditions"){
                       $("#conditions").addClass("error_border");
                       $("#conditions_error").text(v).show();
                   }
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

function removeError(errorfield){
    //remove border
    errorfield.removeClass('error_border');

    //make span invisible
    errorfield.next(".error").text("").hide();
}

function addError(errorfield, textmessage){
    //add error border
    errorfield.addClass('error_border');

    //make span visibile + show text
    errorfield.next(".error").text(textmessage).show();
}