/**
 * File DOC
 * 
 * Description Primeiro .js criado a parte para tratar da requisição POST a ser enviada com a mensagem do chat ao Backend do Site (c_chat.php).
 * ChangeLog 
 *  - Vinícius Lessa - 21/04/2022: Criação do arquivo e inclusão da documentação inicial. Início da Implementação da função 
 * 
 * @ Notes: 
 * 
 */


// Vars
const newMessageForm = $("#newMessageForm");

var message          = $("#newMessage");

// Events
newMessageForm.submit(async function( event ){
    event.preventDefault();    

    if ( message.val() === "" || message.val() === null ) {
        // msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Título!</div>");
        // $(title).css({'margin-bottom': '-15px','border': '2px solid #f64141'});
        console.log("nada a fazer");

        return false;
    }
    
    // Send Form to REST API
    const formData = new FormData(event.target); // All Form Values

    formData.append("action", "newMessage");

    // Read FormData
    // for (var p of formData) {
    //     let name = p[0];
    //     let value = p[1];
    
    //     console.log(name, value);
    // }

    // Send Post via POST to PHP
    const response = await fetch('http://localhost/TG_MTC/FrontendWebDevelopment/Controllers/c_chat.php', {
        method: "POST",
        body: formData
    });

    const j_Response = await response.json();

    console.log(j_Response);

    // setTimeout(function () {

    //     if(j_Response['error']){        
    //         // msgAlertErroPost.html("<div class='alert alert-danger' role='alert'>Erro: " + j_Response['msg'] + "</div>");
    //         console.log("Erro: " + j_Response['msg']);
    //     } else {
    //         // window.alert("Anúncio incluído com sucesso!");
    //         console.log("Sucesso: " + j_Response['msg']);
                
    //     }
    // }, 2000);

});