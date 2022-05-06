$(document).ready(function(){    

});

// Vars
const profileImgForm        = $('#profilepic-form');
const profileUpdateForm     = $('#profileUpdate-form');
const msgAlertErroProfile   = $("#msgAlertErroProfile");
const msgAlertErroUpdate    = $("#msgAlertErroUpdate");

var userBirthday    = $("#userBirthday");
var userEmail       = $("#userEmail");
var userPhone       = $("#userPhone");
var userZipCode     = $("#userZipCode");
var bioText         = $("#bio-text");

// Do later
// var userName            = $("#userName");
// var userType            = $("#userType");
// var userPassword    = $("#userPassword"); 

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

    // Validations (Do this later, about Formats, Lenght and Characters)
    // Input: Email
    if ( userEmail.val() === "" || userEmail.val() === null ) {
        msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-mail!</div>");
        $(userEmail).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroUpdate.html("");
        $(userEmail).removeAttr("style");
    }

    // Input: CEP
    if ( userZipCode.val() === "" || userZipCode.val() === null ) {
        msgAlertErroUpdate.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo CEP!</div>");
        $(userEmail).css({'border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroUpdate.html("");
        $(userZipCode).removeAttr("style");
    }

    // // Input: Nome
    // if ( userName.val() === "" || userName.val() === null ) {
    //     msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Nome!</div>");        
    //     $(userName).css({'border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroSignUp.html("");
    //     $(userName).removeAttr("style");
    // }

    // // Input: Senha
    // if ( userPassword.val() === "" || userPassword.val() === null ) {
    //     msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Senha!</div>");
    //     $(userPassword).css({'border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroSignUp.html("");
    //     $(userPassword).removeAttr("style");
    // }

    // // Input: Tipo Pessoa
    // if ( userType.val() === "" || userType.val() === null || userType.val() === "Tipo Pessoa") {
    //     msgAlertErroSignUp.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de Pessoa!</div>");
    //     $(userType).css({'border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroSignUp.html("");
    //     $(userType).removeAttr("style");
    // }

    // Start Loading Icon
    spinnerWrapper.style.display = 'flex';

    const formData = new FormData();

    formData.append("action"        , "UpdateProfile");    
    formData.append("user_id"       , user_id);        
    formData.append("userEmail"     , userEmail.val());
    formData.append("userZipCode"   , userZipCode.val());
    // formData.append("userPassword" , userPassword.val());
    // formData.append("userType"     , userType.val());
    // formData.append("userName"     , userName.val());

    userBirthday.val()  != "" && formData.append("userBirthday" , userBirthday.val());
    userPhone.val()     != "" && formData.append("userPhone" , userPhone.val());
    bioText.val()       != "" && formData.append("bioText" , bioText.val());

    // Read formData
    // for (var p of formData) {
    //     let name = p[0];
    //     let value = p[1];
    //     console.log(name, value);        
    // }
    // return;

    // Send Post via POST to PHP
    const dados = await fetch("../../../Controllers/c_user.php", {
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
                $(userEmail).css({'border': '2px solid #f64141'});
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