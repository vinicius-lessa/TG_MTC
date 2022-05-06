$(document).ready(function(){    
    // Input Masks
    $('.cep').mask('00000-000');
    $('.phone_with_ddd').mask('(00) 00000-0000');
});

// Vars
const profileImgForm        = $('#profilepic-form');
const profileUpdateForm     = $('#profileUpdate-form');
const msgAlertErroProfile   = $("#msgAlertErroProfile");
const msgAlertErroUpdate    = $("#msgAlertErroUpdate");

var userName        = $("#userName");
var userPassword    = $("#userPassword");
var bioText         = $("#bio-text");
var userEmail       = $("#userEmail");
var userPhone       = $("#userPhone");
var userZipCode     = $("#userZipCode");
var userBirthday    = $("#userBirthday");
var userType        = $("#persontype");

const passLenghtMin = 6;

let spinnerWrapper          = document.querySelector('.spinner-wrapper'); // Loading Icon


$('#profile-image').on('change', function(){
    $(this).closest('form').submit();    
});

// New Image
profileImgForm.submit(async function( event ){
    event.preventDefault();

    // Start Loading Icon
    spinnerWrapper.style.display = 'flex';
    
    // Send Form to REST API
    const formData = new FormData(event.target); // All Form Values

    formData.append('token', '16663056-351e723be15750d1cc90b4fcd');
    formData.append('user_id', user_id);

    // Images
    var files = $('#profile-image')[0].files;
    
    if(files.length > 0 ){
        formData.append('file', files[0]);
    }

    // Read FormData
    // for (var p of formData) {
    //     let name = p[0];
    //     let value = p[1];
    
    //     console.log(name, value);
    // }

    // Send Post via POST to PHP
    const response = await fetch('http://localhost/TG_MTC/BackendDevelopment/users.php/?key=profilePic', {
        method: "POST",
        body: formData
    });

    const j_Response = await response.json();

    console.log(j_Response);

    setTimeout(function () {

        if(j_Response['error']){
            msgAlertErroProfile.html("<div class='alert alert-danger' role='alert' style='max-width: 350px'>Erro: " + j_Response['msg'] + "</div>");
            spinnerWrapper.style.display = 'none';
        } else {
            // window.alert("Imagem alterada com Sucesso!");
            window.alert("Sucesso: " + j_Response['msg']);
    
            // Recarrega PHP
            document.location.reload();            
        }
    }, 2000);

});

// Update User's Info
profileUpdateForm.submit(async function( event ){
    event.preventDefault();

    $('.cep').unmask();
    $('.phone_with_ddd').unmask();    

    var newZipCode = userZipCode.val();
    var newPhone = userPhone.val();

    $('.cep').mask('00000-000');
    $('.phone_with_ddd').mask('(00) 00000-0000');
    


    // Input: Nome
    if ( userName.val() === "" || userName.val() === null ) {
        msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Nome!</div>");        
        userName.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroUpdate.html("");
        userName.removeClass('is-invalid');
        userName.addClass('is-valid');
    }

    // Input: Senha    
    if ( userPassword.val().length < passLenghtMin ) {
        if ( userPassword.val() === "" || userPassword.val() === null ) {
            msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Senha!</div>");            
        } else {
            msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>A Senha deve ter pelo menos " + passLenghtMin + " Caracteres!</div>");            
        }
        userPassword.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroUpdate.html("");
        userPassword.removeClass('is-invalid');
        userPassword.addClass('is-valid');        
    }

    // Input: Email
    if ( userEmail.val() === "" || userEmail.val() === null ) {
        msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-mail!</div>");        
        userEmail.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroUpdate.html("");
        userEmail.removeClass('is-invalid');      
        userEmail.addClass('is-valid');
    }

    // Input: CEP
    if ( newZipCode.length != 8 ) {
        if ( newZipCode === "" || newZipCode === null ) {
            msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo CEP!</div>");
        } else {
            msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: CEP Incorreto!</div>");
        }
        userZipCode.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroUpdate.html("");
        userZipCode.removeClass('is-invalid');
        userZipCode.addClass('is-valid');
    }

    // Input: Tipo Pessoa
    if ( userType.val() === "" || userType.val() === null || userType.val() === "Tipo Pessoa") {
        msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de Pessoa!</div>");
        userType.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroUpdate.html("");
        userType.removeClass('is-invalid');
        userType.addClass('is-valid');        
    }

    // Input: CEP
    if ( newPhone.length < 10 || newPhone.length > 11 ) {

        msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Telefone Inválido!</div>");
        userPhone.addClass('is-invalid');

        return false;
    } else {
        msgAlertErroUpdate.html("");
        userPhone.removeClass('is-invalid');
        userPhone.addClass('is-valid');
    }

    // Start Loading Icon
    spinnerWrapper.style.display = 'flex';

    const formData = new FormData();

    formData.append("action"        , "UpdateProfile");    
    formData.append("user_id"       , user_id);        
    formData.append("userEmail"     , userEmail.val());
    formData.append("userZipCode"   , newZipCode);
    formData.append("userPassword" , userPassword.val());
    formData.append("userType"     , userType.val());
    formData.append("userName"     , userName.val());

    userBirthday.val()  != "" && formData.append("userBirthday" , userBirthday.val());
    userPhone.val()     != "" && formData.append("userPhone" , newPhone);
    bioText.val()       != "" && formData.append("bioText" , bioText.val());

    // Read formData
    // for (var p of formData) {
    //     let name = p[0];
    //     let value = p[1];
    //     console.log(name, value);        
    // }
    // return;

    // Send Post via POST to PHP
    const dados = await fetch("../../Controllers/c_user.php", {
        method: "POST",
        body: formData
    });

    const j_Response = await dados.json();

    console.log(j_Response);

    setTimeout(function () {
        if(j_Response['error']){
            msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: " + j_Response['msg'] + "</div>");
            
            // E-mail Already Registered
            if (j_Response['cod_erro'] == 1) {
                userEmail.addClass('is-invalid');
            }
            spinnerWrapper.style.display = 'none';
            return false;
        }
        spinnerWrapper.style.display = 'none';

        window.alert("Sucesso: " + j_Response['msg']);

        document.location.reload();
    }, 2000);
});


// DELETE USER'S TRADE POST
$('#confirm-delete').on('click', '#deleteButton', async function(e) {

    var $modalDiv = $(e.delegateTarget);
    
    // Loading
    document.querySelector("#closeModalBtn").style.display = "none";
    document.querySelector("#modalLoading").style.display = "flex";

    var token = '16663056-351e723be15750d1cc90b4fcd';
    var post_id = $("#deleteButton").data('postId'); // from HTML

    var formBody = [];
    var details={
         'token':token,
         'post_id':post_id
    };

    for (var property in details) {
          var encodedKey = encodeURIComponent(property);
          var encodedValue = encodeURIComponent(details[property]);
          formBody.push(encodedKey + "=" + encodedValue);
    }
    
    // Read formBody
    // for (var p of formBody) {
    //     let name = p[0];
    //     let value = p[1];
    //     console.log(name, value);        
    // }
    // return;

    const deleteMethod = {
        method: 'DELETE', // Method itself
        body: formBody.join("&") , // We send data in JSON format
        headers: {
         'Content-type': 'application/x-www-form-urlencoded' // Indicates the content 
        }        
       }

    const response = await fetch("http://localhost/TG_MTC/BackendDevelopment/trade_posts.php/", deleteMethod );

    const j_Response = await response.json();

    console.log(j_Response);    

    if ( j_Response.error ){
        console.log("Erro: " + j_Response.msg);
    } else {
        console.log("Sucesso: " + j_Response.msg);
        setTimeout(function () {                    
    
            document.querySelector("#modalLoading").style.display = "none";
    
            $modalDiv.modal('hide');
            
            document.location.reload();
    
        }, 2000);        
    }

});
  
// FORM Edit Events
$("#addHabilty").click(function(e) {
    if ( $("#hability-list").val() != "" ) {
        if ( $("#userHabilty-text").html() == "Adicione Novas Habilidades!" ) {
            $("#userHabilty-text").append( $("#hability-list option:selected").text() );
        } else {
            $("#userHabilty-text").append( ", " + $("#hability-list option:selected").text() );
        }
    }    
});

$("#addMusicStyle").click(function(e) {
    if ( $("#style-list").val() != "" ) {
        if ( $("#userStyles-text").html() == "Adicione Novos Gêneros!" ) {
            $("#userStyles-text").append( $("#style-list option:selected").text() );
        } else {
            $("#userStyles-text").append( ", " + $("#style-list option:selected").text() );
        }
    }
});

$("#edit-userName").click(function(e) {
    $("#userName").prop('disabled', false);
    $("#userName").focus();
});

$("#edit-password").click(function(e) {
    $("#userPassword").prop('disabled', false);
    $("#userPassword").focus();
});

$("#edit-bio").click(function(e) {
    $("#bio-text").prop('disabled', false);
    $("#bio-text").focus();
});

$("#edit-email").click(function(e) {    
    $("#userEmail").prop('disabled', false);
    $("#userEmail").focus();
});

$("#edit-phone").click(function(e) {
    $("#userPhone").prop('disabled', false);
    $("#userPhone").focus();
});

$("#edit-cep").click(function(e) {    
    $("#userZipCode").prop('disabled', false);
    $("#userZipCode").focus();
});

$("#edit-birthday").click(function(e) {
    $("#userBirthday").prop('disabled', false);
    $("#userBirthday").focus();
});

$("#edit-PersonType").click(function(e) {
    $("#persontype").prop('disabled', false);
    $("#persontype").focus();
});


function formatarCep(campo){

    var v=campo.value.replace(/D/g,"")                
  
    v=v.replace(/^(d{5})(d)/,"$1-$2") 
  
    campo.value = v;
  
}