//Global Vars

const passLenghtMin = 6;

// LOCAL
const frontEndURL = "http://localhost/TG_MTC/FrontEndWebDevelopment";
const backEndURL  = "http://localhost/TG_MTC/BackendDevelopment";

// WEB
// const frontEndURL = "https://musictradecenter.herokuapp.com/";
// const backEndURL  = "https://musictradecenter.000webhostapp.com/BackendDevelopment";

// Global Functions

function password_show_hide() {    

    var x = $("#userPassword");
    var showEye = $("#showEye");
    var hideEye = $("#hideEye");

    if (x.attr('type') === "password") {
        x.attr('type','text');
        console.log(x.attr('type'));

        hideEye.removeClass("d-none");
        showEye.addClass("d-none");
        
    } else {
        x.attr('type','password');
        console.log(x.attr('type'));
        
        showEye.removeClass("d-none");
        hideEye.addClass("d-none");
    }
}