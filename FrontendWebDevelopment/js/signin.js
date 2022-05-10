// $(document).ready(function(){

// });

// Login Page vars
const loginForm         = $("#singIn-form");
const msgAlertErroLogin = $("#msgAlertErroLogin");

var userEmail           = $("#userEmail");
var userPassword        = $("#userPassword");

// Generic
let spinnerWrapper      = document.querySelector('.spinner-wrapper'); // Loading Icon


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
    const dados = await fetch( frontEndURL + "/Controllers/c_user.php", {
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
        }
        
        spinnerWrapper.style.display = 'none';        
    }, 2000);    
});