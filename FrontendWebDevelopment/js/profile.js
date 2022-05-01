// $(document).ready(function(){        

// });

// Vars
const profileImgForm        = $('#profilepic-form');
const msgAlertErroProfile   = $("#msgAlertErroProfile");

let spinnerWrapper          = document.querySelector('.spinner-wrapper'); // Loading Icon
    
$('#profile-image').on('change', function(){
    $(this).closest('form').submit();    
});

// New Image
profileImgForm.submit(async function( event ){
    event.preventDefault();
    
    // if ( title.val() === "" || title.val() === null ) {
    //     msgAlertErroProfile.html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Título!</div>");
    //     $(title).css({'margin-bottom': '-15px','border': '2px solid #f64141'});

    //     return false;
    // } else {
    //     msgAlertErroProfile.html("");
    //     $(title).removeAttr("style");
    // }    

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
            // window.location.replace("http://localhost/TG_MTC/FrontEndWebDevelopment/Views/users/chat.php/?refreshPic=true");
        }
    }, 2000);

});

$('#editButton').on('click',  function(e) {
    // ...    
});

// DELETE TRADE POST
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
  