$(document).ready(function(){
    // Input Masks
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
});

// Functions

// NewTradePost Image Preview
// function readURL(imgInput) {
//     if (imgInput.files && imgInput.files[0]) {
//       var reader = new FileReader();
//       reader.onload = function (e) {
//         $('#imagePreview1')
//           .attr('src', e.target.result)
//           .width(150)
//           .height(200);
//       };
//       reader.readAsDataURL(imgInput.files[0]);
//     }
// }

// Vars
const newTradePostForm  = $("#newTradePost-form");
const msgAlertErroPost  = $("#msgAlertErroPost");

var title               = $("#title");
var category            = $("#category");
var brand               = $("#brand");
var model               = $("#model");
var color               = $("#color");
var price               = $("#price");
var description         = $("#description");
var p_condition         = $('input[name=p_condition]:checked', newTradePostForm);
var possuiNF            = $('input[name=possuiNF]:checked', newTradePostForm);

// Generic
let spinnerWrapper      = document.querySelector('.spinner-wrapper'); // Loading Icon


// New Post Submit
newTradePostForm.submit(async function( event ){
    event.preventDefault();    

    if ( title.val() === "" || title.val() === null ) {
        msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Título!</div>");
        $(title).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroPost.html("");
        $(title).removeAttr("style");
    }

    if ( category.val() === "" || category.val() === null ) {
        msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Categoria do Item!</div>");
        $(category).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroPost.html("");
        $(category).removeAttr("style");
    }

    if ( brand.val() === "" || brand.val() === null ) {
        msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Marca do Item!</div>");
        $(brand).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroPost.html("");
        $(brand).removeAttr("style");
    }    

    if ( model.val() === "" || model.val() === null ) {
        msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Modelo do Item!</div>");
        $(model).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroPost.html("");
        $(model).removeAttr("style");
    }

    if ( p_condition.val() === "" || p_condition.val() === null ) {
        msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar a Condição de Uso!</div>");
        $(p_condition).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroPost.html("");
        $(p_condition).removeAttr("style");
    }

    if ( price.val() === "" || price.val() === null ) {
        msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário o Valor do Item!</div>");
        $(price).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroPost.html("");
        $(price).removeAttr("style");
    }

    if ( possuiNF.val() === "" || possuiNF.val() === null ) {
        msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário informar se possui NF!</div>");
        $(possuiNF).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

        return false;
    } else {
        msgAlertErroPost.html("");
        $(possuiNF).removeAttr("style");
    }

    // Start Loading Icon
    spinnerWrapper.style.display = 'flex';

    // Get USER_ID
    var myHeaders = new Headers();

    var myInit = { 
        method: 'GET',
        headers: myHeaders,
        mode: 'cors',
        cache: 'default'
    };

    const r_UserData = await fetch("../../Controllers/c_user.php/?key=user_info" , myInit);
    
    const j_userData = await r_UserData.json();
    var user_id      = j_userData.user_id;
    
    // Send Form to REST API
    const formData = new FormData(event.target); // All Form Values

    formData.append('token', '16663056-351e723be15750d1cc90b4fcd');
    formData.append('user_id', user_id);
    formData.set("price", parseFloat(price.val().replace(',', '.')));

    // Images
    var files = $('#image-upload')[0].files;
    
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
    const response = await fetch('http://localhost/TG_MTC/BackendDevelopment/trade_posts.php/upload.php', {
        method: "POST",
        body: formData
    });

    const j_Response = await response.json();

    console.log(j_Response);

    setTimeout(function () {

        if(j_Response['error']){        
            msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: " + j_Response['msg'] + "</div>");
            spinnerWrapper.style.display = 'none';
        } else {
            // window.alert("Anúncio incluído com sucesso!");
            window.alert("Sucesso: " + j_Response['msg']);

            // Desabilita Loading
            spinnerWrapper.style.display = 'none';
            // spinnerWrapper.parentElement.removeChild(spinnerWrapper);
    
            window.location.replace("http://localhost/TG_MTC/FrontEndWebDevelopment/Views/users/user_posts.php");
        }
    }, 2000);    

});