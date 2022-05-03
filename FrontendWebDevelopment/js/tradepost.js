/**
 * File DOC
 * 
 * Description Arquivo .js criado a parte para tratar da Inclusão de Novos Anúncios ao sistema.
 * ChangeLog 
 *  - Vinícius Lessa - 28/04/2022: Criação do arquivo a partir do antigo "main.js" e início da implementação da tratativa dos campos 'Categoria', 'Marca', 'Modelo' e 'Cores'.
 *  - Vinícius Lessa - 01/05/2022: Implementação do CRUD de ALTERAÇÃO/UPDADE de um anúncio Existente.
 * @ Notes: 
 * 
 */

$(document).ready(function(){
    // Input Masks
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
});


// Vars
const newTradePostForm  = $("#newTradePost-form");
const msgAlertErroPost  = $("#msgAlertErroPost");

const brandSelector = $("#brand");
const modelSelector = $("#model");

var title           = $("#title");
var category        = $("#category");
var brand           = $("#brand");
var model           = $("#model");
var color           = $("#color");
var price           = $("#price");
var description     = $("#description");
var p_condition     = $('input[name=p_condition]:checked', newTradePostForm);
var possuiNF        = $('input[name=possuiNF]:checked', newTradePostForm);

var imageOne        = $("#image-upload-one");
var imageTwo        = $("#image-upload-two");
var imageThree      = $("#image-upload-three");

// Generic
let spinnerWrapper      = document.querySelector('.spinner-wrapper'); // Loading Icon


// if ( isUpdate ){
    // $("#img").attr("src",response);

    // document.querySelector("#image-preview-box-one .image-preview-text").style.setProperty("display", "none", "important");
    // document.querySelector("#image-preview-box-two .image-preview-text").style.setProperty("display", "none", "important");

    // $("#image-preview-box-one .img-newTP-upload").show();
    // $("#image-preview-box-two .img-newTP-upload").show();
// };


// Events

imageOne.change(function(event) {
    imageOne.src = URL.createObjectURL(event.target.files[0]);

    var newHtml = 
    "<div class='img-newTP-upload position-relative h-100 p-0'>" +
        "<div class='img-default-content img_background_blur m-0' style='background-image: url(" + imageOne.src + ");'>" +
        "</div>" +
        "<div class='img-default-content m-0'>" +
            "<img src='" + imageOne.src + "' class='img-tag-tp-default' alt=''>" +
        "</div>" +
    "</div>";

    document.querySelector("#image-preview-box-one .image-preview-text").style.setProperty("display", "none", "important");

    $("#image-preview-box-one").append( function() {
        return newHtml;
    });

    imageOne.onload = function() {
        URL.revokeObjectURL(imageOne.src) // free memory
    }
});

imageTwo.change(function(event) {
    imageTwo.src = URL.createObjectURL(event.target.files[0]);

    var newHtml =
    "<div class='img-newTP-upload position-relative h-100 p-0'>" +
        "<div class='img-default-content img_background_blur m-0' style='background-image: url(" + imageTwo.src + ");'>" +
        "</div>" +
        "<div class='img-default-content m-0'>" +
            "<img src='" + imageTwo.src + "' class='img-tag-tp-default' alt=''>" +
        "</div>" +
    "</div>";

    document.querySelector("#image-preview-box-two .image-preview-text").style.setProperty("display", "none", "important");

    $("#image-preview-box-two").append( function() {
        return newHtml;
    });

    imageTwo.onload = function() {
        URL.revokeObjectURL(imageTwo.src) // free memory
    }
});

imageThree.change(function(event) {
    imageThree.src = URL.createObjectURL(event.target.files[0]);

    var newHtml = 
    "<div class='img-newTP-upload position-relative h-100 p-0'>" +
        "<div class='img-default-content img_background_blur m-0' style='background-image: url(" + imageThree.src + ");'>" +
        "</div>" +
        "<div class='img-default-content m-0'>" +
            "<img src='" + imageThree.src + "' class='img-tag-tp-default' alt=''>" +
        "</div>" +
    "</div>";

    document.querySelector("#image-preview-box-three .image-preview-text").style.setProperty("display", "none", "important");

    $("#image-preview-box-three").append( function() {
        return newHtml;
    });

    imageThree.onload = function() {
        URL.revokeObjectURL(imageThree.src) // free memory
    }
});

// ************************************************ CONTINUE
// To remove File:
// document.getElementById('multifile').value = "";


// Functions

async function changeCategory() {
    
    if ( category.val() != "default" ) {
        
        // Start Loading Icon
        spinnerWrapper.style.display = 'flex';
            
        var innerMessage = "";
        var myHeaders = new Headers();

        var myInit = { 
            method: 'GET',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default'
        };

        const r_TPinfo = await fetch("http://localhost/TG_MTC/BackendDevelopment/trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=brands&value=" + category.val() , myInit);

        const j_TPinfo = await r_TPinfo.json();    
        // console.log(j_TPinfo.data);

        if ( j_TPinfo.error ){        
            innerMessage = "<option value='44'>Outra</option>"; // Define Default (Código 44 no DB)
        } else {
            console.log("Marca: OK");
            innerMessage = "<option value='default'>Selecione a Marca</option>"; // Permanece
            
            for (var p of j_TPinfo.data) {    
                innerMessage += "<option value='" + p["brand_id"] + "'>" + p["brand_description"] + "</option>";
            }
        }        

        brandSelector.html( function() {
            return innerMessage;
        });

        // Desabilita Loading
        spinnerWrapper.style.display = 'none';
    }
}

async function changeBrand() {        

    if ( brand.val() != "default" ) {

        if ( category.val() == "default" ){
            window.alert("Preencha a Categoria Primeiro!");
            brand.val("default");
            return;
        }

        // Start Loading Icon
        spinnerWrapper.style.display = 'flex';
        
        var innerMessage = "";
        
        var myHeaders = new Headers();
        var myInit = { 
            method: 'GET',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default'
        };

        const r_TPinfo = await fetch("http://localhost/TG_MTC/BackendDevelopment/trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=models&value=" + brand.val() , myInit);
        
        const j_TPinfo = await r_TPinfo.json();    
        // console.log(j_TPinfo.data);    
        
        if ( j_TPinfo.error ){
            innerMessage = "<option value='84'>Outros</option>"; // Define Default (Código 84 no DB)
        } else {
            console.log("Modelo: OK");
            innerMessage = "<option value='default'>Selecione o Modelo</option>"; // Permanece
            
            for (var p of j_TPinfo.data) {        
                innerMessage += "<option value='" + p["model_id"] + "'>" + p["description"] + "</option>";
            }
        }
        

        modelSelector.html( function() {
            return innerMessage;
        });
        
        // Desabilita Loading
        spinnerWrapper.style.display = 'none';
    }

}

function changeModel() {    

    if ( category.val() == "default"){
        window.alert("Preencha o Campo Categoria Primeiro!");
        model.val("default");
        return;
    }

    if ( brand.val() == "default"){
        window.alert("Preencha o campo Marca Primeiro!");
        model.val("default");
        return;
    }    
}


// New Post Submit
newTradePostForm.submit(async function( event ){
    event.preventDefault();      

    // Validations
    // if ( title.val() === "" || title.val() === null ) {
    //     msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Título!</div>");
    //     $(title).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroPost.html("");
    //     $(title).removeAttr("style");
    // }

    // if ( category.val() === "default" || category.val() === null ) {
    //     msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Categoria do Item!</div>");
    //     $(category).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroPost.html("");
    //     $(category).removeAttr("style");
    // }

    // if ( brand.val() === "default" || brand.val() === null ) {
    //     msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Marca do Item!</div>");
    //     $(brand).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroPost.html("");
    //     $(brand).removeAttr("style");
    // }    

    // if ( model.val() === "default" || model.val() === null ) {
    //     msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Modelo do Item!</div>");
    //     $(model).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroPost.html("");
    //     $(model).removeAttr("style");
    // }

    // if ( p_condition.val() === "" || p_condition.val() === null ) {
    //     msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar a Condição de Uso!</div>");
    //     $(p_condition).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroPost.html("");
    //     $(p_condition).removeAttr("style");
    // }

    // if ( price.val() === "" || price.val() === null ) {
    //     msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário o Valor do Item!</div>");
    //     $(price).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroPost.html("");
    //     $(price).removeAttr("style");
    // }

    // if ( possuiNF.val() === "" || possuiNF.val() === null ) {
    //     msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário informar se possui NF!</div>");
    //     $(possuiNF).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroPost.html("");
    //     $(possuiNF).removeAttr("style");
    // }

    // Start Loading Icon
    // spinnerWrapper.style.display = 'flex';
    
    // Send Form to REST API
    const formData = new FormData(event.target); // All Form Values    

    formData.append('token', '16663056-351e723be15750d1cc90b4fcd');
    formData.append('user_id', user_id);
    
    var newPrice = price.val().replace('.', '');    
    newPrice = newPrice.replace(',', '.');

    formData.set( "price", newPrice );    

    // Images
    var imageOne    = $('#image-upload-one')[0].files;
    var imageTwo    = $('#image-upload-two')[0].files;
    var imageThree  = $('#image-upload-three')[0].files;
    
    if(imageOne.length > 0 ){ formData.append('files[]', imageOne[0]); }
    if(imageTwo.length > 0 ){ formData.append('files[]', imageTwo[0]); }
    if(imageThree.length > 0 ){ formData.append('files[]', imageThree[0]); }
    
    var methodText = (isUpdate) ? "PUT" : "POST";

    // Read FormData
    // for (var p of formData) {
    //     let name = p[0];
    //     let value = p[1];
    
    //     console.log(name, value);
    // }    
    // return;

    // Send Post via POST to PHP
    const response = await fetch('http://localhost/TG_MTC/BackendDevelopment/trade_posts.php/upload.php', {
        method: methodText,
        body: formData
    });

    const j_Response = await response.json();

    console.log(j_Response);

    // setTimeout(function () {

    //     if(j_Response['error']){        
    //         msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: " + j_Response['msg'] + "</div>");
    //         spinnerWrapper.style.display = 'none';
    //     } else {
    //         // window.alert("Anúncio incluído com sucesso!");
    //         window.alert("Sucesso: " + j_Response['msg']);

    //         // Desabilita Loading
    //         spinnerWrapper.style.display = 'none';
    //         // spinnerWrapper.parentElement.removeChild(spinnerWrapper);
    
    //         // window.location.replace("http://localhost/TG_MTC/FrontEndWebDevelopment/Views/trade_posts/home.php");
    //         window.location.replace("http://localhost/TG_MTC/FrontEndWebDevelopment/Views/users/user_profile.php/?key=trade_posts");
    //     }
    // }, 2000);

});