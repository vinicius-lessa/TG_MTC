/**
 * File DOC
 * 
 * Description Primeiro .js criado a parte para tratar da requisição POST a ser enviada com a mensagem do chat ao Backend do Site (c_chat.php).
 * ChangeLog 
 *  - Vinícius Lessa - 21/04/2022: Criação do arquivo e inclusão da documentação inicial. Início da Implementação da função 
 *  - Vinícius Lessa - 23/04/2022: Implementação da mensagem instantanea, e adição de um "Loading" antes que a consulta no banco possa ser feita.
 * 
 * @ Notes: 
 * 
 */

 $(document).ready(function(){
    refreshChat();
});


// Vars
const newMessageForm = $("#newMessageForm");

var message         = $("#newMessage");
var currentTime     = $("#current_time");
var requestServer   = true;

// Functions

// Refresh Chat
function refreshChat(){

    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        if (req.readyState == 4 && req.status == 200 && requestServer) {

            $('#loadingIcon').css("display", "none");

            if ( !(req.responseText == 200) ) {
                $( "#chat" ).html( req.responseText );
                $( "#chat" ).css("display", "flex");
                
                $( "#noMessages" ).css("display", "none");                                
                
                console.log("Atualizando mensagens...");
            } else {
                $( "#noMessages" ).css("display", "block");

                console.log("Nenhuma mensagem encontrada!");                
            }
        }
    }

    req.open('GET', url, true);
    req.send();
}
      
// Repeat - 10 seconds
setInterval(function(){refreshChat();}, 10000);

// Events
// Insert New Message
newMessageForm.submit(async function( event ){
    event.preventDefault();

    requestServer = false;

    if ( message.val() === "" || message.val() === null ) {
        console.log("Sem mensagens a transmitir.");

        return false;
    }

    // Insere mensagem Instantâneamente.
    var innerMessage =
    "<div class='d-flex flex-row-reverse mx-2'>" +
        "<div class='mb-1 rounded msg-width msg-user'>" +
        "<div class='m-0 mt-2 message-default'>" +
            "<div class='col-12 mb-0 d-flex flex-row-reverse p-0 px-2'>" +
                "<div class='m-0 p-0'> " +
                "<span>" + message.val() + "</span> " +
                    "</div> " +
                "</div> " +
                "<div class='d-flex flex-row-reverse mx-1 mb-0 p-0 size-12 text-gray' style='transform: translate(0px, -2px);'>" +
                "<span>" + currentTime.val() + "</span> " +
                    "</div> " +
                "</div> " +
            "</div> " +
    "</div> ";
    

    $( "#noMessages" ).css("display", "none");

    $( "#chat" ).css("display", "flex");
    $( "#chat" ).html( function() {
        return innerMessage + $( "#chat" ).html();
    });
    
    // Send Form to REST API
    const formData = new FormData(event.target); // All Form Values

    message.val('');

    formData.append("action", "newMessage");

    // Read FormData
    // for (var p of formData) {
    //     let name = p[0];
    //     let value = p[1];    
    //     console.log(name, value);
    // }

    // Send Post via POST to PHP
    const response = await fetch( frontEndURL + "/Controllers/c_chat.php", {
        method: "POST",
        body: formData
    });

    const j_Response = await response.json();

    console.log(j_Response);

    requestServer = true;

    // *******

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