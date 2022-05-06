// $(document).ready(function(){

// });


// SignUp Page vars
const signUpForm        = $("#singUp-form");
const msgAlertErroSignUp= $("#msgAlertErroSignUp");

var userName            = $("#userName");
var userType            = $("#userType");
var userBirthday        = $("#userBirthday");
var userEmail           = $("#userEmail");
var userPassword        = $("#userPassword");
var userPhone           = $("#userPhone");
var userZipCode         = $("#userZipCode");

// Generic Vars
let spinnerWrapper      = document.querySelector('.spinner-wrapper'); // Loading Icon


// Submit SignUp
signUpForm.submit(async function( event ){
    event.preventDefault();

    // Input: Nome
    if ( userName.val() === "" || userName.val() === null ) {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Nome!</div>");        
        $(userName).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroSignUp.html("");
        $(userName).removeAttr("style");
    }

    // Input: Email
    if ( userEmail.val() === "" || userEmail.val() === null ) {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o E-mail!</div>");
        $(userEmail).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroSignUp.html("");
        $(userEmail).removeAttr("style");
    }

    // Input: Senha
    if ( userPassword.val() === "" || userPassword.val() === null ) {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Senha!</div>");
        $(userPassword).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroSignUp.html("");
        $(userPassword).removeAttr("style");
    }

    // Input: Tipo Pessoa
    if ( userType.val() === "" || userType.val() === null || userType.val() === "Tipo Pessoa") {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de Pessoa!</div>");
        $(userType).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroSignUp.html("");
        $(userType).removeAttr("style");
    }

    // Input: CEP
    if ( userZipCode.val() === "" || userZipCode.val() === null || userZipCode.val() === "Tipo Pessoa") {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o CEP!</div>");
        $(userZipCode).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroSignUp.html("");
        $(userZipCode).removeAttr("style");
    }    

    spinnerWrapper.style.display = 'flex';    
    
    const dadosForm = new FormData();

    dadosForm.append("action"       , "SignUp");
    dadosForm.append("userName"     , userName.val());
    dadosForm.append("userEmail"    , userEmail.val());
    dadosForm.append("userPassword" , userPassword.val());
    dadosForm.append("userType"     , userType.val());
    dadosForm.append("userBirthday" , userBirthday.val());
    dadosForm.append("userPhone"    , userPhone.val());
    dadosForm.append("userZipCode"  , userZipCode.val());

    // Send Post via POST to PHP
    const dados = await fetch("../../Controllers/c_user.php", {
        method: "POST",
        body: dadosForm
    });

    const resposta = await dados.json();

    console.log(resposta);

    setTimeout(function () {

        if(resposta['erro']){
            msgAlertErroSignUp.html(resposta['msg']);
            
            // User Already Exists
            if (resposta['cod_erro'] == 1) {
                $(userEmail).css({'border': '2px solid #f64141'});
            }

        } else {
            // Recarrega PHP
            document.location.reload();
        }

        // Desabilita Loading
        spinnerWrapper.style.display = 'none';
        // spinnerWrapper.parentElement.removeChild(spinnerWrapper);
    }, 2000);
});