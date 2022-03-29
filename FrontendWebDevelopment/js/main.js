$(document).ready(function(){  
    
    // SignUp / Criar Conta
    $('#signUp-btn').on('click', function(){ validForm(); });

});

function validForm() {
    // Variables
    
    var nameInput = $("#userName");
    var emailInput = $("#userEmail");
    var passwordInput = $("#userPassword");
    
    var submitForm = true;

    // Form Validations
    if (nameInput.val() == null || nameInput.val() == "") {
        $("#nameAlert").css('display', 'inline');

        $(nameInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#nameAlert").css('display', 'none');
        $(nameInput).removeAttr("style")
    }

    if (emailInput.val() == null || emailInput.val() == ""){
        $("#emailAlert").css('display', 'inline');

        $(emailInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#emailAlert").css('display', 'none');
        $(emailInput).removeAttr("style")
    }

    if (passwordInput.val() == null || passwordInput.val() == ""){
        $("#passwordAlert").css('display', 'inline');

        $(passwordInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#passwordAlert").css('display', 'none');
        $(passwordInput).removeAttr("style")
    }


    if (submitForm) 
    {        
        // Check if E-mail already exists within DB
        var token         = "16663056-351e723be15750d1cc90b4fcd";
        var key           = "email";
        var value         = emailInput.val();

        var urlString     = "http://localhost/TG_MTC/BackendDevelopment/users.php/?token=" + token + "&key=" + key + "&value=" + value;

        var approveEmail  = doAjax(urlString, 'GET');

        if (approveEmail){
            $('#singUp-form').submit();
        } else {
            $("#emailAlert").text('E-mail já cadastrado');
            $("#emailAlert").css('display', 'inline');
            $(emailInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});
        }
    } 
    else 
    {
        return submitForm;
    }
}

function doAjax(urlString, type) {    

    var result = false;

    if (type == 'GET') {        
        $.ajax({
            url: urlString,
            method: type, // method/type could be used
            async: false
        }).done(function(response){
            if (response.lenght > 0 || response != null) {
                result = false;                                
            }
        }).fail(function(jqXHR, textStatus, msg){
            if (msg == "Not Found") {                
                result = true;
            }
        });
    }

    return result;
}