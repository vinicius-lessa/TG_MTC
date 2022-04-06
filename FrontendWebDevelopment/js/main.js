// $(document).ready(function(){
// });

const loginForm         = $("#singIn-form");
const msgAlertErroLogin = $("#msgAlertErroLogin");

var userEmail           = $("#userEmail");
var userPassword        = $("#userPassword");
var submitForm          = true;

let spinnerWrapper = document.querySelector('.spinner-wrapper');

// SignIn / Entrar
loginForm.submit(async function( event ){
    event.preventDefault();

    if (userEmail.val() === "") {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>");        
        $(userEmail).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userEmail).removeAttr("style");
    }

    if (userPassword.val() === "") {
        msgAlertErroLogin.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>");
        $(userPassword).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroLogin.html("");
        $(userPassword).removeAttr("style");
    }

    // Loading Icon
    spinnerWrapper.style.display = 'flex';    
    
    const dadosForm = new FormData();

    dadosForm.append("action", "SignIn");
    dadosForm.append("userEmail", userEmail.val());
    dadosForm.append("userPassword", userPassword.val());    

    

    const dados = await fetch("../../Controllers/c_user.php", {
        method: "POST",
        body: dadosForm
    });

    const resposta = await dados.json();

    console.log(resposta);

    if(resposta['erro']){
        msgAlertErroLogin.html(resposta['msg']);
    // }else{
    //     document.getElementById("dados-usuario").innerHTML = "Bem vindo " + resposta['dados'].nome + "<br><a href='sair.php'>Sair</a><br>";
    //     loginForm.reset();
    //     loginModal.hide();
    } else {        
        setTimeout(function () {
            spinnerWrapper.style.display = 'none';
            // spinnerWrapper.parentElement.removeChild(spinnerWrapper);
            document.location.reload();
        }, 2000);
    }
});

