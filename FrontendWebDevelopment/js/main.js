$(document).ready(function(){  

    // Click on "Submit"
    $('#singUp-form .submit-btn').on('click', function(){
        
        // Variables
        
        var name = $("#userName").val();
        var email = $("#userEmail").val();

        // Value Validations

        if (email == null || email == ""){
            $("#emailAlert").text('*campo obrigatório');
            
            // Style
            $("#emailAlert").css('padding-left', '5px');
            $("#userEmail").css({'margin-bottom': '-10px','border': '1px solid #f64141'});

            return false;
        } 
        
        if (email == null || email == "") {
            $("#nameAlert").text('*campo obrigatório');
            
            // Style
            $("#nameAlert").css('padding-left', '5px');
            $("#userName").css({'margin-bottom': '-10px','border': '1px solid #f64141'});

            return false;
        }

        // Check if E-mail already exists within DB

        // $.ajax(
        //     {
        //     url: 'http://localhost/TG_MCT/FrontEndWebDevelopment/Controllers/c_user.php',
        //     method: 'POST', // type: 'POST',
        //     data: {
        //         "email" : email.val()
        //     }, 
        //     success: function(response) { 
        //         console.log(response);
        //         if (response.email) { // se existir
        //         $("#emailAlert")..text('E-mail já cadastrado!');
        //         }            
        //     }
        /*
            CASO E-MAIL JÁ EXISTA
            if (email == 'vinicius.lessa33@gmail.com') {
                $("#emailAlert").text('E-mail já cadastrado!');
                
                // Style
                $("#emailAlert").css('padding-left', '5px');
                $("#userEmail").css({'margin-bottom': '-10px','border': '1px solid #f64141'});
                
                return false;
    
            } else {
                $('#singUp-form').submit();
            }
        */
        // });
    });
});