$(document).ready(function(){    
    // Input Masks
    $('.money').mask('000.000.000.000.000,00', {reverse: true});

});

// Functions
function readURL(imgInput) {
    if (imgInput.files && imgInput.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#imagePreview1')
          .attr('src', e.target.result)
          .width(150)
          .height(200);
      };
      reader.readAsDataURL(imgInput.files[0]);
    }
}


// SignUp Page vars
const signUpForm        = $("#singUp-form");
const msgAlertErroSignUp= $("#msgAlertErroSignUp");

var userName            = $("#userName");
var userType            = $("#userType");
var userBirthday        = $("#userBirthday");
var userPhone           = $("#userPhone");
var userZipCode         = $("#userZipCode");

// Login Page vars
const loginForm         = $("#singIn-form");
const msgAlertErroLogin = $("#msgAlertErroLogin");

// Generic Vars
var userEmail           = $("#userEmail");
var userPassword        = $("#userPassword");
let spinnerWrapper      = document.querySelector('.spinner-wrapper'); // Loading Icon

// New TradePost Page vars
const insertTPForm      = $("#insertTP-form");
const msgAlertErroTPF   = $("#msgAlertErroTPF"); // TPF = Trade Post Form

var title               = $("#title");
var category            = $("#category");
var brand               = $("#brand");
var model               = $("#model");
var color               = $("#color");
var price               = $("#price");
var description         = $("#description");
var productCondition    = $('input[name=productCondition]:checked', insertTPForm);
var possuiNF            = $('input[name=possuiNF]:checked', insertTPForm);


// Submit SignUp
signUpForm.submit(async function( event ){
    event.preventDefault();

    // Input: Nome
    if ( userName.val() === "" || userName.val() === null ) {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Nome!</div>");        
        $(userName).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userName).removeAttr("style");
    }

    // Input: Email
    if ( userEmail.val() === "" || userEmail.val() === null ) {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o E-mail!</div>");
        $(userEmail).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userEmail).removeAttr("style");
    }

    // Input: Senha
    if ( userPassword.val() === "" || userPassword.val() === null ) {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Senha!</div>");
        $(userPassword).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userPassword).removeAttr("style");
    }

    // Input: Tipo Pessoa
    if ( userType.val() === "" || userType.val() === null || userType.val() === "Tipo Pessoa") {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de Pessoa!</div>");
        $(userType).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userType).removeAttr("style");
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
            msgAlertErroLogin.html(resposta['msg']);
            if (resposta['cod_erro'] == 1) {
                $(userEmail).css({'border': '2px solid #f64141'});
            }

        } else {
            // Recarrega PHP
            document.location.reload();
            
            // Review at "examples":
            // document.getElementById("dados-usuario").innerHTML = "Bem vindo " + resposta['dados'].nome + "<br><a href='sair.php'>Sair</a><br>";
            // loginForm.reset();
            // loginModal.hide();
        }

        // Desabilita Loading
        spinnerWrapper.style.display = 'none';
        // spinnerWrapper.parentElement.removeChild(spinnerWrapper);
    }, 2000);
});

// Submit SignIn
loginForm.submit(async function( event ){
    event.preventDefault();

    if ( userEmail.val() === "" || userEmail.val() === null ) {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>");        
        $(userEmail).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userEmail).removeAttr("style");
    }

    if ( userPassword.val() === "" || userPassword.val() === null ) {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>");
        $(userPassword).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userPassword).removeAttr("style");
    }
    
    spinnerWrapper.style.display = 'flex';    
    
    const dadosForm = new FormData();

    dadosForm.append("action", "SignIn");
    dadosForm.append("userEmail", userEmail.val());
    dadosForm.append("userPassword", userPassword.val());

    // Send Post via POST to PHP
    const dados = await fetch("../../Controllers/c_user.php", {
        method: "POST",
        body: dadosForm
    });

    const resposta = await dados.json();

    console.log(resposta);

    setTimeout(function () {

        if(resposta['erro']){
            msgAlertErroLogin.html(resposta['msg']);
        } else {
            // Recarrega PHP
            document.location.reload();
            
            // Review at "examples":
            // document.getElementById("dados-usuario").innerHTML = "Bem vindo " + resposta['dados'].nome + "<br><a href='sair.php'>Sair</a><br>";
            // loginForm.reset();
            // loginModal.hide();
        }

        // Desabilita Loading
        spinnerWrapper.style.display = 'none';
        // spinnerWrapper.parentElement.removeChild(spinnerWrapper);
    }, 2000);    
});