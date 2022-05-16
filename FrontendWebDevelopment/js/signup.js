$(document).ready(function(){    
    // Input Masks
    $('.cep').mask('00000-000');
    $('.phone_with_ddd').mask('(00) 00000-0000');
});


// Vars
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

    $('.cep').unmask();
    $('.phone_with_ddd').unmask();    

    var newZipCode = userZipCode.val();
    var newPhone = userPhone.val();

    $('.cep').mask('00000-000');
    $('.phone_with_ddd').mask('(00) 00000-0000');

    // Input: Nome
    if ( userName.val() === "" || userName.val() === null ) {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Nome!</div>");
        userName.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroSignUp.html("");
        userName.removeClass('is-invalid');
        userName.addClass('is-valid');
    }

    // Input: Email
    if ( userEmail.val() === "" || userEmail.val() === null ) {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o E-mail!</div>");        
        userEmail.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroSignUp.html("");
        userEmail.removeClass('is-invalid');
        userEmail.addClass('is-valid');
    }

    // Input: Senha
    if ( userPassword.val().length < passLenghtMin ) {
        if ( userPassword.val() === "" || userPassword.val() === null ) {
            msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Senha!</div>");
        } else {
            msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>A Senha deve ter pelo menos " + passLenghtMin + " Caracteres!</div>");
        }
        userPassword.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroSignUp.html("");
        userPassword.removeClass('is-invalid');
        userPassword.addClass('is-valid');
    }

    // Input: Tipo Pessoa
    if ( userType.val() === "" || userType.val() === null || userType.val() === "Tipo Pessoa") {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de Pessoa!</div>");
        userType.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroSignUp.html("");
        userType.removeClass('is-invalid');
        userType.addClass('is-valid');
    }

    // Input: CEP
    if ( userZipCode.val() === "" || userZipCode.val() === null || userZipCode.val() === "Tipo Pessoa") {
        msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o CEP!</div>");
        userZipCode.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroSignUp.html("");        
        userZipCode.removeClass('is-invalid');
        userZipCode.addClass('is-valid');        
    }

    spinnerWrapper.style.display = 'flex';
    
    const dadosForm = new FormData();

    dadosForm.append("action"       , "SignUp");
    dadosForm.append("userName"     , userName.val());
    dadosForm.append("userEmail"    , userEmail.val());
    dadosForm.append("userPassword" , userPassword.val());
    dadosForm.append("userType"     , userType.val());
    dadosForm.append("userBirthday" , userBirthday.val());
    dadosForm.append("userPhone"    , newPhone);
    dadosForm.append("userZipCode"  , newZipCode);

    // Send Post via POST to PHP
    const dados = await fetch( frontEndURL + "/Controllers/c_user.php", {
        method: "POST",
        body: dadosForm
    });

    const resposta = await dados.json();

    console.log(resposta);

    // return false;

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