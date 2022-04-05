$(document).ready(function(){  
        
    const singUpForm = $('#singUp-form');
    // const singInForm = $('#singIn-form');
    // const singUpForm = document.getElementById("singUp-form");
    const singInForm = document.getElementById("singIn-form");

    // SignUp / Criar Conta
    $(singUpForm).submit(function( event ){
        event.preventDefault();

        v_FormSignUp(singUpForm);
        //     setTimeout(
        //         function() 
        //         {
        //             singUpForm.submit();
        //             console.log("Ok")
        //         }, 2000);
        // }
    });
    
    // SignIn / Entrar
    $(singInForm).submit(function( event ){ 
        v_FormSignIn(singInForm);
        event.preventDefault();
    });

});

async function v_FormSignUp(singUpForm) {
    
    // Variables    
    var nameInput       = $("#userName");
    var emailInput      = $("#userEmail");
    var passwordInput   = $("#userPassword");
    var personTypeInput = $("#userType");
    
    var submitForm = true;

    // Form Validations
    if (nameInput.val() === null || nameInput.val() === "") {
        $("#nameAlert").css('display', 'inline');

        $(nameInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#nameAlert").css('display', 'none');
        $(nameInput).removeAttr("style");
    }

    if (emailInput.val() === null || emailInput.val() === ""){
        $("#emailAlert").css('display', 'inline');

        $(emailInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#emailAlert").css('display', 'none');
        $(emailInput).removeAttr("style");
    }

    if (passwordInput.val() === null || passwordInput.val() === ""){
        $("#passwordAlert").css('display', 'inline');

        $(passwordInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#passwordAlert").css('display', 'none');
        $(passwordInput).removeAttr("style");
    }

    if (personTypeInput.val() === null || personTypeInput.val() === "" || personTypeInput.val() === "Tipo Pessoa"){
        $("#personTypeAlert").css('display', 'inline');

        $(personTypeInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#personTypeAlert").css('display', 'none');
        $(personTypeInput).removeAttr("style");
    }
    

    // all inputs are acceptables
    if (submitForm) {        
        // Check if E-mail already exists within DB
        var token         = "16663056-351e723be15750d1cc90b4fcd";
        var key           = "email";
        var value         = emailInput.val();

        var urlString     = "http://localhost/TG_MTC/BackendDevelopment/users.php/?token=" + token + "&key=" + key + "&value=" + value;
        
        var approveEmail;

        await $.ajax({
            url: urlString,
            method: 'GET', // 'type' could be used too
        }).done(function(response){            

            if (response.length > 0) {
                $("#emailAlert").text('E-mail já cadastrado');
                $("#emailAlert").css('display', 'inline');
                $(emailInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});
            } else if (response.length == 0 && response != null) {                
                singUpForm.submit();
            }
        }).fail(function(jqXHR, msg){
            approveEmail = false;
            console.log(jqXHR.status + ": " +  msg);            
        });

    } 
    else 
    {
        return submitForm;
    }
}

async function v_FormSignIn(singInForm) {
    
    // Variables    
    var emailInput      = $("#userEmail");
    var passwordInput   = $("#userPassword");
    
    var submitForm = true;

    // Form Validations
    if (emailInput.val() === null || emailInput.val() === "") {
        $("#emailAlert").css('display', 'inline');

        $(emailInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#emailAlert").css('display', 'none');
        $(emailInput).removeAttr("style");
    }

    if (passwordInput.val() === null || passwordInput.val() === ""){
        $("#passwordAlert").css('display', 'inline');

        $(passwordInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});

        submitForm = false;
    } else {
        $("#passwordAlert").css('display', 'none');
        $(passwordInput).removeAttr("style");
    }


    // all inputs are acceptables
    if(submitForm) {
        const formData = new FormData(singInForm);

        formData.append("action", "signIn");

        const data = await fetch("../../Controllers/c_user.php", {
            method: "POST",
            body: formData
        });

        const resposta = await data.json();
        
        console.log(resposta);
        
        if (resposta["erro"]){
            $("#passwordAlert").css('display', 'inline');
            $("#emailAlert").css('display', 'inline');
            
            $("#passwordAlert").text(resposta["msg"])
            $("#emailAlert").text(resposta["msg"])
    
            $(emailInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});
            $(passwordInput).css({'margin-bottom': '-15px','border': '1px solid #f64141'});
        }
    }
}